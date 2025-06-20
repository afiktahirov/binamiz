@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        
        @if($vehicles->isEmpty())
            <div class="col-12 text-center">
                <div class="alert alert-warning" role="alert">
                    <strong class="text-black">Hələ Nəqliyyat vasitəniz yoxdur!</strong>
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Nəqliyyat Vasitələrim</h6>
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
                                            Building</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Garage</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Color</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Brand</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Number</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($vehicles as $vehicle)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $vehicle->company?->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $vehicle->complex?->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $vehicle->building?->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $vehicle->garage?->garage_number }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $vehicle->color?->name }}</p>
                                            </td>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $vehicle->brand?->name }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">{{ $vehicle->foreign_number }}</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" data-bs-toggle="modal" onclick="showDetail({{ $vehicle->id }})" data-bs-target="#detail-modal" class="text-bold font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Nəqliyyat Vasitəsi Detalları">
                                                    Preview
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($vehicles->hasMorePages())
                        <div class="card-footer">
                            <button class="btn btn-primary load-more-btn" data-next-page="{{ $vehicles->nextPageUrl() }}">
                                Load More
                                <div class="spinner-border spinner-border-sm ms-2 d-none" role="status" aria-hidden="true"></div>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endif
    </div>

    @include('account.vehicle.partials.show-modal')
@endsection

@push('scripts')
<script>
    console.log('Load More script loaded');
    $(document).ready(function() {
        console.log('Document is ready');
        $('.load-more-btn').on('click', function() {
            console.log('Load more button clicked');
            var nextPageUrl = $(this).data('next-page');
            var button = $(this);
            var spinner = button.find('.spinner-border');

            if (nextPageUrl) {
                $.ajax({
                    url: nextPageUrl,
                    type: 'GET',
                    dataType: 'html', // Expect HTML content
                    beforeSend: function() {
                        button.prop('disabled', true); // Disable button
                        spinner.removeClass('d-none'); // Show spinner
                    },
                    success: function(data) {
                        // Parse the returned HTML
                        var newRows = $(data).find('tbody').html();

                        // Append the new rows to the table body
                        $('tbody').append(newRows);

                        // Update the next page URL
                        var newNextPageUrl = $(data).find('.load-more-btn').data('next-page');
                        button.data('next-page', newNextPageUrl);

                        // Change button text back
                        button.prop('disabled', false); // Enable button
                        spinner.addClass('d-none'); // Hide spinner

                        // If there are no more pages, hide the button
                        if (!newNextPageUrl) {
                            button.hide();
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        console.error('Error loading more data:', textStatus, errorThrown);
                        button.prop('disabled', false); // Enable button
                        spinner.addClass('d-none'); // Hide spinner
                    }
                });
            } else {
                button.hide(); // Hide button if no more pages
            }
        });
    });
</script>
@endpush
