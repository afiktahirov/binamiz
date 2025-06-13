@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    @if($services->isEmpty())
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow text-center">
                    <div class="card-body">
                        <i class="fas fa-exclamation-triangle fa-4x text-warning mb-3"></i>
                        <h5 class="card-title text-black">Xidmət mövcud deyil!</h5>
                        {{-- <p class="card-text text-muted">Xidmət əlavə etmək üçün <a href="#">buraya</a> daxil olun.</p> --}}
                    </div>
                </div>
            </div>
        </div>
    @else
    <div class="row">

        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Xidmətlər Siyahısı</h6>
                    </h6>
                </div>
                <div class="card-body px-0 pt-0 pb-2">
                    <div class="table-responsive p-0">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Xidmət Növü</th> 
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                        Xidmət Adı</th> 
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Xidmət Göstərən</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Xidmət Reytinqi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                        Əlaqə Nömrəsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $service)
                                    <tr>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $service->serviceType->name }}</p>
                                        </td>
                                        <td>
                                            <p class="text-xs font-weight-bold mb-0">{{ $service->name }}</p>
                                        </td>
                                        <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $service->provider }}</p>
                                        </td>
                                        <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $service->rating }}</p>
                                        </td>
                                        <td>
                                                <p class="text-xs font-weight-bold mb-0">
                                                    @foreach (collect($service->contact_numbers)->map(function ($item) {
                                                        return $item['fields']['phone'] ?? null;
                                                    })->filter() as $phone)
                                                        <a href="tel:{{ $phone }}">{{ $phone }}</a>@if (!$loop->last), @endif
                                                    @endforeach
                                                </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection