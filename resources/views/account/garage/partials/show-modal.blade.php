<div class="col-md-6">
  <div class="modal fade" style="display: none;" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="garage-detail-modal" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
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
            <div class="row">
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
            <div class="row">
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
            <div class="row">
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
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="issue_date">Issue Date</label>
                  <input type="text" class="form-control" id="issue_date" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="company_name">Company Name</label>
                  <input type="text" class="form-control" id="company_name" readonly>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="complex_name">Complex Name</label>
                  <input type="text" class="form-control" id="complex_name" readonly>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="building_name">Building Name</label>
                  <input type="text" class="form-control" id="building_name" readonly>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-link  ml-auto" data-bs-dismiss="modal">Close</button>
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

    fetch(`{{ route('account.garage.detail', '') }}/${id}`, { signal })
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
