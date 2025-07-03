@extends('layouts.app')
@section('content')
<div class="container-fluid">

    @include('partials.search-plate-numbers')
    
    <div class="card mt-4" id="2fa">
        <div class="card-header pb-0">
            <h4 class="mb-0">Mənim nəqliyyat vasitələrim</h4>
        </div>
        <div class="vehicle-container card-body">
            @foreach($vehicles as $vehicle)
                <div class="vehicle-card" onclick="showDetail({{ $vehicle->id }})" data-id="1" data-bs-toggle="modal" data-bs-target="#detail-modal">
                    <div class="vehicle-card-header text-center">
                        <div class="car-icon">
                            <i class="fas fa-car"></i>
                        </div>
                        <div class="plate-number">{{ $vehicle->fullNumber() }}</div>
                    </div>
                    <div class="card-body">
                        <div class="info-row">
                            <span class="info-label">Status:</span>
                            @if($vehicle->is_active)
                                <span class="status-active">Aktiv</span>
                            @else
                                <span class="status-inactive">Passiv</span>
                            @endif
                        </div>
    
                        <div class="info-row">
                            <span class="info-label">Markası:</span>
                            <span class="info-value">{{ $vehicle->brand?->name ?? '----' }}</span>
                        </div>
    
                        <div class="info-row">
                            <span class="info-label">Modeli:</span>
                            <span class="info-value">{{ $vehicle->vehicleType?->name ?? '----'}}</span>
                        </div>
    
                        <div class="info-row">
                            <span class="info-label">Rəngi:</span>
                            <span class="info-value">{{ $vehicle->color?->name ?? '----'}}</span>
                        </div>
    
                        <div class="info-row">
                            <span class="info-label">Son giriş icazəsi:</span>
                            <span class="info-value">----</span>
                        </div>
    
                        <div class="info-row">
                            <span class="info-label">Bağlı olduğu qaraj:</span>
                            <span class="info-value">17D / 4</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
@include('account.vehicle.partials.show-modal')
@endsection