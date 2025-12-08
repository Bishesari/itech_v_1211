<?php

use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Volt\Component;

new
#[Layout('components.layouts.public')]
#[Title('آموزشگاه کامپیوتر، حسابداری، معماری و عکاسی در بوشهر | دوره‌های مهارتی')]
class extends Component {
    //
}; ?>

<div>
    <x-slot:meta_description>
        {{__('آموزشگاه تخصصی کامپیوتر، حسابداری، برنامه‌نویسی، معماری و عکاسی در بوشهر با دوره‌های مهارتی کاربردی. آموزش حضوری، مدرک معتبر و آمادگی ورود به بازار کار.')}}
    </x-slot:meta_description>
    <x-slot:og_title>
        {{__('آموزش مهارت‌های کامپیوتر، حسابداری و عکاسی در بوشهر')}}
    </x-slot:og_title>
    <x-slot:og_description>
        {{__('آموزش حضوری مهارت‌های کاربردی با مدرک معتبر در بوشهر')}}
    </x-slot:og_description>
    <x-slot:tw_title>
        {{__('آموزشگاه کامپیوتر و حسابداری در بوشهر')}}
    </x-slot:tw_title>
    <x-slot:tw_description>
        {{__('آموزش مهارت‌های کاربردی با مدرک معتبر در بوشهر')}}
    </x-slot:tw_description>


</div>
