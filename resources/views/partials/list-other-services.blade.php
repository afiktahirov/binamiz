<div class="row my-4">
    <div class="col-lg-12">
        <div class="card z-index-2">
            <div class="card-header pb-0">
                <h6>Digər Xidmətlər</h6>
            </div>
            <div class="card-body p-3">
                <div class="row g-4">

                    <!-- Service Item -->
                    @foreach($otherServices as $service)
                        <a href="{{ route('account.service-type.show', $service->id) }}" class="col-sm-6 col-lg-3">
                            <div class="card border border-primary text-center p-4 service-card">
                                <div class="service-icon mx-auto mb-2">
                                    <img class="img-fluid w-15 h-15" 
                                    src="{{ $service->icon ? Storage::url($service->icon) : asset('assets/img/default-service.png') }}" 
                                    alt="icon">
                                </div>
                                <div>{{ $service->name }}</div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .service-card {
        transition: transform 0.3s ease;
        cursor: pointer;
    }

    .service-card:hover {
        transform: translateY(-5px);
    }
</style>
