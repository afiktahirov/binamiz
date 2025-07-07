<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 sortable"
                    data-sort="title"
                    role="button"
                    tabindex="0"
                    aria-label="Başlığa görə sırala">
                    Bildiriş başlıq
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-md-table-cell"
                    data-sort="type"
                    role="button"
                    tabindex="0"
                    aria-label="Növə görə sırala">
                    Bildiriş növü
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-md-table-cell"
                    data-sort="is_readed"
                    role="button"
                    tabindex="0"
                    aria-label="Növə görə sırala">
                    Oxunma statusu
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-lg-table-cell"
                    data-sort="created_at"
                    role="button"
                    tabindex="0"
                    aria-label="Tarixə görə sırala">
                    Bildiriş tarixi
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                {{-- <th class="text-secondary opacity-7" aria-label="Əməliyyatlar">Əməliyyatlar</th> --}}
                 <th class="text-uppercase text-secondary text-center text-xxs font-weight-bolder opacity-7 ps-2 d-none d-lg-table-cell"
                    role="button"
                    tabindex="0"
                    aria-label="Əməliyyatlar">
                    Əməliyyatlar
                </th>
            </tr>
        </thead>
        <tbody>
            @forelse($notifications as $notification)
            <tr class="notification-row" data-id="{{ $notification->id }}">
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ Str::limit($notification->title, 50) }}</h6>
                            <div class="d-md-none">
                                <small class="text-muted">
                                    {{ $notification->created_at->format('d.m.Y') }}
                                    @if($notification->assignedUser)
                                        • {{ $notification->assignedUser->name }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="d-none d-xl-table-cell">
                    <span class="badge badge-sm bg-{{ $notification->type->color() }}"
                          title="{{ $notification->type->value }}">
                        <span class="d-none d-sm-inline">{{ $notification->type->label() }}</span>
                        <span class="d-sm-none">
                            @switch($notification->type->value)
                                @case('informative')
                                    <i class="fa-solid fa-circle-info"></i>
                                    @break
                                @case('important')
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                    @break
                                @default
                                    <i class="fa-solid fa-question"></i>
                            @endswitch
                        </span>
                    </span>
                </td>

                <td class="d-none d-md-table-cell">
                    @if($notification->is_readed)
                        <p class="text-sm font-weight-bold mb-0 ">
                        Baxılmış
                        </p>
                    @else
                        <p class="text-sm font-weight-bold mb-0 notification-status">
                            Baxılmadı
                        </p>
                    @endif
                </td>
                
                <td class="d-none d-md-table-cell">
                    <p class="text-sm font-weight-bold mb-0">
                        {{ $notification->created_at->format('d.m.Y') }}
                        <small class="d-block text-muted">{{ $notification->created_at->format('H:i') }}</small>
                    </p>
                </td>
                
                <td class="align-middle text-center">
                    <span data-value="{{ $notification }}" onclick="showDetail(this)" title="Oxu" class="cursor-pointer show-notification-detail">
                        <i class="fa-solid fa-eye"></i>
                    </span>
                </td>
                
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">Heç bir bildiriş tapılmadı</h6>
                        <p class="text-muted">Axtarış kriteriyalarınızı dəyişdirməyi sınayın</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
