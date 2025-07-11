@extends('layouts.app')
@section('content')
    <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="row">
                        <div class="col-lg-6 col-7">
                            <h6>Projects</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-check text-info" aria-hidden="true"></i>
                                <span class="font-weight-bold ms-1">30 done</span> this month
                            </p>
                        </div>
                        <div class="col-lg-6 col-5 my-auto text-end">
                            <div class="dropdown float-lg-end pe-4">
                                <a class="cursor-pointer" id="dropdownTable" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v text-secondary"></i>
                                </a>
                                <ul class="dropdown-menu px-2 py-3 ms-sm-n4 ms-n5" aria-labelledby="dropdownTable">
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Action</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Another action</a></li>
                                    <li><a class="dropdown-item border-radius-md" href="javascript:;">Something else here</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body px-0 pb-2">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                            <tr>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Şirkət</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mülkiyyətçi</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Kompleks</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bina</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Blok</th>
                                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Mənzil Nömrəsi</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($flats as $flat)
                                <tr>
                                    <td class="align-middle">
                                        <span class="text-sm">{{ $flat->company->name ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm">{{ $flat->owner->full_name ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm">{{ $flat->complex->name ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm">{{ $flat->building->name ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm">{{ $flat->block->name ?? '-' }}</span>
                                    </td>
                                    <td class="align-middle">
                                        <span class="text-sm">{{ $flat->apartment_number }}</span>
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
@endsection
