<div class="row mb-5">
    <div>
        <div class="card mt-4" id="2fa">
            <div class="search-section">
                <div>
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Avtomobil axtarışı</h5>
                    </div>
                    <div class="search-container">
                        <div class="plate_search ">
                            <div class="plate_search_inputs">
                                <div>
                                    <svg fill="none" viewBox="0 0 20 29" height="29" width="20" xmlns="http://www.w3.org/2000/svg">
                                        <g xmlns="http://www.w3.org/2000/svg" clip-path="url(#clip0_2752_3219)">
                                            <path d="M20 -0.666504H0V12.6665H20V-0.666504Z" fill="#EF3340"></path>
                                            <path d="M20 -0.666504H0V3.77783H20V-0.666504Z" fill="#00B5E2"></path>
                                            <path d="M20 8.22217H0V12.6665H20V8.22217Z" fill="#509E2F"></path>
                                            <path d="M10.125 7.625C9.22754 7.625 8.5 6.89746 8.5 6C8.5 5.10254 9.22754 4.375 10.125 4.375C10.4048 4.375 10.6681 4.44574 10.898 4.57031C10.5374 4.21769 10.0442 4 9.5 4C8.39543 4 7.5 4.89543 7.5 6C7.5 7.10457 8.39543 8 9.5 8C10.0442 8 10.5374 7.7823 10.898 7.42969C10.6681 7.55426 10.4048 7.625 10.125 7.625Z" fill="#F0F0F0"></path>
                                            <path d="M11.375 4.875L11.5902 5.48035L12.1705 5.20449L11.8946 5.78473L12.5 6L11.8946 6.21527L12.1705 6.79551L11.5902 6.51965L11.375 7.125L11.1598 6.51965L10.5795 6.79551L10.8554 6.21527L10.25 6L10.8554 5.78473L10.5795 5.20449L11.1598 5.48035L11.375 4.875Z" fill="#F0F0F0"></path>
                                        </g>
                                        <rect xmlns="http://www.w3.org/2000/svg" x="0.602151" y="15.0108" width="18.7957" height="12.7957" rx="1.80645" fill="white">
                                        </rect>
                                        <path xmlns="http://www.w3.org/2000/svg" d="M9.39327 24.4194H10.632L8.02552 18.3979H6.82982L4.18896 24.4194H5.38466L5.918 23.1462H8.85993L9.39327 24.4194ZM6.3309 22.157L7.39757 19.628L8.44703 22.157H6.3309Z" fill="#364152"></path>
                                        <path xmlns="http://www.w3.org/2000/svg" d="M10.7788 18.3979L10.7702 19.4043H14.2111L10.667 23.6022V24.4194H15.8111V23.4129H12.224L15.7681 19.2065V18.3979H10.7788Z" fill="#364152"></path>
                                        <rect xmlns="http://www.w3.org/2000/svg" x="0.602151" y="15.0108" width="18.7957" height="12.7957" rx="1.80645" stroke="#9AA4B2" stroke-width="1.2043"></rect>
                                        <defs xmlns="http://www.w3.org/2000/svg">
                                            <clipPath id="clip0_2752_3219">
                                                <rect width="20" height="12" rx="2" fill="white"></rect>
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </div>
                                <div class="form-group">
                                    <select class="form-control" id="region_number" name="region_number">
                                        <option value="">Seria</option>
                                        @foreach($regionNumbers as $number)
                                            <option value="{{ $number->region_number }}">{{ $number->region_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select class="form-control is-invalid" id="series_first_letter" name="series_first_letter">
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
                                        <option value="V">V</V>
                                        <option value="W">W</option>
                                        <option value="X">X</X>
                                        <option value="Y">Y</option>
                                        <option value="Z">Z</option>
                                        <option value="Q">Q</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <input type="number" class="form-control" id="plate_number" name="plate_number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2 ms-4">
                            <button type="submit" onclick="searchVehicleNumbers()" class="btn btn-primary svn-btn">Axtar</button>
                        </div>
                    </div>
                </div>
                <div id="search-result-content"></div>
            </div>
        </div>
    </div>
</div>

@push('styles')
    <link href="{{ asset('assets/css/pages/vehicles.css') }}" rel="stylesheet" />
@endpush

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
    
        $(`[aria-controls="select2-series_first_letter-results"]`).on('keydown', function() {
            console.log("sss",$(this).val());
        })
    });

    let currentSearchAjax;

    function searchVehicleNumbers(){
        var regionNumber = $("#region_number").val();
        var firstLetter = $("#series_first_letter").val();
        var secondLetter = $("#series_second_letter").val();
        var plateNumber = $('#plate_number').val();

        const postData = {
            region_number: regionNumber,
            series_first_letter: firstLetter,
            series_second_letter: secondLetter,
            plate_number: plateNumber
        }

        // Clear previous validation errors
        $(`#plate_number`).removeClass('is-invalid');
        $(`[aria-controls="select2-region_number-container"]`).removeClass('invalid');
        $(`[aria-controls="select2-series_first_letter-container"]`).removeClass('invalid');
        $(`[aria-controls="select2-series_second_letter-container"]`).removeClass('invalid');

        // Show search results section and loading state
        $('#search-results-section').show();
        $('#search-loading').show();
        $('#search-result-content').hide();

        // Show loading state on button
        $('.svn-btn').html('<span class="spinner-border spinner-border-sm"></span> Axtarılır...').prop('disabled', true);

        $('#search-not-found').hide();
        // Abort previous request if exists
        if (currentSearchAjax) {
            currentSearchAjax.abort();
        }

        currentSearchAjax = $.ajax({
            url: `{{ route('account.vehicle.searchByNumber') }}`,
            type: 'POST',
            data: postData,
            success: function(response) {
                if(response.status === 'success') {
                    // Vehicle found - display result
                    displaySearchResult(response.data);
                } else {
                    // Vehicle not found
                    $('#search-not-found').show();
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                
                if (textStatus === 'abort') {
                    console.log('Search request aborted');
                    return;
                }

                if(jqXHR.status == 422) {
                    var errors = jqXHR.responseJSON.errors;
                    console.log("Validation errors:", errors);
                    if(errors.plate_number)
                        $(`#plate_number`).addClass('is-invalid');
                    if(errors.region_number)
                        $(`[aria-controls="select2-region_number-container"]`).addClass('invalid');
                    if(errors.series_first_letter)
                        $(`[aria-controls="select2-series_first_letter-container"]`).addClass('invalid');
                    if(errors.series_second_letter)
                        $(`[aria-controls="select2-series_second_letter-container"]`).addClass('invalid');

                    $('#search-results-section').hide();
                } else {
                    $('#search-not-found').show();
                    Swal.fire({
                        icon: 'error',
                        title: 'Xəta!',
                        text: 'Serverdə xəta baş verdi. Zəhmət olmasa bir az sonra yenidən cəhd edin.',
                    });
                }
            },
            complete: function() {
                $('.svn-btn').prop('disabled', false).html('Axtar');
            }
        });
    }

    function displaySearchResult(vehicle) {
        let resultHtml = '';
        if(vehicle){
            var plateNumber = vehicle.full_number;

            var numbers = vehicle.contact_numbers;
            let contactNumbersHTML = '';

            if (numbers && numbers.length > 0) {
                contactNumbersHTML = numbers.map(number => `
                    <div><a href="tel:${number.fields.phone}">${number.fields.phone}</a></div>
                `).join('');
            } else {
                contactNumbersHTML = '----';
            }

            resultHtml = `
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Axtarış Nəticəsi</h5>
                    </div>
                    ${vehicle.blacklist == true ? 
                    `<div class="card blacklist-card">
                        <div>${plateNumber} - <span class="text-danger">Qara siyahıdadır!</span></div>
                        <div>Şərh: ${vehicle.comments && vehicle.comments[0] && vehicle.comments[0]['comment'] ? vehicle.comments[0]['comment'] : 'No comment'}</div>
                    </div>`
                    : 
                    `<div class="vehicle-card-search">
                        <div class="plate-number">${plateNumber}</div>
                        <div>
                            <div >
                                <span class="info-label">Status:</span>
                                <span class="info-value">Sakin</span>
                            </div>
                            <div>
                                <span class="info-label">Ünvan:</span>
                                <span class="info-value">${vehicle.building.name}</span>
                            </div>
                            <div>
                                <span class="info-label">Əlaqə nömrələri:</span>
                                ${contactNumbersHTML}
                            </div>
                        </div>
                    </div>`}
                </div>
            `;
        } else {
            var plateNumber = $("#region_number").val() + '-' + $("#series_first_letter").val() + $("#series_second_letter").val() + '-' + $('#plate_number').val();
            resultHtml = `
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between">
                        <h5 class="mb-0">Axtarış Nəticəsi</h5>
                    </div>
                    <div class="vehicle-card-search" style="display: flex; align-items: center; justify-content: center; padding: 20px; border: 1px solid #ccc; border-radius: 5px; background-color: #f9f9f9;">
                        <div style="font-size: 18px; margin-right: 20px;">${plateNumber}</div>
                        <div>
                            <div class="text-danger" style="font-size: 18px; font-weight: bold;">Avtomobilin giriş icazəsi mövcud deyil!</div>
                        </div>
                    </div>
                </div>
                `;
        }

        $('#search-result-content').html(resultHtml).show();
    }
</script>
@endpush
