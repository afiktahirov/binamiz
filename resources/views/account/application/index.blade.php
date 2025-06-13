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
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table align-items-center mb-0">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Title</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Expires</th>
                                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
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
                                            {{ \Carbon\Carbon::parse($application->expires_at)->format('M d, Y') }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge badge-sm {{ $application->is_voted ? 'bg-success' : 'bg-warning' }}">
                                            {{ $application->is_voted ? 'Voted' : 'Not Voted' }}
                                        </span>
                                    </td>
                                    <td class="align-middle">
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