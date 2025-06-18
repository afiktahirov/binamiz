@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5>{{ $application->title }}</h5>
                    @if($application->status == \App\Enums\ApplicationStatusEnum::PENDING)
                        <a href="{{ route('account.application.edit', $application->id) }}" class="btn btn-sm btn-primary">Redaktə et</a>
                    @endif
                    </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Müraciət tarixi</label>
                                <p class="form-control-static">{{ $application->created_at->format('d.m.Y') }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Müraciət növü</label>
                                <p class="form-control-static">{{ $application->type->label() }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Müraciətə baxan əməkdaş</label>
                                <p class="form-control-static">{{ $application->assignedUser?->name ?? 'Təyin edilməyib' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label">Status</label>
                                <p class="badge badge-sm bg-{{ $application->status->color() }}">
                                    {{ $application->status->label() }}
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-4">
                        <label class="form-control-label">Müraciət məzmunu</label>
                        <div class="border rounded p-3">
                            {!! nl2br(e($application->content)) !!}
                        </div>
                    </div>

                    @if($application->getMedia('attachments')->count() > 0)
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
                                        <a href="{{ route('account.application.download', ['application' => $application->id, 'media' => $media->id]) }}" 
                                           class="btn btn-sm btn-primary">
                                            <i class="fas fa-download"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection