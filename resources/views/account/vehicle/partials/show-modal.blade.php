<div class="col-md-6">
  <div class="modal fade" id="detail-modal" tabindex="-1" role="dialog" aria-labelledby="detail-modal-label" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
          <div class="modal-header bg-primary text-center">
            <div class="modal-title text-center" id="detail-modal-label">
                <img src="{{ readSvg('img/sidebar/vehicle') }}" width="40" height="40" class="invert-color" />
                <span id="full_number">Nəqliyyat Vasitələrim</span>
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
              <div class="info-row">
                    <span class="info-label">Status:</span>
                    <span id="status_text"></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Markası:</span>
                    <span id="brand_name_detail"></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Modeli:</span>
                    <span id="vehicle_type_name_detail"></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Rəngi:</span>
                    <span id="color_name_detail"></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Son giriş icazəsi:</span>
                    <span>----</span>
                </div>

                <div class="info-row">
                    <span class="info-label">Bağlı olduğu qaraj:</span>
                    <span id="garage_number_detail"></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Giriş icazəsi:</span>
                    <span id="garage_number_detail"></span>
                </div>

                <div class="info-row">
                    <span class="info-label">Qalıq icazə müddəti:</span>
                    <span id="garage_number_detail"></span>
                </div>
                
            </div>
          </div>
        </div>
        <div class="modal-footer d-flex justify-content-center align-items-center gap-2">
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

                if(data.number_type == 'yerli') {
                    $(`label[for='vehicle_number']`).text('Yerli Nömrə');
                }
                else {
                    $(`label[for='vehicle_number']`).text('Xarici Nömrə');
                }

                $('#status_text').text(data.active ? 'Activ' : 'Inactive');
                
                $('#status_text').removeClass('status-active status-inactive');
                if(data.active)
                    $('#status_text').addClass('status-active')
                else 
                    $('#status_text').addClass('status-inactive')

                $('#garage_number_detail').text(data.garage?.garage_number);

                $('#vehicle_type_name_detail').text(data.vehicle_type?.name);

                $('#color_name_detail').text(data.color?.name);

                $('#brand_name_detail').text(data.brand?.name);

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