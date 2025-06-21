@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5>{{ $application->title }}</h5>
                </div>
                <div class="card-body">
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('account.application.update', $application->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group mt-4">
                            <label class="form-control-label">Müraciət başlığı <span class="text-danger">*</span></label>
                            <input class="form-control 
                                @error('title') is-invalid @enderror" 
                                value="{{ old('title', $application->title) }}"
                                name="title" 
                                rows="5" />
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="form-control-label">Müraciət növü <span class="text-danger">*</span></label>
                                    <select class="form-control @error('type') is-invalid @enderror" name="type">
                                        @foreach (\App\Enums\ApplicationTypeEnum::cases() as $type)
                                            <option value="{{ $type->value }}" {{ (old('type', $application->type) == $type->value) ? 'selected' : '' }}>
                                                {{ $type->label() }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label class="form-control-label">Müraciət məzmunu <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror" name="content" rows="5">{{ old('content', $application->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mt-4">
                            <label class="form-control-label">Əlavələr</label>
                            <div class="row g-3">
                                @foreach($application->getMedia('attachments') as $media)
                                <div class="col-md-3 col-sm-4 col-6">
                                    <div class="border rounded p-2">
                                        @if($media->mime_type == 'image/jpeg' || $media->mime_type == 'image/png')
                                        <a href="#" data-bs-toggle="modal" data-bs-target="#attachmentModal{{ $media->id }}">
                                            <img src="{{ $media->getUrl() }}" class="img-fluid rounded" style="max-height: 50px; width: auto;" alt="attachment">
                                        </a>

                                        <div class="modal fade" id="attachmentModal{{ $media->id }}" tabindex="-1" aria-labelledby="attachmentModalLabel{{ $media->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-lg">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="attachmentModalLabel{{ $media->id }}">{{ $media->file_name }}</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <img src="{{ $media->getUrl() }}" class="img-fluid" alt="attachment">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="d-flex justify-content-between align-items-center mt-2">
                                            <small>{{ $media->file_name }}</small>
                                            <a href="{{ route('account.application.download', ['application' => $application->id, 'media' => $media->id]) }}" class="btn btn-sm btn-primary">
                                                <i class="fas fa-download"></i>
                                            </a>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="remove_attachments[]" value="{{ $media->id }}" id="removeAttachment{{ $media->id }}">
                                                <label class="form-check-label" for="removeAttachment{{ $media->id }}">Sil</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group mt-4">
                            <label class="form-control-label">Yeni əlavələr</label>
                            <input type="file" name="attachments[]" class="form-control @error('attachments.*') is-invalid @enderror" multiple>
                            @error('attachments.*')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <div class="form-group mt-5">
                            <label class="form-control-label">Şərhlər</label>
                            <p>
                                <a class="btn btn-primary" data-bs-toggle="collapse" href="#commentsCollapse" role="button" aria-expanded="false" aria-controls="commentsCollapse">
                                    Şərhləri göstər/gizlə
                                </a>
                            </p>
                            <div class="collapse" id="commentsCollapse">
                                <div class="card">
                                    <div class="card-body">
                                        @if(isset($comments) && count($comments) > 0)
                                            @foreach($comments as $comment)
                                                <div class="d-flex {{ $comment->user_id == Auth::id() ? 'flex-row-reverse justify-content-start' : 'flex-start' }} mb-4">
                                                    <img class="rounded-circle shadow-1-strong {{ $comment->user_id == Auth::id() ? 'ms-3' : 'me-3' }}"
                                                         src="https://ui-avatars.com/api/?name={{ urlencode($comment->user->full_name) }}" alt="avatar" width="40"
                                                         height="40"/>
                                                    <div>
                                                        <h6 class="fw-bold mb-1">{{ $comment->user->full_name }}</h6>
                                                        <div class="d-flex align-items-center mb-1">
                                                            <p class="text-muted small mb-0">
                                                                {{ $comment->created_at->diffForHumans() }}
                                                            </p>
                                                        </div>
                                                        <p class="mb-0">
                                                            {{ $comment->comment }}
                                                        </p>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <p>Hələlik şərh yoxdur.</p>
                                        @endif
                                        <div class="mt-3">
                                            <label class="form-control-label">Yeni Şərh</label>
                                            <textarea name="comment" class="form-control @error('comment') is-invalid @enderror" rows="3"></textarea>
                                            @error('comment')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        

                        <div class="mt-4">
                            <a href="{{ route('account.application.show', $application->id) }}" class="btn btn-secondary">Geri</a>
                            <button type="submit" class="btn btn-primary">Yadda saxla</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection