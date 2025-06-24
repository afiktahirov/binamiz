<div class="col-md-6">
  <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header bg-primary text-center">
            <div class="modal-title text-center" id="detail-modal-label">
                <img src="{{ readSvg('img/sidebar/apartment') }}" width="40" height="40" class="invert-color" />
                <span >Mənzil</span>
            </div>
          </div>
        <div class="modal-body">
          <div id="modal-loading" class="d-flex justify-content-center">
            <div class="spinner-border" role="status">
              <span class="visually-hidden">Loading...</span>
            </div>
          </div>
          <div id="modal-content" style="display: none;">
            <div class="soft-card">
              <div class="info-row"><span>Şirkət:</span><span id="company_name"></span></div>
              <div class="info-row"><span>Kompleks:</span><span id="complex_name"></span></div>
              <div class="info-row"><span>Bina:</span><span id="building_name"></span></div>
              <div class="info-row"><span>Blok:</span><span>1</span></div>
              <div class="info-row"><span>Mənzil Nömrəsi:</span><span id="apartment_number"></span></div>
              <div class="info-row"><span>Otaq sayı:</span><span id="room_count"></span></div>
              <div class="info-row"><span>Mənzilin Ümumi Ölçüsü (m²):</span><span id="total_area" id="size"></span></div>
              <div class="info-row"><span>Mənzilin Yaşayış Sahəsi (m²):</span><span id="live_area">118.20</span></div>
              <div class="info-row"><span>Çıxarış:</span><span id="has_extract"></span></div>

              <div class="issue-container">
                <div class="divider"></div>
                
                <h6 class="mb-3">Çıxarış</h6>
                <div class="info-row"><span>Verilmə tarixi:</span><span id="issue_date"></span></div>
                <div class="info-row"><span>Qeydiyyat nömrəsi:</span><span id="registration_number"></span></div>
                <div class="info-row"><span>Reyestr nömrəsi:</span><span id="registry_number"></span></div>
              </div>
              <!-- <div class="mt-3 d-flex align-items-center gap-2 text-success">
                <i class="bi bi-check-circle-fill check-icon"></i>
                <span>Status: <span id="status"></span></span>
              </div> -->
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
      url: `{{ route('account.apartment.detail', '') }}/${id}`,
      type: 'GET',
      dataType: 'json',
      beforeSend: function() {
        // You can add a loading indicator here if needed
      },
      success: function(data) {
        $('.issue-container').show();
        $('#garage_number').text(data.garage_number);
        $('#apartment_number').text(data.apartment_number);
        $('#total_area').text(data.total_area);
        $('#live_area').text(data.live_area);
        $('#size').text(data.size);
        $('#room_count').text(data.room_count);
        $('#status').text(data.status);
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