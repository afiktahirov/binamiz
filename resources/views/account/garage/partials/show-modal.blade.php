<div class="col-md-6">
  <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header bg-primary text-center">
            <div class="modal-title text-center" id="detail-modal-label">
                <img src="{{ readSvg('img/sidebar/garage') }}" width="40" height="40" class="invert-color" />
                <span >Qaraj</span>
            </div>
          </div>
        <div class="modal-body">
          <div id="modal-loading" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Yüklənir...</span>
            </div>
          </div>
          <div id="modal-content">
            <div class="soft-card">
              <div class="info-row"><span>Şirkət:</span><span id="company_name"></span></div>
              <div class="info-row"><span>Kompleks:</span><span id="complex_name"></span></div>
              <div class="info-row"><span>Bina:</span><span id="building_name"></span></div>
              <div class="info-row"><span>Qaraj Nomrəsi:</span><span id="garage_number" >1</span></div>
              <div class="info-row"><span>Ölçüsü (m²):</span><span id="garage_size" >1</span></div>
              <div class="info-row"><span>Status</span><span id="status"></span></div>
              <div class="info-row"><span>Çıxarış var:</span><span id="has_extract"></span></div>
        
              <div class="issue-container">
                <div class="divider"></div>

                <h6 class="mb-3">Çıxarış</h6>
                <div class="info-row"><span>Verilmə tarixi:</span><span id="issue_date"></span></div>
                <div class="info-row"><span>Qeydiyyat nömrəsi:</span><span id="registration_number"></span></div>
                <div class="info-row"><span>Reyestr nömrəsi:</span><span id="registry_number"></span></div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center align-items-center gap-2">
            <a class="btn btn-success get_issue_btn" href="https://e-emlak.gov.az/eemdk/az/CheckElectronExtract" target="_blank">Çıxarışı əldə et</a>
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Bağla</button>
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
    $('.get_issue_btn').hide();

    if (currentAjax) {
      currentAjax.abort();
    }

    currentAjax = $.ajax({
      url: `{{ route('account.garage.detail', '') }}/${id}`,
      type: 'GET',
      dataType: 'json',
      beforeSend: function() {
        // You can add a loading indicator here if needed
      },
      success: function(data) {
        $('#garage_number').text(data.garage_number);
        $('#garage_size').text(data.size);
        $('#size').text(data.size + ' m²');
        $('#place_count').text(data.place_count);
        $('#status').text(data.status.charAt(0).toUpperCase() + data.status.slice(1));
        $('#registration_number').text(data.registration_number);
        $('#registry_number').text(data.registry_number);
        $('#issue_date').text(data.issue_date);
        $('#company_name').text(data.company.name);
        $('#complex_name').text(data.complex.name);
        $('#building_name').text(data.building.name);
        
        if (data.has_extract) {
            $('#issue_date').text(data.issue_date ? moment(data.issue_date).format('l') : '');
            $('#registration_number').text(data.registration_number);
            $('#registry_number').text(data.registry_number);
            $('#has_extract').html('<i class="fa-solid fa-circle-check" style="color:green; font-size: 1.2em;"></i>');
            $('.get_issue_btn').show();
        } else {
            $('#has_extract').html('<i class="fa-solid fa-circle-xmark" style="color:red; font-size: 1.2em;"></i>');
            $('.issue-container').hide();
            $('.get_issue_btn').hide();
        }

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
