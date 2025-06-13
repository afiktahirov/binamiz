@extends('layouts.app')
@section('content')
    @php
        use App\Enums\{ApplicationTypeEnum, ApplicationDepartmentEnum};
    @endphp
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex align-items-center">
                            <p class="mb-0">Yeni Müraciət</p>
                        </div>
                    </div>
                    <div class="card-body">
                        <form id="create-application-form" action="{{ route('account.application.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">Müraciət növü:</label>
                                    <select class="form-select" id="type" name="type">
                                        @foreach (ApplicationTypeEnum::cases() as $type)
                                            <option value="{{ $type->value }}">{{ $type->label() }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="department" class="form-label">Bölmə:</label>
                                    <select class="form-select" id="department" name="department">
                                        @foreach (ApplicationDepartmentEnum::cases() as $department)
                                            <option value="{{ $department->value }}">{{ $department->label() }}</option>
                                        @endforeach
                                    </select>
                                    @error('department')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="title" class="form-label">Başlıq: <span class="text-danger">*</span></label>
                                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title">
                                @error('title')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="content" class="form-label">Müraciət mətni: <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="3" required></textarea>
                                @error('content')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="attachment" class="form-label">Şəkil:</label>
                                <input accept="image/png, image/jpeg" type="file" class="form-control" id="attachment" name="attachments[]" multiple>
                                @error('attachments')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @if($errors->has('attachments.*'))
                                    @foreach($errors->get('attachments.*') as $message)
                                        <div class="text-danger">{{ $message[0] }}</div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Göndər</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
