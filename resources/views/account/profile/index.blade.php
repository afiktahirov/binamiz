@extends('layouts.app')
@section('content')

<div class="container-fluid py-4">
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
              <!-- Card Basic Info -->
              <div class="card mt-4" id="basic-info">
                <div class="card-header">
                  <h5>Basic Info</h5>
                </div>
                <div class="card-body pt-0">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="full_name" class="form-label">Full Name</label>
                            <input id="full_name" type="text" class="form-control @error('full_name') is-invalid @enderror" name="full_name" value="{{ old('full_name', Auth::user()->full_name) }}" autocomplete="full_name">
                            @error('full_name')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3 row">
                            <div class="col-md-6 mb-3">
                               <label for="gender" class="form-label">Gender</label>
                               <select id="gender" class="form-control @error('gender') is-invalid @enderror" name="gender">
                                   <option value="0" {{ old('gender', Auth::user()->gender) == 0 ? 'selected' : '' }}>Man</option>
                                   <option value="1" {{ old('gender', Auth::user()->gender) == 1 ? 'selected' : '' }}>Woman</option>
                               </select>
                               @error('gender')
                                   <div class="text-danger">{{ $message }}</div>
                               @enderror
                           </div>
                           <div class="col-md-6 mb-3">
                               <label for="birthdate" class="form-label">Birthdate</label>
                               <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate', Auth::user()->birthdate) }}" autocomplete="birthdate">
                               @error('birthdate')
                               <div class="text-danger">{{ $message }}</div>
                               @enderror
                           </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}" required autocomplete="email">
                            @error('email')
                            <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label  for="contact_numbers" class="form-label">Skills</label>
                            <input id="contact_numbers" name="contact_numbers" class="form-control" type="text" value="jQuery,Script,Net">
                        </div>
                    </div>
                </div>
              </div>
              <!-- Card Change Password -->
              <div class="card mt-4" id="password">
                <div class="card-header">
                  <h5>Change Password</h5>
                </div>
                <div class="card-body pt-0">
                  <label class="form-label">Current password</label>
                  <div class="form-group">
                    <input class="form-control" type="password" placeholder="Current password" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <label class="form-label">New password</label>
                  <div class="form-group">
                    <input class="form-control" type="password" placeholder="New password" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <label class="form-label">Confirm new password</label>
                  <div class="form-group">
                    <input class="form-control" type="password" placeholder="Confirm password" onfocus="focused(this)" onfocusout="defocused(this)">
                  </div>
                  <h5 class="mt-5">Password requirements</h5>
                  <p class="text-muted mb-2">
                    Please follow this guide for a strong password:
                  </p>
                  <ul class="text-muted ps-4 mb-0 float-start">
                    <li>
                      <span class="text-sm">One special characters</span>
                    </li>
                    <li>
                      <span class="text-sm">Min 6 characters</span>
                    </li>
                    <li>
                      <span class="text-sm">One number (2 are recommended)</span>
                    </li>
                    <li>
                      <span class="text-sm">Change it often</span>
                    </li>
                  </ul>
                  <button class="btn bg-gradient-dark btn-sm float-end mt-6 mb-0">Update password</button>
                </div>
              </div>
              <!-- Card Sessions -->
              <div class="card mt-4" id="sessions">
                <div class="card-header pb-3">
                  <h5>Sessions</h5>
                  <p class="text-sm">This is a list of devices that have logged into your account. Remove those that you do not recognize.</p>
                </div>
                <div class="card-body pt-0">
                  <div class="d-flex align-items-center">
                    <div class="text-center w-5">
                      <i class="fas fa-desktop text-lg opacity-6"></i>
                    </div>
                    <div class="my-auto ms-3">
                      <div class="h-100">
                        <p class="text-sm mb-1">
                          Bucharest 68.133.163.201
                        </p>
                        <p class="mb-0 text-xs">
                          Your current session
                        </p>
                      </div>
                    </div>
                    <span class="badge badge-success badge-sm my-auto ms-auto me-3">Active</span>
                    <p class="text-secondary text-sm my-auto me-3">EU</p>
                    <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                      <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                    </a>
                  </div>
                  <hr class="horizontal dark">
                  <div class="d-flex align-items-center">
                    <div class="text-center w-5">
                      <i class="fas fa-desktop text-lg opacity-6"></i>
                    </div>
                    <p class="my-auto ms-3">Chrome on macOS</p>
                    <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                    <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                      <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                    </a>
                  </div>
                  <hr class="horizontal dark">
                  <div class="d-flex align-items-center">
                    <div class="text-center w-5">
                      <i class="fas fa-mobile text-lg opacity-6"></i>
                    </div>
                    <p class="my-auto ms-3">Safari on iPhone</p>
                    <p class="text-secondary text-sm ms-auto my-auto me-3">US</p>
                    <a href="javascript:;" class="text-primary text-sm icon-move-right my-auto">See more
                      <i class="fas fa-arrow-right text-xs ms-1" aria-hidden="true"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
          </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex align-items-center">
                        <p class="mb-0">Profil</p>
                    </div>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('account.profile.update') }}">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <div class="">
                                    <img src="https://plus.unsplash.com/premium_photo-1689568126014-06fea9d5d341?fm=jpg&q=60&w=3000&ixlib=rb-4.1.0&ixid=M3wxMjA3fDB8MHxzZWFyY2h8MXx8cHJvZmlsZXxlbnwwfHwwfHx8MA%3D%3D" alt="Logo" style="max-width: 100px;">
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <p for="company_name" class="form-label">Company Name: {{ Auth::user()->company->name ?? '' }}</p>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password">
                                <small class="form-text text-muted">Leave blank to keep current password.</small>
                                @error('password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="new_password" class="form-label">New Password</label>
                                <input id="new_password" type="password" class="form-control @error('new_password') is-invalid @enderror" name="new_password" autocomplete="new-password">
                                @error('new_password')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="new_password_confirmation" class="form-label">Confirm New Password</label>
                                <input id="new_password_confirmation" type="password" class="form-control" name="new_password_confirmation" autocomplete="new-password">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Update Profile</button>
                        </div>
                    </form>
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
	background: #f97316;
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

</style>
@push('scripts')
    <script>

        $(document).ready(function() {
            $('#contact_numbers').tagsInput();

            $("#add_contact_number").click(function() {
                $("#contact_numbers_container").append('<div class="input-group mb-2"><input type="text" class="form-control" name="contact_numbers[]"><div class="input-group-append"><button class="btn btn-danger remove_contact_number" type="button">Remove</button></div></div>');
            });

            $(document).on('click', '.remove_contact_number', function() {
                $(this).closest('.input-group').remove();
            });
        });
    </script>
@endpush
@endsection
