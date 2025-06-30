@extends('layouts.app')
@section('content')

<div class="container-fluid">
    <div class="row mb-5">
        <div class="col-12 col-md-6 col-xl-4">
            <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Şəxsi məlumatlar</h6>
            </div>
            <div class="card-body p-3">
                <h6 class="text-uppercase text-body text-xs font-weight-bolder">Account</h6>
                <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault" checked="">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault">Email me when someone follows me</label>
                    </div>
                </li>
                <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault1">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault1">Email me when someone answers on my post</label>
                    </div>
                </li>
                <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault2" checked="">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault2">Email me when someone mentions me</label>
                    </div>
                </li>
                </ul>
                <h6 class="text-uppercase text-body text-xs font-weight-bolder mt-4">Application</h6>
                <ul class="list-group">
                <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault3">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault3">New launches and projects</label>
                    </div>
                </li>
                <li class="list-group-item border-0 px-0">
                    <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault4" checked="">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault4">Monthly product updates</label>
                    </div>
                </li>
                <li class="list-group-item border-0 px-0 pb-0">
                    <div class="form-check form-switch ps-0">
                    <input class="form-check-input ms-auto" type="checkbox" id="flexSwitchCheckDefault5">
                    <label class="form-check-label text-body ms-3 text-truncate w-80 mb-0" for="flexSwitchCheckDefault5">Subscribe to newsletter</label>
                    </div>
                </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-md-0 mt-4">
            <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Mənzil</h6>
                </div>
                <div class="col-md-4 text-end">
                    <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit Profile" data-bs-original-title="Edit Profile"></i>
                    </a>
                </div>
                </div>
            </div>
            <div class="card-body p-3">
                <p class="text-sm">
                Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                </p>
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; Alec M. Thompson</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; alecthompson@mail.com</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; USA</li>
                <li class="list-group-item border-0 ps-0 pb-0">
                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                    <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mt-xl-0 mt-4">
            <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Qaraj</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Sophie B.</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Anne Marie</h6>
                    <p class="mb-0 text-xs">Awesome work, can you..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Ivanna</h6>
                    <p class="mb-0 text-xs">About files I can..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Peterson</h6>
                    <p class="mb-0 text-xs">Have a great afternoon..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0">
                    <div class="avatar me-3">
                    <img src="../../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Nick Daniel</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-xl-4 mt-4">
            <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                    <h6 class="mb-0">Avtomibil</h6>
                </div>
                <div class="col-md-4 text-end">
                    <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" aria-label="Edit Profile" data-bs-original-title="Edit Profile"></i>
                    </a>
                </div>
                </div>
            </div>
            <div class="card-body p-3">
                <p class="text-sm">
                Hi, I’m Alec Thompson, Decisions: If you can’t decide, the answer is no. If two equally difficult paths, choose the one more painful in the short term (pain avoidance is creating an illusion of equality).
                </p>
                <hr class="horizontal gray-light my-4">
                <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Full Name:</strong> &nbsp; Alec M. Thompson</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Mobile:</strong> &nbsp; (44) 123 1234 123</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; alecthompson@mail.com</li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:</strong> &nbsp; USA</li>
                <li class="list-group-item border-0 ps-0 pb-0">
                    <strong class="text-dark text-sm">Social:</strong> &nbsp;
                    <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-facebook fa-lg"></i>
                    </a>
                    <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-twitter fa-lg"></i>
                    </a>
                    <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                    <i class="fab fa-instagram fa-lg"></i>
                    </a>
                </li>
                </ul>
            </div>
            </div>
        </div>
        <div class="col-12 col-xl-4 mt-4">
            <div class="card h-100">
            <div class="card-header pb-0 p-3">
                <h6 class="mb-0">Obyekt</h6>
            </div>
            <div class="card-body p-3">
                <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Sophie B.</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/marie.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Anne Marie</h6>
                    <p class="mb-0 text-xs">Awesome work, can you..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/ivana-square.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Ivanna</h6>
                    <p class="mb-0 text-xs">About files I can..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <div class="avatar me-3">
                    <img src="../../assets/img/team-4.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Peterson</h6>
                    <p class="mb-0 text-xs">Have a great afternoon..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0">
                    <div class="avatar me-3">
                    <img src="../../assets/img/team-3.jpg" alt="kal" class="border-radius-lg shadow">
                    </div>
                    <div class="d-flex align-items-start flex-column justify-content-center">
                    <h6 class="mb-0 text-sm">Nick Daniel</h6>
                    <p class="mb-0 text-xs">Hi! I need more information..</p>
                    </div>
                    <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="javascript:;">Reply</a>
                </li>
                </ul>
            </div>
            </div>
        </div>
    </div>

    <div class="row mb-5">
        <div class="col-lg-12 mt-lg-0 mt-4">
            <!-- Card Profile -->
            <div class="card card-body" id="profile">
                <div class="row justify-content-center align-items-center">
                    <div class="col-sm-auto col-4">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../../assets/img/bruce-mars.jpg" alt="bruce" class="w-100 border-radius-lg shadow-sm">
                    </div>
                    </div>
                    <div class="col-sm-auto col-8 my-auto">
                    <div class="h-100">
                        <h5 class="mb-1 font-weight-bolder">
                        {{ auth()->user()->fsull_name ?? auth()->user()->name}}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                        {{-- auth()->user()->role == "owner" "Mülkiyətçiə" : "Kirayəçi" --}} ?
                        </p>
                    </div>
                    </div>
                    <div class="font-weight-bolder col-sm-auto ms-sm-auto mt-sm-0 mt-3">
                    <span>{{  auth()->user()->company->legal_name }}</span>
                    </div>
                </div>
            </div>
            <!-- Profil Məlumatları Formu -->
            <form method="POST" action="{{ route('account.profile.update') }}">
                @csrf
                <!-- Əsas Məlumat Kartı -->
                <div class="card mt-4" id="basic-info">
                    <div class="card-header">
                        <h5>Əsas Məlumatlar</h5>
                    </div>
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="full_name" class="form-label">Tam Ad</label>
                                <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name', Auth::user()->full_name) }}" autocomplete="full_name">
                                @error('full_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3 row">
                                <!-- <div class="col-md-6 mb-3">
                                    <label for="gender" class="form-label">Cins</label>
                                    <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                        <option value="0" {{ old('gender', Auth::user()->gender) == 0 ? 'selected' : '' }}>Kişi</option>
                                        <option value="1" {{ old('gender', Auth::user()->gender) == 1 ? 'selected' : '' }}>Qadın</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div> -->
                                <div class="col-md-6 mb-3">
                                    <label for="birthdate" class="form-label">Doğum Tarixi</label>
                                    <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate', Auth::user()->birthdate) }}" autocomplete="birthdate">
                                    @error('birthdate')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="email" class="form-label">E-poçt</label>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                                @error('email')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact_numbers" class="form-label">Əlaqə nömrələri</label>
                                <input id="contact_numbers" name="contact_numbers" class="form-control @error('contact_numbers') is-invalid @enderror" type="text" value="{{ old('contact_numbers', auth()->user()->contactNumbers()) }}">
                                @error('contact_numbers')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <button type="submit" class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Yadda saxla</button>
                    </div>
                </div>
            </form>

            <!-- Card Change Password -->
            <div class="card mt-4" id="password">
                <div class="card-header">
                    <h5>Şifrəni Dəyiş</h5>
                </div>
                <div class="card-body pt-0">
                    <form action="{{ route('account.profile.change_password') }}" method="POST">
                        @csrf
                        @method('POST')
                        <label class="form-label">Hazırkı şifrə</label>
                        <div class="form-group">
                            <input class="form-control @error('current_password') is-invalid @enderror" name="current_password" type="password" placeholder="Hazırkı şifrə" onfocus="focused(this)" onfocusout="defocused(this)">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label">Yeni şifrə</label>
                        <div class="form-group">
                            <input class="form-control @error('new_password') is-invalid @enderror" name="new_password" type="password" placeholder="Yeni şifrə" onfocus="focused(this)" onfocusout="defocused(this)">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label">Yeni şifrəni təsdiqlə</label>
                        <div class="form-group">
                            <input class="form-control @error('new_password_confirmation') is-invalid @enderror" name="new_password_confirmation" type="password" placeholder="Şifrəni təsdiqlə" onfocus="focused(this)" onfocusout="defocused(this)">
                            @error('new_password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <h5 class="mt-5">Şifrə tələbləri</h5>
                        <p class="text-muted mb-2">
                            Zəhmət olmasa, güclü bir şifrə üçün bu təlimata əməl edin:
                        </p>
                        <ul class="text-muted ps-4 mb-0 float-start">
                            <li>
                                <span class="text-sm">Bir xüsusi simvol</span>
                            </li>
                            <li>
                                <span class="text-sm">Minimum 6 simvol</span>
                            </li>
                            <li>
                                <span class="text-sm">Bir rəqəm (2 tövsiyə olunur)</span>
                            </li>
                            <li>
                                <span class="text-sm">Tez-tez dəyişdirin</span>
                            </li>
                        </ul>
                        <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Şifrəni yenilə</button>
                    </form>
                </div>
            </div>
            <!-- Card Sessions -->
            <div class="card mt-4" id="sessions">
                <div class="card-header pb-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h5>Sessiyalar</h5>
                            <p class="text-sm">Bu, hesabınıza daxil olmuş cihazların siyahısıdır. Tanımadığınız cihazları silin.</p>
                        </div>
                        @if(count($userSessions) > 1)
                            <button onclick="deleteAllSessions(event)" type="submit" class="btn btn-sm btn-danger">Bütün digər sessiyaları sil</button>
                        @endif
                    </div>
                </div>
                <div class="card-body pt-0">
                    @if(count($userSessions) > 0)
                        @foreach($userSessions as $session)
                            <div data-id="{{$session['id']}}" class="session-row d-flex align-items-center position-relative p-3 rounded-lg mb-2 hover-shadow transition-all">
                                <div class="text-center">
                                    @if($session['desktop'])
                                        <div class="icon-shape bg-light me-3">
                                            <i class="fas fa-desktop text-dark"></i>
                                        </div>
                                    @elseif($session['phone'])
                                        <div class="icon-shape bg-light me-3">
                                            <i class="fas fa-mobile-alt text-dark"></i>
                                        </div>
                                    @else
                                        <div class="icon-shape bg-light me-3">
                                            <i class="fas fa-question text-dark"></i>
                                        </div>
                                    @endif
                                </div>
                                <div class="ms-2 flex-grow-1">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h6 class="mb-0 text-sm font-weight-bold">
                                            {{ $session['platform'] }} on {{ $session['browser'] }}
                                            @if($session['is_current_device'])
                                                <span class="badge badge-sm bg-gradient-success ms-1">Cari</span>
                                            @endif
                                        </h6>
                                    </div>
                                    <p class="text-muted mb-0">
                                        @if($session['ip_address'])
                                            <span class="text-secondary">{{ $session['ip_address'] }}</span>
                                        @endif
                                     <span class="text-secondary ms-5">{{ $session['last_active'] }}</span>
                                    </p>
                                </div>
                                @if(!$session['is_current_device'])
                                    <button onclick="deleteSession('{{$session['id']}}')" type="submit" class="btn btn-link text-danger p-1 ms-2" data-bs-toggle="tooltip" data-bs-placement="top" title="Sessiyan sil">
                                        <i class="fas fa-trash-alt fa-lg"></i>
                                    </button>
                                @endif
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-4">
                            <div class="icon icon-shape icon-md bg-light text-secondary mb-3">
                                <i class="fas fa-exclamation-circle"></i>
                            </div>
                            <p class="text-sm">Heç bir sessiya tapılmadı.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.tagsinput {
	display: -webkit-box;
	display: -webkit-flex;
	display: -ms-flexbox;
	display: flex;
	-webkit-flex-wrap: wrap;
	-ms-flex-wrap: wrap;
	flex-wrap: wrap;
	box-sizing: border-box;
	background: #fff;
	font-family: sans-serif;
	font-size: 14px;
	line-height: 20px;
	color: #556270;
	padding: 5px 5px 0 5px;
	border: 1px solid #e6e6e6;
	border-radius: 8px;
}

.tagsinput.focus {
	border-color: #ccc;
}

.tagsinput * {
	box-sizing: border-box;
}

.tagsinput .tag {
	position: relative;
	background: var(--bs-primary);
	display: block;
	max-width: 100%;
	word-wrap: break-word;
	color: #fff;
	padding: 5px 30px 5px 5px;
	border-radius: 8px;
	margin: auto 5px 5px auto;
}

.tagsinput .tag .tag-remove {
	position: absolute;
	background: none;
	display: block;
	width: 30px;
	height: 30px;
	top: 0;
	right: 0;
	cursor: pointer;
	text-decoration: none;
	text-align: center;
	color: #fff;
	line-height: 30px;
	padding: 0;
	border: 0;
}

.tagsinput .tag .tag-remove:before,
.tagsinput .tag .tag-remove:after {
	background: #fff;
	position: absolute;
	display: block;
	width: 10px;
	height: 2px;
	top: 14px;
	left: 10px;
	content: '';
}

.tagsinput .tag .tag-remove:before {
	-webkit-transform: rotateZ(45deg);
	transform: rotateZ(45deg);
}

.tagsinput .tag .tag-remove:after {
	-webkit-transform: rotateZ(-45deg);
	transform: rotateZ(-45deg);
}

.tagsinput div {
	-webkit-box-flex: 1;
	-webkit-flex-grow: 1;
	-ms-flex-positive: 1;
	flex-grow: 1;
}

.tagsinput div input {
	background: transparent;
	display: block;
	width: 100%;
	font-size: 14px;
	line-height: 20px;
	padding: 5px;
	border: 0 none;
	margin: 0 5px 5px 0;
}

.tagsinput div input.error {
	color: #ff6b6b;
}

.tagsinput div input::-ms-clear {
	display: none;
}

.tagsinput div input::-webkit-input-placeholder {
	color: #ccc;
	opacity: 1.0;
}

.tagsinput div input:-moz-placeholder {
	color: #ccc;
	opacity: 1.0;
}

.tagsinput div input::-moz-placeholder {
	color: #ccc;
	opacity: 1.0;
}

.tagsinput div input:-ms-input-placeholder {
	color: #ccc;
	opacity: 1.0;
}
.choices__list--multiple .choices__item {
    background: var(--bs-primary);
    border: 1px solid var(--bs-primary);
}

</style>
@push('scripts')
    <script>

        $(document).ready(function() {
            var textRemove = new Choices(
                     document.getElementById('contact_numbers'),
                     {
                       allowHTML: true,
                       delimiter: ',',
                       editItems: true,
                       maxItemCount: 5,
                       removeItemButton: true,
                     }
                   );
        });
        
        
        function deleteSession(sessionId) {
            Swal.fire({
                title: 'Əminsiniz?',
                text: "Bu sessiyanı silmək istədiyinizə əminsiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Ləğv et'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("account.profile.session.delete") }}',
                        type: 'DELETE',
                        data: {
                            session_id: sessionId,
                        },
                        success: function(response) {
                            Swal.fire(
                                'Silindi!',
                                response.responseJSON?.message ?? 'Sessiya uğurla silindi.',
                                'success'
                            ).then(() => {
                                $(`[data-id="${sessionId}"]`).remove();
                            });
                        },
                        error: function(xhr, status, error) {
                            console.log(xhr);
                            Swal.fire(
                                'Xəta!',
                                xhr.responseJSON?.message ?? 'Sessiya silinərkən xəta baş verdi.',
                                'error'
                            );
                        }
                    });
                }
            })
        }
        
        
        function deleteAllSessions(e) {
            Swal.fire({
                title: 'Əminsiniz?',
                text: "Bütün sessiyaları silmək istədiyinizə əminsiniz?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Bəli, sil!',
                cancelButtonText: 'Ləğv et'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: '{{ route("account.profile.sessions.delete") }}',
                        type: 'DELETE',
                        success: function(response) {
                            Swal.fire(
                                'Silindi!',
                                response.responseJSON?.message ?? 'Sessiyalar uğurla silindi.',
                                'success'
                            ).then(() => {
                                $(`.session-row`).each(function(index){
                                    console.log(index);
                                    if(index!=0)
                                        $( this ).remove();
                                })
                                $(e.target).remove()
                            });
                        },
                        error: function(xhr, status, error) {
                            Swal.fire(
                                'Xəta!',
                                xhr.responseJSON?.message ?? 'Sessiyaları silinərkən xəta baş verdi.',
                                'error'
                            );
                        }
                    });
                }
            })
        }
    </script>
@endpush
@endsection
