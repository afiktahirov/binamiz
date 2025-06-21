<div class="col-md-6">
  <style>
    .soft-card {
        border: none;
        padding: 20px;
        max-width: 500px;
    }
    .card-header-icon {
        font-size: 2rem;
        color: #6c757d;
    }
    .card-title {
        font-size: 1.5rem;
        font-weight: bold;
        margin-bottom: 20px;
    }
    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 8px;
    }
    .info-row span:first-child {
        color: #6c757d;
    }
    .divider {
        border-top: 1px solid #e0e0e0;
        margin: 20px 0;
    }
    .check-icon {
        color: #198754;
        font-size: 1.2rem;
    }
  </style>

  <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header bg-primary text-center" style="padding-bottom:30px;display: flex; justify-content: center; align-items: center;">
              <div>
                  <h5 class="modal-title text-center" style="color:#fff; display: flex; align-items: center; justify-content: center;" id="detail-modal-label">
                      <span style="margin-right: 5px;"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" width="60" height="60" fill="currentColor"><!--! Font Awesome Pro 6.7.2 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license (Commercial License) Copyright 2024 Fonticons, Inc. --><path d="M0 488L0 171.3c0-26.2 15.9-49.7 40.2-59.4L308.1 4.8c7.6-3.1 16.1-3.1 23.8 0L599.8 111.9c24.3 9.7 40.2 33.3 40.2 59.4L640 488c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24l0-264c0-17.7-14.3-32-32-32l-384 0c-17.7 0-32 14.3-32 32l0 264c0 13.3-10.7 24-24 24l-48 0c-13.3 0-24-10.7-24-24zM254.3 293.4L242.2 328l155.6 0-12.1-34.6c-1.1-3.2-4.2-5.4-7.6-5.4l-116.3 0c-3.4 0-6.4 2.2-7.6 5.4zM188.9 335L209 277.5c7.9-22.5 29.1-37.5 52.9-37.5l116.3 0c23.8 0 45 15.1 52.9 37.5L451.1 335c17.2 9.5 28.9 27.9 28.9 49l0 96c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-16-192 0 0 16c0 17.7-14.3 32-32 32s-32-14.3-32-32l0-96c0-21.1 11.7-39.5 28.9-49zM240 424a24 24 0 1 0 0-48 24 24 0 1 0 0 48zm184-24a24 24 0 1 0 -48 0 24 24 0 1 0 48 0z"/></svg> </span>
                      <span class="" style="font-size: 1.8em;color:#fff;">Qaraj</span></h5>
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
