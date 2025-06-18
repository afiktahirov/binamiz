@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
    <div class="d-sm-flex justify-content-between">
        <div>
          <a href="{{ route('account.application.create') }}" class="btn btn-primary btn-icon">
            Yeni müraciət əlavə et
          </a>
        </div>
        {{-- <div class="d-flex">
          <div class="dropdown d-inline">
            <a href="javascript:;" class="btn btn-outline-dark dropdown-toggle " data-bs-toggle="dropdown" id="navbarDropdownMenuLink2">
              Filters
            </a>
            <ul class="dropdown-menu dropdown-menu-lg-start px-2 py-3" aria-labelledby="navbarDropdownMenuLink2" data-popper-placement="left-start">
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Paid</a></li>
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Refunded</a></li>
              <li><a class="dropdown-item border-radius-md" href="javascript:;">Status: Canceled</a></li>
              <li>
                <hr class="horizontal dark my-2">
              </li>
              <li><a class="dropdown-item border-radius-md text-danger" href="javascript:;">Remove Filter</a></li>
            </ul>
          </div>
          <button class="btn btn-icon btn-outline-dark ms-2 export" data-type="csv" type="button">
            <span class="btn-inner--icon"><i class="ni ni-archive-2"></i></span>
            <span class="btn-inner--text">Export CSV</span>
          </button>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <h6>Applications List</h6>
                    <h1>{{ session('success') }}</h1>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Müraciət başlıq</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Müraciət tarixi</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Müraciət növü</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Müraciətə baxan əməkdaş</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Müraciətin statusu</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($applications as $application)
                                <tr>
                                    <td>
                                        <div class="d-flex px-2 py-1">
                                            <div class="d-flex flex-column justify-content-center">
                                                <h6 class="mb-0 text-sm">{{ $application->title }}</h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $application->created_at->format('d.m.Y') }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $application->type->value }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="text-sm font-weight-bold mb-0">
                                            {{ $application->assignedUser?->name }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm bg-{{ $application->status->color() }}">
                                            {{ $application->status->value }}
                                        </span>
                                    </td>
                                    <td class="align-middle d-flex justify-content-end">
                                        @if($application->status == \App\Enums\ApplicationStatusEnum::PENDING)
                                        <a href="{{ route('account.application.edit', $application->id) }}"
                                            class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-pencil"></i> Edit
                                        </a>
                                        @endif
                                        <a href="{{ route('account.application.show', $application->id) }}" 
                                           class="btn btn-link text-secondary mb-0">
                                            <i class="fa fa-eye"></i> View
                                        </a>
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
</div>
@endsection