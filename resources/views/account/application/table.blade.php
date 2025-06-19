<div class="table-responsive">
    <table class="table align-items-center mb-0">
        <thead>
            <tr>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 sortable"
                    data-sort="title"
                    role="button"
                    tabindex="0"
                    aria-label="Başlığa görə sırala">
                    Müraciət başlıq
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-md-table-cell"
                    data-sort="created_at"
                    role="button"
                    tabindex="0"
                    aria-label="Tarixə görə sırala">
                    Müraciət tarixi
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-lg-table-cell"
                    data-sort="type"
                    role="button"
                    tabindex="0"
                    aria-label="Növə görə sırala">
                    Müraciət növü
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable d-none d-xl-table-cell"
                    data-sort="assigned_user"
                    role="button"
                    tabindex="0"
                    aria-label="Əməkdaşa görə sırala">
                    Müraciətə baxan əməkdaş
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 sortable"
                    data-sort="status"
                    role="button"
                    tabindex="0"
                    aria-label="Statusa görə sırala">
                    Status
                    <i class="fas fa-sort sort-icon ms-1" aria-hidden="true"></i>
                </th>
                <th class="text-secondary opacity-7" aria-label="Əməliyyatlar"></th>
            </tr>
        </thead>
        <tbody>
            @forelse($applications as $application)
            <tr class="application-row" data-id="{{ $application->id }}">
                <td>
                    <div class="d-flex px-2 py-1">
                        <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm">{{ $application->title }}</h6>
                            <div class="d-md-none">
                                <small class="text-muted">
                                    {{ $application->created_at->format('d.m.Y') }}
                                    @if($application->assignedUser)
                                        • {{ $application->assignedUser->name }}
                                    @endif
                                </small>
                            </div>
                        </div>
                    </div>
                </td>
                <td class="d-none d-md-table-cell">
                    <p class="text-sm font-weight-bold mb-0">
                        {{ $application->created_at->format('d.m.Y') }}
                        <small class="d-block text-muted">{{ $application->created_at->format('H:i') }}</small>
                    </p>
                </td>
                <td class="d-none d-lg-table-cell">
                    <p class="text-sm font-weight-bold mb-0">
                        {{ $application->type->value }}
                    </p>
                </td>
                <td class="d-none d-xl-table-cell">
                    <p class="text-sm font-weight-bold mb-0">
                        {{ $application->assignedUser?->name ?? '-' }}
                    </p>
                </td>
                <td>
                    <span class="badge badge-sm bg-{{ $application->status->color() }}"
                          title="{{ $application->status->value }}">
                        <span class="d-none d-sm-inline">{{ $application->status->value }}</span>
                        <span class="d-sm-none">
                            @switch($application->status->value)
                                @case('Pending')
                                    <i class="fas fa-clock"></i>
                                    @break
                                @case('Approved')
                                    <i class="fas fa-check"></i>
                                    @break
                                @case('Rejected')
                                    <i class="fas fa-times"></i>
                                    @break
                                @default
                                    <i class="fas fa-question"></i>
                            @endswitch
                        </span>
                    </span>
                </td>
                <td class="align-middle">
                    <div class="dropdown">
                        <button class="btn btn-link text-secondary dropdown-toggle mb-0"
                                type="button"
                                data-bs-toggle="dropdown"
                                aria-expanded="false">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <a class="dropdown-item" href="{{ route('account.application.show', $application->id) }}">
                                    <i class="fas fa-eye me-2"></i> Bax
                                </a>
                            </li>
                            @if($application->status == \App\Enums\ApplicationStatusEnum::PENDING)
                            <li>
                                <a class="dropdown-item" href="{{ route('account.application.edit', $application->id) }}">
                                    <i class="fas fa-edit me-2"></i> Redaktə et
                                </a>
                            </li>
                            @endif
                        </ul>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center py-5">
                    <div class="d-flex flex-column align-items-center">
                        <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                        <h6 class="text-muted">Heç bir müraciət tapılmadı</h6>
                        <p class="text-muted">Axtarış kriteriyalarınızı dəyişdirməyi sınayın</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
