<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 sortable"
                    data-sort="comunal.building.id"
                    role="button"
                    tabindex="0"
                    aria-label="Binaya görə sırala">
                    Bina
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 sortable"
                    data-sort="comunals.property_type" {{-- comunal property_type ye gore --}}
                    role="button"
                    tabindex="0"
                    aria-label="Binaya görə sırala">
                    Əmlak Tipi
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-md-table-cell"
                    data-sort="debts.total_amount"
                    {{-- debts --}}
                    role="button"
                    tabindex="0"
                    aria-label="Məbləğə görə sırala">
                    Məbləğ
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-lg-table-cell"
                    data-sort="created_at" 
                    {{-- transactions --}}
                    role="button"
                    tabindex="0"
                    aria-label="Tarixə görə sırala">
                    Ödəniş tarixi
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable"
                    data-sort="debts.status" 
                    {{-- status 1 olanda ödənilib --}}
                    role="button"
                    {{-- ödenib odenmemesi --}}
                    tabindex="0"
                    aria-label="Statusa görə sırala">
                    Status
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-md-table-cell"
                    data-sort="debits.created_at"
                    role="button"
                    tabindex="0"
                    aria-label="Tarixə görə sırala">
                    Qaimə tarixi
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                {{-- <th class="text-secondary opacity-7" aria-label="Əməliyyatlar">Əməliyyatlar</th> --}}
                 <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2 d-none d-md-table-cell"
                    role="button"
                    tabindex="0"
                    aria-label="Əməliyyatlar">
                    Əməliyyatlar
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $transaction)
                <tr class="transaction-row" data-id="{{ $transaction->id }}">
                    <td class="">
                        <p class="text-sm font-weight-bold mb-0">
                            {{ $transaction->debt->comunal->building?->name }}
                        </p>
                    </td>
                    
                    <td class="d-none d-sm-table-cell">
                        <p class="text-sm font-weight-bold mb-0 d-none d-sm-inline">
                            @switch($transaction->debt?->comunal?->property_type)
                                @case('apartment')
                                    Mənzil
                                    @break
                                @case('object')
                                    Obyekt
                                    @break
                                @case('garage')
                                    Qaraj
                                    @break
                                @default
                                    {{ $transaction->debt?->comunal?->property_type }}
                            @endswitch
                        </p>
                        <span class="d-sm-none">
                            @switch($transaction->debt?->comunal?->property_type)
                                @case('apartment')
                                    Mənzil
                                    @break
                                @case('object')
                                    Obyekt
                                    @break
                                @case('garage')
                                    Qaraj
                                    @break
                                @default
                                    {{ $transaction->debt?->comunal?->property_type }}
                            @endswitch
                        </span>
                    </td>
                    
                    <td class="d-none d-md-table-cell">
                        <p class="text-sm font-weight-bold mb-0">
                            {{ $transaction->debt?->total_amount }}
                        </p>
                    </td>

                    <td class="d-none d-lg-table-cell">
                        <p class="text-sm font-weight-bold mb-0">
                            {{ $transaction->created_at->format('d.m.Y') }}
                            <small class="d-block text-muted">{{ $transaction->created_at->format('H:i') }}</small>
                        </p>
                    </td>
                    <td>
                        <span class="badge badge-sm bg-{{ $transaction->debt->status ? 'success' : 'warning' }}" >
                            <span class="d-none d-sm-inline">{{ $transaction->debt->status ? 'Ödənilib' : 'Ödənməyib' }}</span>
                            <span class="d-sm-none">
                                @switch($transaction->debt->status)
                                    @case(true)
                                        <i class="fa-solid fa-circle-check" style="color:green; font-size: 1.2em;"></i>
                                        @break
                                    @case(false)
                                        <i class="fa-solid fa-circle-xmark" style="color:red; font-size: 1.2em;"></i>
                                        @break
                                @endswitch
                            </span>
                        </span>
                    </td>

                    <td class="d-none d-md-table-cell">
                        <p class="text-sm font-weight-bold mb-0">
                            {{ $transaction->debt->created_at->format('d.m.Y') }}
                            <small class="d-block text-muted">{{ $transaction->debt->created_at->format('H:i') }}</small>
                        </p>
                    </td>
                    
                    <td class="align-middle text-center">
                        @if(!$transaction->debt->status)
                            <button 
                                type="button" 
                                class="btn btn-sm btn-primary d-none d-sm-inline" 
                                data-value="{{ $transaction }}" 
                                title="Ödə">
                                Ödə
                            </button>
                            <span class="d-sm-none">
                                <i class="fa-solid fa-cart-shopping"></i>
                            </span>
                        @endif
                    </td>
                    
                </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">Heç bir ödəniş tapılmadı</h6>
                        <p class="text-muted">Axtarış kriteriyalarınızı dəyişdirməyi sınayın</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
