<div class="col-md-6">
    <div class="modal fade" style="display: none;" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="garage-detail-modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 50vw; min-width: 350px;" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title" id="modal-title-default">Vehicle Detail</h6>
                    <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modal-loading" class="d-flex justify-content-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                    <div id="modal-content" style="display: none;">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_registration">Vehicle Registration</label>
                                    <input type="text" class="form-control" id="vehicle_registration" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="region_number">Region Number</label>
                                    <input type="text" class="form-control" id="region_number" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="first_letter">First Letter</label>
                                    <input type="text" class="form-control" id="first_letter" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="second_letter">Second Letter</label>
                                    <input type="text" class="form-control" id="second_letter" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="plate_number">Plate Number</label>
                                    <input type="text" class="form-control" id="plate_number" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <input type="text" class="form-control" id="status" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="number_type">Number Type</label>
                                    <input type="text" class="form-control" id="number_type" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="foreign_number">Foreign Number</label>
                                    <input type="text" class="form-control" id="foreign_number" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_name_detail">Company Name</label>
                                    <input type="text" class="form-control" id="company_name_detail" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_email">Company Email</label>
                                    <input type="text" class="form-control" id="company_email" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_phone">Company Phone</label>
                                    <input type="text" class="form-control" id="company_phone" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="company_address">Company Address</label>
                                    <input type="text" class="form-control" id="company_address" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="complex_name_detail">Complex Name</label>
                                    <input type="text" class="form-control" id="complex_name_detail" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="complex_address">Complex Address</label>
                                    <input type="text" class="form-control" id="complex_address" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="complex_residential_price">Complex Residential Price</label>
                                    <input type="text" class="form-control" id="complex_residential_price" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="complex_garage_price">Complex Garage Price</label>
                                    <input type="text" class="form-control" id="complex_garage_price" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="building_name_detail">Building Name</label>
                                    <input type="text" class="form-control" id="building_name_detail" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="building_units">Building Units</label>
                                    <input type="text" class="form-control" id="building_units" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="building_manager">Building Manager</label>
                                    <input type="text" class="form-control" id="building_manager" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="garage_number_detail">Garage Number</label>
                                    <input type="text" class="form-control" id="garage_number_detail" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="vehicle_type_name_detail">Vehicle Type Name</label>
                                    <input type="text" class="form-control" id="vehicle_type_name_detail" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="color_name_detail">Color Name</label>
                                    <input type="text" class="form-control" id="color_name_detail" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="brand_name_detail">Brand Name</label>
                                    <input type="text" class="form-control" id="brand_name_detail" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link ml-auto" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    let currentAjax;

    function showDetail(id) {
        $('#modal-loading').show().addClass('d-flex');
        $('#modal-content').hide();
        $('#detail-modal').modal('show');

        if (currentAjax) {
            currentAjax.abort();
        }

        currentAjax = $.ajax({
            url: `{{ route('account.vehicle.detail', '') }}/${id}`,
            type: 'GET',
            dataType: 'json',
            beforeSend: function() {
                // You can add a loading indicator here if needed
            },
            success: function(data) {
                $('#vehicle_registration').val(data.vehicle_registration);
                $('#region_number').val(data.region_number);
                $('#first_letter').val(data.first_letter);
                $('#second_letter').val(data.second_letter);
                $('#plate_number').val(data.plate_number);
                $('#status').val(data.status);
                $('#number_type').val(data.number_type);
                $('#foreign_number').val(data.foreign_number);

                $('#company_name').text(data.company.name);
                $('#complex_name').text(data.complex.name);
                $('#building_name').text(data.building.name);
                $('#garage_number').text(data.garage.garage_number);
                $('#vehicle_type_name').text(data.vehicle_type.name);
                $('#color_name').text(data.color.name);
                $('#brand_name').text(data.brand.name);

                $('#complex_address').val(data.complex.address);
                $('#complex_name_detail').val(data.complex.name);
                $('#complex_residential_price').val(data.complex.residential_price);
                $('#complex_garage_price').val(data.complex.garage_price);

                $('#company_name_detail').val(data.company.name);
                $('#company_email').val(data.company.email);
                $('#company_phone').val(data.company.phone);
                $('#company_address').val(data.company.address);

                $('#building_name_detail').val(data.building.name);
                $('#building_units').val(data.building.units);
                $('#building_manager').val(data.building.manager);

                $('#garage_number_detail').val(data.garage.garage_number);

                $('#vehicle_type_name_detail').val(data.vehicle_type.name);

                $('#color_name_detail').val(data.color.name);

                $('#brand_name_detail').val(data.brand.name);

                $('#modal-loading').hide().removeClass('d-flex');
                $('#modal-content').show();
            },
            error: function(jqXHR, textStatus, errorThrown) {
                if (textStatus === 'abort') {
                    console.log('Ajax request aborted');
                } else {
                    $('#modal-loading').hide();
                    console.error('Error:', errorThrown);
                }
            },
            complete: function() {
                // You can remove the loading indicator here if needed
            }
        });
    }

    $('#detail-modal').on('hide.bs.modal', function(event) {
        if (currentAjax) {
            currentAjax.abort();
            console.log('Ajax request aborted by modal close');
        }
    });
</script>