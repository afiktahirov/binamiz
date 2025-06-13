<div class="col-lg-8 col-12">
    <div class="row mt-4">
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary">
                        <span class="countTo" countto="{{ $cardData['balance'] }}">{{ $cardData['balance'] }}</span>
                        <span class="text-lg ms-n2">AZN</span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">Balans</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary">
                        <span class="countTo" countto="{{ $cardData['apartments_count'] }}">{{ $cardData['apartments_count'] }}</span>
                        <span class="text-lg ms-n1"></span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">Mənzil</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary">
                        <span class="countTo" countto="{{ $cardData['garages_count'] }}">{{ $cardData['garages_count'] }}</span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">Qaraj</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary">
                        <span class="countTo" countto="{{ $cardData['vehicles_count'] }}">{{ $cardData['vehicles_count'] }}</span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">Avtomobil</h6>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary">
                        <span class="countTo" countto="{{ $cardData['objects_count'] }}">{{ $cardData['objects_count'] }}</span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">Obyekt</h6>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-12 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-gradient text-primary">
                        <span class="countTo" countto="{{ $cardData['other_services_count'] }}">{{ $cardData['other_services_count'] }}</span>
                    </h1>
                    <h6 class="mb-0 font-weight-bolder">Digər Xidmətlər</h6>
                </div>
            </div>
        </div>
    </div>
</div>
