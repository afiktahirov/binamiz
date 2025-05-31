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
                  <label for="complex_floors" class="form-label"><strong>Floors</strong></label>
                  <input type="text" class="form-control" id="complex_floors" readonly>
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
  let currentFetch;

  function showDetail(id) {
    document.getElementById('modal-loading').style.display = 'flex';
    document.getElementById('modal-content').style.display = 'none';
    document.getElementById('detail-modal').style.display = 'block';

    if (currentFetch) {
      currentFetch.abort();
    }

    currentFetch = new AbortController();
    const signal = currentFetch.signal;

    fetch(`{{ route('account.apartment.detail', '') }}/${id}`, { signal })
      .then(response => response.json())
      .then(data => {
        document.getElementById('garage_number').value = data.garage_number;
        document.getElementById('size').value = data.size;
        document.getElementById('place_count').value = data.place_count;
        document.getElementById('status').value = data.status;
        document.getElementById('registration_number').value = data.registration_number;
        document.getElementById('registry_number').value = data.registry_number;
        document.getElementById('issue_date').value = data.issue_date;
        document.getElementById('company_name').value = data.company.name;
        document.getElementById('complex_name').value = data.complex.name;
        document.getElementById('building_name').value = data.building.name;

        document.getElementById('modal-loading').style.display = 'none';
        document.getElementById('modal-loading').classList.remove('d-flex');
        document.getElementById('modal-content').style.display = 'block';

        // var myModal = new bootstrap.Modal(document.getElementById('detail-modal'))
        // myModal.show()
      })
      .catch(error => {
        if (error.name === 'AbortError') {
          console.log('Fetch aborted');
        } else {
          document.getElementById('modal-loading').style.display = 'none';
          console.error('Error:', error);
        }
      });
  }

  const detailModal = document.getElementById('detail-modal')
  detailModal.addEventListener('hide.bs.modal', event => {
    if (currentFetch) {
      currentFetch.abort();
      console.log('Fetch aborted by modal close');
    }
  })
</script>