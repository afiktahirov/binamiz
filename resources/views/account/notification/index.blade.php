@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header pb-0">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <!-- Search Input -->
                            <div class="me-3">
                                <input type="text" id="searchInput" class="form-control form-control-sm" placeholder="Axtar..." style="width: 200px;">
                            </div>
                            <!-- Actions Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-outline-primary dropdown-toggle btn-sm mb-0" type="button" id="actionsDropdown" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Əməliyyatlar
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end p-3" style="min-width: 250px;">
                                    <li class="mb-2">
                                        <label class="form-label text-xs">Sıralama:</label>
                                        <select id="sortBySelect" class="form-select form-select-sm">
                                            <option value="title">Başlıq</option>
                                            <option value="type">Növ</option>
                                            <option value="is_readed">Status</option>
                                            <option value="created_at">Tarix</option>
                                        </select>
                                    </li>
                                    <li class="mb-2">
                                        <label class="form-label text-xs">İstiqamət:</label>
                                        <select id="sortDirectionSelect" class="form-select form-select-sm">
                                            <option value="desc">Azalan</option>
                                            <option value="asc">Yüksələn</option>
                                        </select>
                                    </li>
                                    <li>
                                        <label class="form-label text-xs">Səhifədə göstər:</label>
                                        <select id="perPageSelect" class="form-select form-select-sm">
                                            <option value="10">10</option>
                                            <option value="25">25</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                        </select>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!-- Loading Spinner -->
                    <div id="loadingSpinner" class="text-center py-4" style="display: none;">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                    <!-- Table Container -->
                    <div id="tableContainer">

                    </div>

                    <!-- Pagination Container -->
                    <div id="paginationContainer" class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div class="text-muted mb-2 mb-md-0">
                            <span id="paginationInfo">
                                {{ $notifications->firstItem() ?: 0 }} - {{ $notifications->lastItem() ?: 0 }} / {{ $notifications->total() }} nəticə
                            </span>
                        </div>
                        <div id="paginationLinks">
                            {{ $notifications->links('custom.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.dark-version .notification-status{
    color: white !important;
    opacity: 1 !important;
}
.notification-status{
    color: black !important;
    opacity: 1 !important;
}

.sortable {
    cursor: pointer;
    user-select: none;
}
.sortable:hover {
    background-color: rgba(0,0,0,.05);
}
.sort-icon {
    color: #6c757d;
    opacity: 0.5;
}
.sort-icon.active {
    opacity: 1;
    color: #007bff;
}
.sort-icon.desc {
    transform: rotate(180deg);
}
#searchInput:focus {
    border-color: #007bff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
.table-responsive {
    border-radius: 0.5rem;
}
@media (max-width: 768px) {
    .d-sm-flex {
        flex-direction: column !important;
        gap: 1rem;
    }
    .d-flex.align-items-center {
        flex-direction: column;
        align-items: stretch !important;
        gap: 0.5rem;
    }
    #searchInput {
        width: 100% !important;
    }
}
.table-responsive .table {
    /* height: 400px; */
    overflow: hidden;
    position: relative;
    padding-right: 10px;
}
.table-responsive .table::-webkit-scrollbar {
    display: none; /* Hide scrollbar for WebKit browsers */
}
.table-responsive .table {
    scrollbar-width: none; Hide scrollbar for Firefox
}

</style>
@endsection

@push('scripts')
    <script>
$(document).ready(function() {
    // Define serverState from the Blade variable
    const serverState = @json($currentState);
    // Initialize TableHelper with notification-specific configuration
    const tableHelper = new TableHelper({
        ajaxUrl: '{{ route("account.notifications.index") }}',
        serverState: serverState,
        searchDelay: 500,
        defaultSort: 'created_at',
        defaultDirection: 'desc',
        allowedSorts: ['title', 'content', 'type', 'is_readed', 'created_at'],
        allowedPerPage: [10, 25, 50, 100],
        enableSharing: true,
        enableKeyboardShortcuts: true,
        enableAnalytics: typeof gtag !== 'undefined',
        messages: {
            loadError: 'Məlumat yüklənə bilmədi.',
            copySuccess: 'Link panoya kopyalandı!',
            copyError: 'Kopyalama xətası baş verdi.',
            connectionRestored: 'İnternet bağlantısı bərpa olundu.',
            connectionLost: 'İnternet bağlantısı kəsildi.',
            shareTitle: 'Linki Paylaş',
            shareDescription: 'Bu linki paylaşa bilərsiniz:',
            copyButton: 'Kopyala',
            linkCopied: 'Link kopyalandı!',
            validationError: 'Sorğu məlumatları yanlışdır.',
            serverError: 'Server xətası baş verdi.',
            networkError: 'İnternet bağlantısını yoxlayın.',
            generalError: 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.'
        }
    });

    // Custom event listeners for application-specific functionality
    $(document).on('table:updated', function(event, response) {
        // Handle any application-specific updates after table refresh
        console.log('Table updated:', response);
    });

    $(document).on('table:error', function(event, xhr, status, error) {
        // Handle any application-specific error handling
        console.error('Table error:', error);
    });

    // Store tableHelper instance globally for debugging
    window.applicationTableHelper = tableHelper;
});

    function showDetail(e) {
        const notifications = JSON.parse(e.getAttribute('data-value'));
        Swal.fire({
            title: notifications.title,
            text: notifications.content,
            icon: notifications.type == 'informative' ? 'info' :
                notifications.type == 'success' ? 'success' :
                notifications.type == 'important' ? 'warning' : 'error',
            confirmButtonText: 'Bağla'
        });
        markAsRead(notifications.id);
    }
    function markAsRead(notificationId) {
        $.ajax({
            method: 'POST',
            url: `/account/notifications/${notificationId}/read`,
            success: function () {
                $(`.notification-row[data-id='${notificationId}'] .notification-status`).text('Baxılmış').removeClass('notification-status');
            },
            error: function (xhr) {
                if (xhr.responseJSON?.error)
                    console.error(xhr.responseJSON.error);
                else
                    console.error('Xəta baş verdi, yenidən cəhd edin.');
            }
        });
    }
</script>
@endpush
