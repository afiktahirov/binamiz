@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row mb-5">
        <div>
            <div class="card mt-4" id="2fa">
                <div class="card-header d-flex">
                    <h5 class="mb-0">Avtomobil axtarışı</h5>
                </div>
                <div class="card-body d-flex justify-content-center align-items-center">
                    <div class="plate_search ">
                        <div class="row plate_search_inputs">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select class="form-control" id="region_number" name="region_number">
                                        <option value="">Bütün regionlar</option>
                                        @foreach($regionNumbers as $number)
                                            <option value="{{ $number->region_number }}">{{ $number->region_number }} - {{ $number->region_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">

                                    <select class="form-control" id="series_first_letter" name="series_first_letter">
                                        <option value=""></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                        <option value="J">J</option>
                                        <option value="K">K</option>
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="N">N</option>
                                        <option value="O">O</option>
                                        <option value="P">P</option>
                                        <option value="R">R</option>
                                        <option value="S">S</option>
                                        <option value="T">T</option>
                                        <option value="U">U</option>
                                        <option value="V">V</option>
                                        <option value="W">W</option>
                                        <option value="X">X</option>
                                        <option value="Y">Y</option>
                                        <option value="Z">Z</option>
                                        <option value="Q">Q</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select class="form-control" id="series_second_letter" name="series_second_letter">
                                        <option value=""></option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                        <option value="D">D</option>
                                        <option value="E">E</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                        <option value="H">H</option>
                                        <option value="J">J</option>
                                        <option value="K">K</option>
                                        <option value="L">L</option>
                                        <option value="M">M</option>
                                        <option value="N">N</option>
                                        <option value="O">O</option>
                                        <option value="P">P</option>
                                        <option value="R">R</option>
                                        <option value="S">S</option>
                                        <option value="T">T</option>
                                        <option value="U">U</option>
                                        <option value="V">V</option>
                                        <option value="W">W</option>
                                        <option value="X">X</X>
                                        <option value="Y">Y</option>
                                        <option value="Z">Z</option>
                                        <option value="Q">Q</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="plate_number" name="plate_number">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" onclick="searchVehicleNumbers()" class="btn btn-primary">Axtar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    .plate_search {
        background-image: url(https://www.autonet.az/web/img/plate_bg.png);
        background-repeat: no-repeat;
        width: 680px;
        height: 80px;
        position: relative;
        background-size: contain;
    }
    .plate_search_inputs {
      padding: 20px;
      margin-left: 30px;
    }
    .select2-container--default .select2-selection--single {
        height: 38px; /* Adjust the height as needed */
        border: 1px solid #d2d6da;
    }
    #plate_number{
        font-size: 1rem !important;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 38px; /* Vertically center the text */
    }
    </style>
    <div class="vehicle-container">
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
                        @if($vehicle->active)
                            <span class="status-active">Aktiv</span>
                        @else
                            <span class="status-inactive">Inactive</span>
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
@include('account.vehicle.partials.show-modal')
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#plate_number').on('input', function() {
            var value = $(this).val();
            var newValue = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            if (newValue.length > 3) {
                newValue = newValue.slice(0, 3); // Limit to 3 characters
            }
            $(this).val(newValue);
        });
        $("#region_number").select2();
        $("#series_first_letter").select2();
        $("#series_second_letter").select2();
    });
    
    function searchVehicleNumbers(){
        var regionNumber = $("#region_number").val();
        var firstLetter = $("#series_first_letter").val();
        var secondLetter = $("#series_second_letter").val();
        var plateNumber = $('#plate_number').val();
        console.log(regionNumber,firstLetter,secondLetter,plateNumber)
        
    }
</script>
@endpush
