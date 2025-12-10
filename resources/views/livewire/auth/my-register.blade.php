<?php

use App\Jobs\OtpSend;
use App\Jobs\SmsPass;
use App\Models\Contact;
use App\Models\OtpLog;
use App\Models\User;
use App\Rules\NCode;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Volt\Component;

new class extends Component
{
    public string $context = 'modal'; // modal | page
    public bool $showOtp = false;

    public function mount(string $context = 'modal'): void
    {
        $this->context = $context;
    }

    public string $n_code = '';
    public string $mobile_nu = '';
    public string $u_otp = '';
    public int $timer = 0;
    public string $otp_log_check_err = '';

    protected function rules(): array
    {
        return [
            'n_code' => ['required', 'digits:10', new NCode, 'unique:profiles'],
            'mobile_nu' => ['required', 'starts_with:09', 'digits:11'],
        ];
    }

    public function check_inputs(): void
    {
        $this->validate();

        if (!$this->log_check()) {
            return;
        }

        $this->u_otp = '';
        $this->showOtp = true;

        if ($this->context === 'modal') {
            $this->modal('otp_verify')->show();
        }
    }

    public function otp_send(): void
    {
        if (!$this->log_check()) {
            return;
        }

        $otp = NumericOTP();

        OtpSend::dispatch($this->mobile_nu, $otp);

        OtpLog::create([
            'ip' => request()->ip(),
            'n_code' => $this->n_code,
            'mobile_nu' => $this->mobile_nu,
            'otp' => $otp,
            'otp_next_try_time' => time() + 120,
        ]);

        $this->timer = 120;
        $this->dispatch('set_timer');
    }

    public function log_check(): bool
    {
        $this->timer = 0;
        $ip = request()->ip();
        $oneDayAgo = now()->subDay();

        $latest = DB::table('otp_logs')
            ->where('n_code', $this->n_code)
            ->where('created_at', '>=', $oneDayAgo)
            ->latest('id')
            ->first();

        if ($latest && $latest->otp_next_try_time > time()) {
            $this->timer = $latest->otp_next_try_time - time();
            $this->dispatch('set_timer');
            return true;
        }

        return true;
    }

    public function otp_verify(): void
    {
        $otp = DB::table('otp_logs')
            ->where('n_code', $this->n_code)
            ->where('mobile_nu', $this->mobile_nu)
            ->latest('id')
            ->first();

        if (!$otp || $otp->otp != $this->u_otp) {
            $this->otp_log_check_err = 'کد پیامکی اشتباه است.';
            return;
        }

        if ($otp->otp_next_try_time < time()) {
            $this->otp_log_check_err = 'کد منقضی شده است.';
            return;
        }

        DB::transaction(function () {
            $pass = simple_pass(6);

            $user = User::create([
                'user_name' => $this->n_code,
                'password' => $pass,
            ]);

            InstituteRoleUser::create([
                'user_id' => $user->id,
                'role_id' => 1,
                'assigned_by' => $user->id,
            ]);

            DB::table('otp_logs')
                ->where('n_code', $this->n_code)
                ->delete();

            $contact = Contact::firstOrCreate(
                ['mobile_nu' => $this->mobile_nu],
                ['verified' => 1]
            );

            $user->profile()->create([
                'identifier_type' => 'national_id',
                'n_code' => $this->n_code,
            ]);

            $user->contacts()->syncWithoutDetaching([$contact->id]);

            SmsPass::dispatch($this->mobile_nu, $this->n_code, $pass);

            event(new Registered($user));
            Auth::login($user);
        });

        session()->regenerate();
        session(['active_role_id' => 1]);

        if ($this->context === 'modal') {
            $this->dispatch('reloadPage');
        } else {
            $this->redirectRoute('dashboard', navigate: true);
        }
    }

    public function reset_all(): void
    {
        $this->reset();
        $this->resetErrorBag();
        $this->showOtp = false;
    }
};
