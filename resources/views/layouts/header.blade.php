<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
    <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5" href="javascript:;">Səhifələr</a></li>
                <li class="breadcrumb-item text-sm active" aria-current="page">{{ $title ?? "Home" }}</li>
            </ol>
        </nav>
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <ul class="navbar-nav  justify-content-end">
                <li class="nav-item d-flex align-items-center pe-3">
                    <a class="nav-link text-body font-weight-bold px-2">
                        <i class="fa fa-user me-sm-1"></i>
                        <span class="d-sm-inline d-none ">{{ Auth::user()->name }}</span>
                    </a>
                </li>
                <li class="nav-item dropdown pe-4 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="fa fa-bell cursor-pointer"></i>
                        @if ($top_notifications->where('is_readed', 0)->count() > 0)
                            <span class="badge badge-warning">{{ $top_notifications->where('is_readed', 0)->count() }}</span>
                        @endif
                    </a>
                    <ul class="dropdown-menu  dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                        @forelse ($top_notifications as $notification)
                            <li class="mb-2">
                                <a class="dropdown-item border-radius-md {{ $notification->is_readed ? 'notification-readed' : 'notification-not-readed' }}" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="my-auto me-3">
                                            @if ($notification->type->value == 'informative') 
                                                <i class="fa-solid fa-circle-info text-primary fa-lg"></i>
                                            @elseif ($notification->type->value == 'important') 
                                                <i class="fa-solid fa-circle-exclamation text-danger fa-lg"></i>
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                <strong>{{ (!$notification->is_readed ? 'Yeni ' : '') . $notification->type->label() }}: </strong>  <span>{{ $notification->title }}</span>
                                            </h6>
                                            <p class="text-xs mb-0 ">
                                                <i class="fa fa-clock me-1"></i>
                                                {{ $notification->created_at->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @empty
                            <li>
                                <a class="dropdown-item border-radius-md" href="javascript:;">
                                    <div class="d-flex py-1">
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="text-sm font-weight-normal mb-1">
                                                Bildiriş yoxdur
                                            </h6>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        @endforelse
                    </ul>
                </li>

                <li class="nav-item d-flex align-items-center">
                    <a class="btn btn-outline-primary btn-sm mb-0 me-3" target="_blank" href="https://www.creative-tim.com/builder?ref=navbar-soft-ui-dashboard">Balansın artırılması</a>
                </li>
                {{-- <li class="nav-item px-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0">
                        <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                    </a>
                </li> --}}
                <li class="nav-item d-flex align-items-center">
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" class="nav-link text-body font-weight-bold px-2" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span class="d-sm-inline d-none ">Çıxış</span>
                    </a>
                </li>
                <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                        <div class="sidenav-toggler-inner">
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                            <i class="sidenav-toggler-line"></i>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
