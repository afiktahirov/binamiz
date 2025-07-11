@extends('layouts.app')
@section('content')

@php
  $chartColors = [];
  for ($i = 0; $i < count($chartData['data']); $i++ ) {
    $chartColors[] = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
  }
@endphp


<div class="container-fluid">
      <div class="row">
        <div class="col-lg-6 col-12 d-flex ms-auto">
          <a href="javascript:;" class="btn btn-icon btn-outline-secondary ms-auto">
            <span class="btn-inner--text">Export</span>
            <span class="btn-inner--icon ms-2"><i class="ni ni-folder-17"></i></span>
          </a>
          <div class="dropleft ms-3">
            <button class="btn bg-primary dropdown-toggle" type="button" id="dropdownImport" data-bs-toggle="dropdown" aria-expanded="false">
              Today
            </button>
            <ul class="dropdown-menu" aria-labelledby="dropdownImport" style="">
              <li><a class="dropdown-item" href="javascript:;">Yesterday</a></li>
              <li><a class="dropdown-item" href="javascript:;">Last 7 days</a></li>
              <li><a class="dropdown-item" href="javascript:;">Last 30 days</a></li>
            </ul>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Ümumi mənzil</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $cardData['total_apartments'] }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                    <i class="fa-solid fa-building"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">İstifadədə olan mənzil</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $cardData['in_use_apartments'] }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                    <i class="fa-solid fa-building"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Ümumi Qaraj</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{ $cardData['total_garages'] }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md d-flex align-items-center justify-content-center">
                      <svg width="24" height="24" style="color: white"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M0 488L0 171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4L640 488c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24l0-264c0-17.7-14.3-32-32-32l-384 0c-17.7 0-32 14.3-32 32l0 264c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24zM254.3 293.4L242.2 328l155.6 0-12.1-34.6c-1.1-3.2-4.2-5.4-7.6-5.4l-116.3 0c-3.4 0-6.4 2.2-7.6 5.4zM188.9 335L209 277.5c7.9-22.5 29.1-37.5 52.9-37.5l116.3 0c23.8 0 45 15.1 52.9 37.5L451.1 335c17.2 9.5 28.9 27.9 28.9 49l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-16-192 0 0 16c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96c0-21.1 11.7-39.5 28.9-49zM240 424a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm184-24a24 24 0 1 0 -48 0 24 24 0 1 0 48 0z"/></svg>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">İstifadədə olan qaraj</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{ $cardData['in_use_garages'] }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                    <div class="icon icon-shape bg-primary shadow text-center border-radius-md d-flex align-items-center justify-content-center">
                      <svg width="24" height="24" style="color: white"  xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512"><!--! Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M0 488L0 171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4L640 488c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24l0-264c0-17.7-14.3-32-32-32l-384 0c-17.7 0-32 14.3-32 32l0 264c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24zM254.3 293.4L242.2 328l155.6 0-12.1-34.6c-1.1-3.2-4.2-5.4-7.6-5.4l-116.3 0c-3.4 0-6.4 2.2-7.6 5.4zM188.9 335L209 277.5c7.9-22.5 29.1-37.5 52.9-37.5l116.3 0c23.8 0 45 15.1 52.9 37.5L451.1 335c17.2 9.5 28.9 27.9 28.9 49l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-16-192 0 0 16c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96c0-21.1 11.7-39.5 28.9-49zM240 424a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm184-24a24 24 0 1 0 -48 0 24 24 0 1 0 48 0z"/></svg>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Ümumi obyekt</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{ $cardData['total_objects'] }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                    <i class="ni ni-shop text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">İstifadədə olan obyekt</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{ $cardData['in_use_objects'] }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                    <i class="ni ni-shop text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Qeydiyyata olan avto.sayı</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ $cardData['in_use_vehicles'] }}
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-primary shadow text-center border-radius-md">
                    <i class="ni ni-delivery-fast text-lg opacity-10" aria-hidden="true"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row mt-4">
        <div class="col-lg-7 col-md-12">
          <div class="card">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">Cari ildə bina yığımı</h6>
              <div class="d-flex align-items-center">
                @foreach ($chartData['data'] as $key => $value)
                  <span class="badge badge-md badge-dot me-4">
                    <i class="" style="background-color: {{ $chartColors[$loop->index] }};"></i>
                    <span class="text-dark text-xs">{{ $key }}</span>
                  </span>
                @endforeach
              </div>
            </div>
            <div class="card-body p-3">
              <div class="chart">
                <canvas id="chart-line" class="chart-canvas" height="300" style="display: block; box-sizing: border-box; height: 300px; width: 527px;" width="527"></canvas>
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-12 mt-4 mt-lg-0">
          <div class="card h-100 mt-4 mt-md-0">
            <div class="card-header pb-0 p-3">
              <div class="d-flex align-items-center">
                <h6>Cari ayda binalar üzrə yığım</h6>
                {{-- <button type="button" class="btn btn-icon-only btn-rounded btn-outline-success mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Data is based from sessions and is 100% accurate" data-bs-original-title="Data is based from sessions and is 100% accurate">
                  <i class="fas fa-check"></i>
                </button> --}}
                <h5 type="button" class="mb-0 ms-2 d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Cari ayda binalar üzrə yığımların cəmi" data-bs-original-title="Cari ayda binalar üzrə yığımların cəmi">
                  {{ $current_month_total_debt_amount }} AZN
                </h5>
              </div>
            </div>
            <div class="card-body px-3 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bina adı</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Yığılmalı məbləğ</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hazırkı yığım</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Hazırki yığım %</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($buildingCardData as $data)
                      <tr>
                        <td>
                          <p class="text-sm font-weight-bold mb-0">{{ $data['building_name'] }}</p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0">{{ $data['total_amount'] }} AZN</p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0">{{ $data['total_debt_amount'] }}</p>
                        </td>
                        <td>
                          <p class="text-sm font-weight-bold mb-0">{{ $data['total_debt_percent'] }}%</p>
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
      <div class="row mt-4">
        <div class="col-sm-6">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="d-flex align-items-center">
                <h6 class="mb-0">Social</h6>
                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-secondary mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="See how much traffic do you get from social media" data-bs-original-title="See how much traffic do you get from social media">
                  <i class="fas fa-info"></i>
                </button>
              </div>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex align-items-center mb-2">
                      <a class="btn btn-facebook btn-simple mb-0 p-0" href="javascript:;">
                        <i class="fab fa-facebook fa-lg"></i>
                      </a>
                      <span class="me-2 text-sm font-weight-bold text-capitalize ms-2">Facebook</span>
                      <span class="ms-auto text-sm font-weight-bold">80%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-primary w-80" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex align-items-center mb-2">
                      <a class="btn btn-twitter btn-simple mb-0 p-0" href="javascript:;">
                        <i class="fab fa-twitter fa-lg"></i>
                      </a>
                      <span class="me-2 text-sm font-weight-bold text-capitalize ms-2">Twitter</span>
                      <span class="ms-auto text-sm font-weight-bold">40%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-primary w-40" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex align-items-center mb-2">
                      <a class="btn btn-reddit btn-simple mb-0 p-0" href="javascript:;">
                        <i class="fab fa-reddit fa-lg"></i>
                      </a>
                      <span class="me-2 text-sm font-weight-bold text-capitalize ms-2">Reddit</span>
                      <span class="ms-auto text-sm font-weight-bold">30%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-primary w-30" role="progressbar" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex align-items-center mb-2">
                      <a class="btn btn-youtube btn-simple mb-0 p-0" href="javascript:;">
                        <i class="fab fa-youtube fa-lg"></i>
                      </a>
                      <span class="me-2 text-sm font-weight-bold text-capitalize ms-2">Youtube</span>
                      <span class="ms-auto text-sm font-weight-bold">25%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-primary w-25" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="w-100">
                    <div class="d-flex align-items-center mb-2">
                      <a class="btn btn-slack btn-simple mb-0 p-0" href="javascript:;">
                        <i class="fab fa-slack fa-lg"></i>
                      </a>
                      <span class="me-2 text-sm font-weight-bold text-capitalize ms-2">Slack</span>
                      <span class="ms-auto text-sm font-weight-bold">15%</span>
                    </div>
                    <div>
                      <div class="progress progress-md">
                        <div class="progress-bar bg-primary w-15" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                      </div>
                    </div>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <div class="col-sm-6">
          <div class="card h-100 mt-4 mt-md-0">
            <div class="card-header pb-0 p-3">
              <div class="d-flex align-items-center">
                <h6>Pages</h6>
                <button type="button" class="btn btn-icon-only btn-rounded btn-outline-success mb-0 ms-2 btn-sm d-flex align-items-center justify-content-center ms-auto" data-bs-toggle="tooltip" data-bs-placement="bottom" aria-label="Data is based from sessions and is 100% accurate" data-bs-original-title="Data is based from sessions and is 100% accurate">
                  <i class="fas fa-check"></i>
                </button>
              </div>
            </div>
            <div class="card-body px-3 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center justify-content-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Page</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Page Views</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Avg. Time</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Bounce Rate</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">1. /bits</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">345</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">00:17:07</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">40.91%</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">2. /pages/argon-dashboard</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">520</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">00:23:13</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">30.14%</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">3. /pages/soft-ui-dashboard</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">122</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">00:3:10</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">54.10%</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">4. /bootstrap-themes</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">1,900</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">00:30:42</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">20.93%</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">5. /react-themes</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">1,442</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">00:31:50</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">34.98%</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">6. /product/argon-dashboard-angular</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">201</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">00:12:42</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">21.4%</p>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">7. /product/material-dashboard-pro</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">2,115</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">00:50:11</p>
                      </td>
                      <td>
                        <p class="text-sm font-weight-bold mb-0">34.98%</p>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection

