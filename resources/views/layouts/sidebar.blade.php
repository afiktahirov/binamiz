<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="" style="text-align: center;">
        <img src="/storage/{{ auth()->user()->company->logo }}" alt="main_logo" style="width: 150px; display: inline-block;">
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main" style="height: 100vh !important;">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/dashboard*') ? 'active' : '' }}" href="{{ route('account.dashboard') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/home') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Əsas səhifə</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/garage*') ? 'active' : '' }} " href="{{ route('account.garage.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/garage') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Garajlarım</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/object*') ? 'active' : '' }} " href="{{ route('account.object.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/object') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Obyektlərim</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/apartment*') ? 'active' : '' }}" href="{{ route('account.apartment.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/apartment') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Mənzillərim</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/vehicle*') ? 'active' : '' }}" href="{{ route('account.vehicle.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/vehicle') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Nəqliyyat Vasitələri</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link  " href="../pages/billing.html">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/invoice') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Ödənişlər</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/information*') ? 'active' : '' }}" href="{{ route('account.information.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/information') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Məlumat masası</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/polls/survey*') ? 'active' : '' }}" href="{{ route('account.poll.survey') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/survey') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Sorğu</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/polls/vote*') ? 'active' : '' }}" href="{{ route('account.poll.vote') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/vote') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Səsvermə</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->is('account/application*') ? 'active' : '' }}" href="{{ route('account.application.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/application') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Müraciətlərim</span>
                </a>
            </li>
            <li class="nav-item mt-3">
                <h6 class="nav-title ps-4 ms-2 text-uppercase text-xs">Account pages</h6>
            </li>
            <li class="nav-item">
                <a class="nav-link  {{ request()->is('account/profile*') ? 'active' : '' }}" href="{{ route('account.profile.index') }}">
                    <div class="icon icon-shape icon-sm shadow border-radius-md bg-white text-center me-2 d-flex align-items-center justify-content-center">
                        <img src="{{ readSvg('img/sidebar/profile') }}" width="18px" height="18px"/>
                    </div>
                    <span class="nav-link-text ms-1">Profil</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
