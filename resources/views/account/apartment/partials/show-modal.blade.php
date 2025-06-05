<div class="col-md-6">
  <div class="modal fade" style="display: none;" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="garage-detail-modal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 50vw; min-width: 350px;" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h6 class="modal-title" id="modal-title-default">Garage Detail</h6>
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
                  <label for="garage_number">Garage Number</label>
                  <input type="text" class="form-control" id="garage_number" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="size">Size</label>
                  <input type="text" class="form-control" id="size" readonly>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="place_count">Place Count</label>
                  <input type="text" class="form-control" id="place_count" readonly>
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
                  <label for="registration_number">Registration Number</label>
                  <input type="text" class="form-control" id="registration_number" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="registry_number">Registry Number</label>
                  <input type="text" class="form-control" id="registry_number" readonly>
                </div>
              </div>
            </div>
            <div class="row mb-3">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="issue_date">Issue Date</label>
                  <input type="text" class="form-control" id="issue_date" readonly>
                </div>
              </div>
            </div>
            
            <!-- Accordion for Relations -->
            <div class="accordion" id="relationsAccordion">
              <!-- Company -->
              <div class="accordion-item">
              <h2 class="accordion-header" id="headingCompany">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCompany" aria-expanded="false" aria-controls="collapseCompany">
                Company: <span id="company_name" class="ms-2"></span>
                </button>
              </h2>
              <div id="collapseCompany" class="accordion-collapse collapse" aria-labelledby="headingCompany" data-bs-parent="#relationsAccordion">
                <div class="accordion-body d-flex flex-wrap gap-3">
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="company_name_detail" class="form-label"><strong>Name</strong></label>
                    <input type="text" class="form-control" id="company_name_detail" readonly>
                  </div>
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="company_email" class="form-label"><strong>Email</strong></label>
                    <input type="text" class="form-control" id="company_email" readonly>
                  </div>
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="company_phone" class="form-label"><strong>Phone</strong></label>
                    <input type="text" class="form-control" id="company_phone" readonly>
                  </div>
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="company_address" class="form-label"><strong>Address</strong></label>
                    <input type="text" class="form-control" id="company_address" readonly>
                  </div>
                </div>
              </div>
              </div>
              <!-- Complex -->
              <div class="accordion-item">
              <h2 class="accordion-header" id="headingComplex">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseComplex" aria-expanded="false" aria-controls="collapseComplex">
                Complex: <span id="complex_name" class="ms-2"></span>
                </button>
              </h2>
              <div id="collapseComplex" class="accordion-collapse collapse" aria-labelledby="headingComplex" data-bs-parent="#relationsAccordion">
                <div class="accordion-body d-flex flex-wrap gap-3">
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="complex_name_detail" class="form-label"><strong>Name</strong></label>
                    <input type="text" class="form-control" id="complex_name_detail" readonly>
                  </div>
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="complex_address" class="form-label"><strong>Address</strong></label>
                    <input type="text" class="form-control" id="complex_address" readonly>
                  </div>
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="complex_residential_price" class="form-label"><strong>Residential Price</strong></label>
                    <input type="text" class="form-control" id="complex_residential_price" readonly>
                  </div>
                  <div class="mb-2 flex-fill" style="min-width: 200px;">
                    <label for="complex_garage_price" class="form-label"><strong>Garage Price</strong></label>
                    <input type="text" class="form-control" id="complex_garage_price" readonly>
                  </div>
                </div>
              </div>
              </div>
              <!-- Building -->
              <div class="accordion-item">
              <h2 class="accordion-header" id="headingBuilding">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseBuilding" aria-expanded="false" aria-controls="collapseBuilding">
                Building: <span id="building_name" class="ms-2"></span>
                </button>
              </h2>
              <div id="collapseBuilding" class="accordion-collapse collapse" aria-labelledby="headingBuilding" data-bs-parent="#relationsAccordion">
                <div class="accordion-body d-flex flex-wrap gap-3">
                <div class="mb-2 flex-fill" style="min-width: 200px;">
                  <label for="building_name_detail" class="form-label"><strong>Name</strong></label>
                  <input type="text" class="form-control" id="building_name_detail" readonly>
                </div>
                <div class="mb-2 flex-fill" style="min-width: 200px;">
                  <label for="building_units" class="form-label"><strong>Units</strong></label>
                  <input type="text" class="form-control" id="building_units" readonly>
                </div>
                <div class="mb-2 flex-fill" style="min-width: 200px;">
                  <label for="building_manager" class="form-label"><strong>Manager</strong></label>
                  <input type="text" class="form-control" id="building_manager" readonly>
                </div>
                </div>
              </div>
              </div>
            </div>
            <!-- End Accordion -->
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
      url: `{{ route('account.apartment.detail', '') }}/${id}`,
      type: 'GET',
      dataType: 'json',
      beforeSend: function() {
        // You can add a loading indicator here if needed
      },
      success: function(data) {
        $('#garage_number').val(data.garage_number);
        $('#size').val(data.size);
        $('#place_count').val(data.place_count);
        $('#status').val(data.status);
        $('#registration_number').val(data.registration_number);
        $('#registry_number').val(data.registry_number);
        $('#issue_date').val(data.issue_date);
        $('#company_name').val(data.company.name);
        $('#complex_name').val(data.complex.name);
        $('#building_name').val(data.building.name);
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