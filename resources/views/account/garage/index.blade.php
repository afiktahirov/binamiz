@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        
        @if($garages->isEmpty())
            <div class="col-12 text-center">
                <div class="alert alert-warning" role="alert">
                    <strong class="text-black">Hələ garajınız yoxdur!</strong>
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="d-flex justify-content-between card-header pb-0">
                        <div>
                            <h6>Garajlar</h6>
                        </div>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Company</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Complex</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Garaj Nömrəsi</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Ölçüsü</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Yer Sayı</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Status</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($garages as $garage)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $garage->company->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $garage->complex->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $garage->garage_number }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $garage->size }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $garage->place_count }}</p>
                                            </td>
                                            <td class="align-middle text-center text-sm">
                                                <span class="badge badge-sm bg-gradient-{{ $garage->status == 'mülkiyyətdə' ? 'primary' : 'secondary' }}">{{ $garage->status }}</span>
                                            </td>                                        
                                            <td class="align-middle">
                                                <a href="javascript:;" data-bs-toggle="modal" onclick="showDetail({{ $garage->id }})" data-bs-target="#detail-modal" class="text-bold font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Garaj Detalları">
                                                    Preview
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{ $garages->links() }}
            </div>
        </div>
        @endif
    </div>
@endsection

@include('account.garage.partials.show-modal')
