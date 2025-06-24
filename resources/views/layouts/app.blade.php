<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets/img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/img/favicon.png') }}">
    <title>
        Soft UI Dashboard 3 by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700,800" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="https://demos.creative-tim.com/soft-ui-dashboard/assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets/css/soft-ui-dashboard.css') }}" rel="stylesheet" />
    <link id="pagestyle" href="{{ asset('assets/css/custom.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/argon-dashboard/2.0.4/css/nucleo-icons.min.css" integrity="sha512-GhQLa5q131bN6G1TOG7zviS79WU8/18DE5WLS7rHN+EOQ0G3BDJfV6+/g680Cq9ocHU+SLKvO9gFnS0NuhZXGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/js/app.js'])
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://www.jqueryscript.net/demo/Tags-Input-Autocomplete/src/jquery.tagsinput-revisited.js" ></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
</head>

<body class="g-sidenav-show  bg-gray-100">

@if (!request()->is('login'))
    @include('layouts.sidebar')
@endif

<main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @if (!request()->is('login'))
        @include('layouts.header')
    @endif
    <!-- End Navbar -->
    <div class="container-fluid py-4">
        @yield('content')
    </div>
    @include('layouts.footer')
</main>
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
        <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
        <div class="card-header pb-0 pt-3 ">
            <div class="float-start">
                <h5 class="mt-3 mb-0">Soft UI Konfiquratoru</h5>
                <p>Panel seçimlərimizə baxın.</p>
            </div>
            <div class="float-end mt-4">
                <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
                    <i class="fa fa-close"></i>
                </button>
            </div>
            <!-- End Toggle Button -->
        </div>
        <hr class="horizontal dark my-1">
        <div class="card-body pt-sm-3 pt-0">
            <!-- Sidebar Backgrounds -->
            <div>
                <h6 class="mb-0">Yan Panel Rəngləri</h6>
            </div>
            <a href="javascript:void(0)" class="switch-trigger background-color">
                <div class="badge-colors my-2 text-start">
                    <span class="badge filter bg-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
                    <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
                </div>
            </a>
            <!-- Sidenav Type -->
            <div class="mt-3">
                <h6 class="mb-0">Sidenav Növü</h6>
                <p class="text-sm">2 müxtəlif sidenav növü arasında seçim edin.</p>
            </div>
            <div class="d-flex justify-content-around">
                <button class="btn btn-outline-primary w-45 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Şəffaf</button>
                <button class="btn btn-outline-primary w-45 px-3 mb-2" data-class="bg-white" onclick="sidebarType(this)">Ağ</button>
            </div>
            <p class="text-sm d-xl-none d-block mt-2">Sidenav növünü yalnız masaüstü görünüşdə dəyişə bilərsiniz.</p>
            <!-- Navbar Fixed -->
            <div class="mt-3">
                <h6 class="mb-0">Sabit Navbar</h6>
            </div>
            <div class="form-check form-switch ps-0">
                <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
            </div>

            <!-- Reset Settings Button -->
            <!-- <div class="mt-3">
                <h6 class="mb-0">Nizamlamaları Sıfırla</h6>
                <p class="text-sm">Bütün dizayn seçimlərinizi sıfırlayın.</p>
                <button class="btn btn-outline-danger w-100 mb-2" id="resetSettings">Sıfırla</button>
            </div> -->
        </div>
    </div>
</div>
<!--   Core JS Files   -->
<script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
<script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/chartjs.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/countup.min.js') }}"></script>
<script src="{{ asset('assets/js/plugins/moment.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js"></script>
<script>
    $('.countTo').each(function () {
        var $this = $(this);
        $this.prop('Counter', 0).animate({
            Counter: $this.attr('countto')
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $this.text(Math.ceil(now));
            }
        });
    });
</script>
{{-- Custom Helper --}}
{!! \App\Helpers\Swal::show() !!}
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
</script>
<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->

<script src="{{ asset('assets/js/soft-ui-dashboard.js') }}"></script>
<script src="{{ asset('assets/js/soft-ui-settings.js') }}"></script>
<script>
    // Add event listener for the reset settings button
    document.addEventListener('DOMContentLoaded', function() {
        const resetButton = document.getElementById('resetSettings');
        if (resetButton) {
            resetButton.addEventListener('click', function() {
                if (confirm('Bütün UI nizamlamalarınızı sıfırlamaq istədiyinizə əminsiniz?')) {
                    // Clear settings from localStorage
                    clearSettings();

                    // Reload the page to apply default settings
                    // window.location.reload();
                }
            });
        }
    });
</script>
@stack('scripts')
</body>

</html>
