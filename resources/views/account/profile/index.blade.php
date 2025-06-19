@extends('layouts.app')
@section('content')

<div class="container-fluid py-4">
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
                                <label for="contact_numbers" class="form-label">Contact Numbers</label>
                                <div id="contact_numbers_container">
                                    @if(Auth::user()->contact_numbers)
                                        @foreach(Auth::user()->contact_numbers as $index => $contact_number)
                                            <div class="input-group mb-2">
                                                <input type="text" class="form-control" name="contact_numbers[]" value="{{ $contact_number['fields']['phone'] ?? '' }}">
                                                @if($index > 0)
                                                    <div class="input-group-append">
                                                        <button class="btn btn-danger remove_contact_number" type="button">Remove</button>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="input-group mb-2">
                                            <input type="text" class="form-control" name="contact_numbers[]">
                                        </div>
                                    @endif
                                </div>
                                <button id="add_contact_number" type="button" class="btn btn-secondary">+</button>
                            </div>
                             
                        </div>

                        <div class="row">
                            

                        </div>

                        <div class="row">
                            
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

@push('scripts')
    <script>
        $(document).ready(function() {
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
