@extends('layouts.app')
@section('content')
    <div class="container-fluid py-4">
        
        @if($apartments->isEmpty())
            <div class="col-12 text-center">
                <div class="alert alert-warning" role="alert">
                    <strong class="text-black">Hələ Mənziliniz yoxdur!</strong>
                </div>
            </div>
        @else
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Mənzillərim</h6>
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
                                            Block</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Apartment Number</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">
                                            Room Count</th>
                                        <th
                                            class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                            Employed</th>
                                        <th class="text-secondary opacity-7"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($apartments as $apartment)
                                        <tr>
                                            <td>
                                                <p class="text-xs font-weight-bold mb-0">{{ $apartment->company->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $apartment->complex->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $apartment->building->name }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $apartment->block->block_number }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $apartment->apartment_number }}</p>
                                            </td>
                                            <td>
                                                 <p class="text-xs font-weight-bold mb-0">{{ $apartment->room_count }}</p>
                                            </td>
                                            <td class="align-middle text-center">
                                                <span class="text-secondary text-xs font-weight-bold">04/10/21</span>
                                            </td>
                                            <td class="align-middle">
                                                <a href="javascript:;" data-bs-toggle="modal" onclick="showDetail({{ $apartment->id }})" data-bs-target="#detail-modal" class="text-bold font-weight-bold text-xs"
                                                    data-toggle="tooltip" data-original-title="Mənzil Detalları">
                                                    Prewiew
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @if ($apartments->hasMorePages())
                        <div class="card-footer">
                            <button class="btn btn-primary load-more-btn" data-next-page="{{ $apartments->nextPageUrl() }}">
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
    

@endsection

@include('account.apartment.partials.show-modal')
