@php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

if (Route::currentRouteName() == 'nova.pages.login'){
    $title = DB::table('nova_settings')->where('key','nova_login_page_title')->first();
    $title = $title ? ($title->value ? $title->value : "Login Page") : "Login Page";  

    $bg_image = nova_get_setting('nova_login_bg_image') ? ("/storage/" . nova_get_setting('nova_login_bg_image')) : asset('assets/img/curved-images/curved-11.jpg');
}

@endphp

<link rel="icon" href="http://binamiz.test/storage/uploads/nova-settings/favicon.png">

@if (Route::currentRouteName() == 'nova.pages.login')
    <title> {{ $title }}</title>
    <meta name="nova_bg_image" content="{{ $bg_image }}">
@endif