@push('scripts')
<script>
    // var ctx = document.getElementById("chart-bars").getContext("2d");

    // new Chart(ctx, {
    //     type: "bar",
    //     data: {
    //         labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //         datasets: [{
    //             label: "Sales",
    //             tension: 0.4,
    //             borderWidth: 0,
    //             borderRadius: 4,
    //             borderSkipped: false,
    //             backgroundColor: "#fff",
    //             data: [450, 200, 100, 220, 500, 100, 400, 230, 500],
    //             maxBarThickness: 6
    //         }, ],
    //     },
    //     options: {
    //         responsive: true,
    //         maintainAspectRatio: false,
    //         plugins: {
    //             legend: {
    //                 display: false,
    //             }
    //         },
    //         interaction: {
    //             intersect: false,
    //             mode: 'index',
    //         },
    //         scales: {
    //             y: {
    //                 grid: {
    //                     drawBorder: false,
    //                     display: false,
    //                     drawOnChartArea: false,
    //                     drawTicks: false,
    //                 },
    //                 ticks: {
    //                     suggestedMin: 0,
    //                     suggestedMax: 500,
    //                     beginAtZero: true,
    //                     padding: 15,
    //                     font: {
    //                         size: 14,
    //                         family: "Inter",
    //                         style: 'normal',
    //                         lineHeight: 2
    //                     },
    //                     color: "#fff"
    //                 },
    //             },
    //             x: {
    //                 grid: {
    //                     drawBorder: false,
    //                     display: false,
    //                     drawOnChartArea: false,
    //                     drawTicks: false
    //                 },
    //                 ticks: {
    //                     display: false
    //                 },
    //             },
    //         },
    //     },
    // });


    var ctx1 = document.getElementById("chart-line")?.getContext("2d");
    var ctx2 = document.getElementById("chart-doughnut")?.getContext("2d");

    var gradientStroke1 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke1.addColorStop(1, 'rgba(203,12,159,0.2)');
    gradientStroke1.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke1.addColorStop(0, 'rgba(203,12,159,0)'); //purple colors

    var gradientStroke2 = ctx1.createLinearGradient(0, 230, 0, 50);

    gradientStroke2.addColorStop(1, 'rgba(20,23,39,0.2)');
    gradientStroke2.addColorStop(0.2, 'rgba(72,72,176,0.0)');
    gradientStroke2.addColorStop(0, 'rgba(20,23,39,0)'); //purple colors

 new Chart(ctx1, {
      type: "line",
      data: {
        // labels: ["Yanvar", "Fevral", "Mart", "Aprel", "May", "İyun", "İyul", "Avqust", "Sentyabr", "Oktyabr", "Noyabr", "Dekabr"],
        labels: @json($chartData['labels']),
        datasets: [
          @foreach ($chartData['data'] as $key => $value)
          @php
              $color = sprintf("#%06X", mt_rand(0, 0xFFFFFF));
          @endphp
            {
              label: "{{ $key }}",
              tension: 0.4,
              borderWidth: 0,
              pointRadius: 2,
              pointBackgroundColor: "{{ $chartColors[$loop->index] }}",
              borderColor: "{{ $chartColors[$loop->index] }}",
              borderWidth: 3,
              backgroundColor: gradientStroke2,
              data: @json($value),
              maxBarThickness: 6
            },            
          @endforeach
        ],
      },
      options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false,
          }
        },
        interaction: {
          intersect: false,
          mode: 'index',
        },
        scales: {
          y: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: false,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              padding: 10,
              color: '#9ca2b7'
            }
          },
          x: {
            grid: {
              drawBorder: false,
              display: true,
              drawOnChartArea: true,
              drawTicks: true,
              borderDash: [5, 5]
            },
            ticks: {
              display: true,
              color: '#9ca2b7',
              padding: 10
            }
          },
        },
      },
    });




    // Line chart
    // new Chart(ctx1, {
    //   type: "line",
    //   data: {
    //     labels: ["Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
    //     datasets: [{
    //         label: "Organic Search",
    //         tension: 0.4,
    //         borderWidth: 0,
    //         pointRadius: 2,
    //         pointBackgroundColor: "#cb0c9f",
    //         borderColor: "#cb0c9f",
    //         borderWidth: 3,
    //         backgroundColor: gradientStroke1,
    //         data: [50, 40, 300, 220, 500, 250, 400, 230, 500],
    //         maxBarThickness: 6
    //       },
    //       {
    //         label: "Referral",
    //         tension: 0.4,
    //         borderWidth: 0,
    //         pointRadius: 2,
    //         pointBackgroundColor: "#3A416F",
    //         borderColor: "#3A416F",
    //         borderWidth: 3,
    //         backgroundColor: gradientStroke2,
    //         data: [30, 90, 40, 140, 290, 290, 340, 230, 400],
    //         maxBarThickness: 6
    //       },
    //       {
    //         label: "Direct",
    //         tension: 0.4,
    //         borderWidth: 0,
    //         pointRadius: 2,
    //         pointBackgroundColor: "#17c1e8",
    //         borderColor: "#17c1e8",
    //         borderWidth: 3,
    //         backgroundColor: gradientStroke2,
    //         data: [40, 80, 70, 90, 30, 90, 140, 130, 200],
    //         maxBarThickness: 6
    //       },
    //     ],
    //   },
    //   options: {
    //     responsive: true,
    //     maintainAspectRatio: false,
    //     plugins: {
    //       legend: {
    //         display: false,
    //       }
    //     },
    //     interaction: {
    //       intersect: false,
    //       mode: 'index',
    //     },
    //     scales: {
    //       y: {
    //         grid: {
    //           drawBorder: false,
    //           display: true,
    //           drawOnChartArea: true,
    //           drawTicks: false,
    //           borderDash: [5, 5]
    //         },
    //         ticks: {
    //           display: true,
    //           padding: 10,
    //           color: '#9ca2b7'
    //         }
    //       },
    //       x: {
    //         grid: {
    //           drawBorder: false,
    //           display: true,
    //           drawOnChartArea: true,
    //           drawTicks: true,
    //           borderDash: [5, 5]
    //         },
    //         ticks: {
    //           display: true,
    //           color: '#9ca2b7',
    //           padding: 10
    //         }
    //       },
    //     },
    //   },
    // });


    // Doughnut chart
    
    // new Chart(ctx2, {
    //   type: "doughnut",
    //   data: {
    //     labels: ['Creative Tim', 'Github', 'Bootsnipp', 'Dev.to', 'Codeinwp'],
    //     datasets: [{
    //       label: "Projects",
    //       weight: 9,
    //       cutout: 60,
    //       tension: 0.9,
    //       pointRadius: 2,
    //       borderWidth: 2,
    //       backgroundColor: ['#2152ff', '#3A416F', '#f53939', '#a8b8d8', '#cb0c9f'],
    //       data: [15, 20, 12, 60, 20],
    //       fill: false
    //     }],
    //   },
    //   options: {
    //     responsive: true,
    //     maintainAspectRatio: false,
    //     plugins: {
    //       legend: {
    //         display: false,
    //       }
    //     },
    //     interaction: {
    //       intersect: false,
    //       mode: 'index',
    //     },
    //     scales: {
    //       y: {
    //         grid: {
    //           drawBorder: false,
    //           display: false,
    //           drawOnChartArea: false,
    //           drawTicks: false,
    //         },
    //         ticks: {
    //           display: false
    //         }
    //       },
    //       x: {
    //         grid: {
    //           drawBorder: false,
    //           display: false,
    //           drawOnChartArea: false,
    //           drawTicks: false,
    //         },
    //         ticks: {
    //           display: false,
    //         }
    //       },
    //     },
    //   },
    // });
  
    
</script>
@endpush