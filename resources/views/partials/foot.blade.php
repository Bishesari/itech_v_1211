<flux:footer class="bg-zinc-50 dark:bg-zinc-900 border-t border-zinc-200 dark:border-zinc-700">


    <flux:separator/>
    <flux:text class="text-center pt-2">
        <span class="font-semibold">&copy;</span>
        {{__('تمامی حقوق محفوظ است.')}}
        {{__('از 1388 تا')}}
        {{jdate('Y', time(), '', '', 'en')}}
    </flux:text>

    <flux:text class="text-center pt-2">
        {{__('برنامه نویسی و اجرا: یاسر بیشه سری')}}
    </flux:text>

    <flux:text class="text-center pt-2">
        {{__('تماس: 6111 433 903 98+')}}
        {{__(' و ')}}
        {{__('Yasser.Bishesari@Gmail.Com')}}
    </flux:text>

    <flux:text class="text-center pt-2">
        {{__('SV: 12.1.1 - LV:')}}
        {{__(Illuminate\Foundation\Application::VERSION)}}
        {{__(' - PV:'.PHP_VERSION)}}
    </flux:text>
</flux:footer>
