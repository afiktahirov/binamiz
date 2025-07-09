@php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

if (Route::currentRouteName() == 'nova.pages.login'){
    $title =  nova_get_setting('nova_settings') ?? 'Login Page';
    $joinUsUrl = nova_get_setting('join_us_url') ?? '#';

    $bg_images = DB::table('nova_settings')
        ->whereIn('key', [
            'nova_login_bg_image-1',
            'nova_login_bg_image-2',
            'nova_login_bg_image-3'
        ])
        ->get()
        ->map(function ($item) {
            return "/storage/" . $item->value;
        });
}

@endphp

<link rel="icon" href="http://binamiz.test/storage/uploads/nova-settings/favicon.png">

@if (Route::currentRouteName() == 'nova.pages.login')
    <title> {{ $title }}</title>
    <meta name="nova_bg_images" content="{{ json_encode($bg_images) }}">
    <meta name="join_us_url" content="{{ $joinUsUrl }}">
@endif

