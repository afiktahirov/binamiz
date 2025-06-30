@extends('layouts.app')
@section('content')
<div class="container-fluid">
    <div class="d-sm-flex justify-content-between">
        <div>
          <a href="{{ route('account.application.create') }}" class="btn btn-primary btn-icon">
            Yeni müraciət əlavə et
          </a>
        </div>
    </div>
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
                            <!-- Share URL Button -->
                            <div class="me-2">
                                <button class="btn btn-outline-secondary btn-sm" id="shareUrlBtn" title="Linki paylaş">
                                    <i class="fas fa-share-alt"></i>
                                </button>
                            </div>
                            <!-- Actions Dropdown -->
                            <div class="dropdown">
                                <button class="btn btn-outline-dark dropdown-toggle btn-sm" type="button" id="actionsDropdown" data-bs-toggle="dropdown">
                                    <i class="fas fa-cog"></i> Əməliyyatlar
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end p-3" style="min-width: 250px;">
                                    <li class="mb-2">
                                        <label class="form-label text-xs">Sıralama:</label>
                                        <select id="sortBySelect" class="form-select form-select-sm">
                                            <option value="created_at">Tarix</option>
                                            <option value="title">Başlıq</option>
                                            <option value="type">Növ</option>
                                            <option value="status">Status</option>
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
                        @include('account.application.table', ['applications' => $applications])
                    </div>

                    <!-- Pagination Container -->
                    <div id="paginationContainer" class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                        <div class="text-muted mb-2 mb-md-0">
                            <span id="paginationInfo">
                                {{ $applications->firstItem() ?: 0 }} - {{ $applications->lastItem() ?: 0 }} / {{ $applications->total() }} nəticə
                            </span>
                        </div>
                        <div id="paginationLinks">
                            {{ $applications->links('custom.pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
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
</style>

<script>
$(document).ready(function() {
    let currentPage = 1;
    let searchTimeout;
    let isInitialLoad = true;

    // Get initial state from server
    const serverState = @json($currentState ?? []);

    // Current sort state
    let currentSort = serverState.sort_by || 'created_at';
    let currentDirection = serverState.sort_direction || 'desc';

    // URL management utilities
    const UrlManager = {
        getParams: function() {
            const urlParams = new URLSearchParams(window.location.search);
            return {
                search: urlParams.get('search') || '',
                sort_by: urlParams.get('sort_by') || 'created_at',
                sort_direction: urlParams.get('sort_direction') || 'desc',
                per_page: urlParams.get('per_page') || '10',
                page: urlParams.get('page') || '1'
            };
        },

        updateUrl: function(params, replaceState = false) {
            const url = new URL(window.location);

            // Clear existing parameters
            ['search', 'sort_by', 'sort_direction', 'per_page', 'page'].forEach(param => {
                url.searchParams.delete(param);
            });

            // Add new parameters (only if they're not default values)
            if (params.search && params.search.trim() !== '') {
                url.searchParams.set('search', params.search);
            }

            if (params.sort_by && params.sort_by !== 'created_at') {
                url.searchParams.set('sort_by', params.sort_by);
            }

            if (params.sort_direction && params.sort_direction !== 'desc') {
                url.searchParams.set('sort_direction', params.sort_direction);
            }

            if (params.per_page && params.per_page !== '10') {
                url.searchParams.set('per_page', params.per_page);
            }

            if (params.page && params.page !== '1') {
                url.searchParams.set('page', params.page);
            }

            // Update URL
            const method = replaceState ? 'replaceState' : 'pushState';
            window.history[method](params, '', url.toString());
        },

        hasUrlParams: function() {
            return window.location.search.length > 0;
        },

        getCurrentUrl: function() {
            return window.location.href;
        },

        buildShareableUrl: function(params) {
            const url = new URL(window.location.origin + window.location.pathname);

            if (params.search && params.search.trim() !== '') {
                url.searchParams.set('search', params.search);
            }
            if (params.sort_by !== 'created_at') {
                url.searchParams.set('sort_by', params.sort_by);
            }
            if (params.sort_direction !== 'desc') {
                url.searchParams.set('sort_direction', params.sort_direction);
            }
            if (params.per_page !== '10') {
                url.searchParams.set('per_page', params.per_page);
            }
            if (params.page !== '1') {
                url.searchParams.set('page', params.page);
            }

            return url.toString();
        },

        validateParams: function(params) {
            // Validate and clean parameters
            const validatedParams = {
                search: (params.search || '').toString().trim(),
                sort_by: ['title', 'created_at', 'type', 'status', 'assigned_user'].includes(params.sort_by)
                    ? params.sort_by : 'created_at',
                sort_direction: ['asc', 'desc'].includes(params.sort_direction)
                    ? params.sort_direction : 'desc',
                per_page: ['10', '25', '50', '100'].includes(params.per_page.toString())
                    ? params.per_page.toString() : '10',
                page: parseInt(params.page) > 0 ? params.page.toString() : '1'
            };

            return validatedParams;
        },

        cleanCurrentUrl: function() {
            const params = this.getParams();
            const cleanParams = this.validateParams(params);

            // Check if URL needs cleaning
            const needsCleaning = (
                params.search !== cleanParams.search ||
                params.sort_by !== cleanParams.sort_by ||
                params.sort_direction !== cleanParams.sort_direction ||
                params.per_page !== cleanParams.per_page ||
                params.page !== cleanParams.page
            );

            if (needsCleaning) {
                this.updateUrl(cleanParams, true);
                return cleanParams;
            }

            return params;
        }
    };

    // Initialize from URL parameters or server state
    function initializeFromUrl() {
        // Clean URL first if needed
        const cleanParams = UrlManager.cleanCurrentUrl();

        // Use cleaned URL params first, then server state as fallback
        const params = {
            search: cleanParams.search || serverState.search || '',
            sort_by: cleanParams.sort_by || serverState.sort_by || 'created_at',
            sort_direction: cleanParams.sort_direction || serverState.sort_direction || 'desc',
            per_page: cleanParams.per_page || serverState.per_page || '10',
            page: cleanParams.page || serverState.page || '1'
        };

        // Set form values
        $('#searchInput').val(params.search);
        $('#sortBySelect').val(params.sort_by);
        $('#sortDirectionSelect').val(params.sort_direction);
        $('#perPageSelect').val(params.per_page);

        // Update current state
        currentSort = params.sort_by;
        currentDirection = params.sort_direction;
        currentPage = parseInt(params.page);

        return params;
    }

    function loadApplications(page = 1, updateUrlFlag = true) {
        const rawParams = {
            page: page,
            search: $('#searchInput').val(),
            sort_by: $('#sortBySelect').val() || currentSort,
            sort_direction: $('#sortDirectionSelect').val() || currentDirection,
            per_page: $('#perPageSelect').val()
        };

        // Validate parameters
        const params = UrlManager.validateParams(rawParams);

        // Update URL if requested
        if (updateUrlFlag) {
            UrlManager.updateUrl(params, isInitialLoad);
            isInitialLoad = false;
        }

        $('#loadingSpinner').show();
        $('#tableContainer').hide();

        $.ajax({
            url: '{{ route("account.application.index") }}',
            type: 'GET',
            data: params,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            },
            success: function(response) {
                if (response.html) {
                    $('#tableContainer').html(response.html);
                    updatePagination(response.pagination);
                    updateSortIcons();
                    currentPage = page;
                } else {
                    showError('Məlumat yüklənə bilmədi.');
                }
                $('#loadingSpinner').hide();
                $('#tableContainer').show();
            },
            error: function(xhr, status, error) {
                $('#loadingSpinner').hide();
                $('#tableContainer').show();

                let errorMessage = 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.';
                if (xhr.status === 422) {
                    errorMessage = 'Sorğu məlumatları yanlışdır.';
                } else if (xhr.status === 500) {
                    errorMessage = 'Server xətası baş verdi.';
                } else if (xhr.status === 0) {
                    errorMessage = 'İnternet bağlantısını yoxlayın.';
                }

                showError(errorMessage);
            }
        });
    }

    function updatePagination(pagination) {
        const info = `${pagination.from || 0} - ${pagination.to || 0} / ${pagination.total} nəticə`;
        $('#paginationInfo').text(info);
        $('#paginationLinks').html(pagination.links);
    }

    function updateSortIcons() {
        // Reset all icons
        $('.sort-icon').removeClass('active desc');

        // Update active sort icon
        const activeHeader = $(`.sortable[data-sort="${currentSort}"]`);
        const icon = activeHeader.find('.sort-icon');
        icon.addClass('active');

        if (currentDirection === 'desc') {
            icon.addClass('desc');
        }
    }

    // Search functionality
    $('#searchInput').on('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(function() {
            currentPage = 1;
            loadApplications(1, true);
        }, 500);
    });

    // Clear search
    $('#searchInput').on('keydown', function(e) {
        if (e.key === 'Escape') {
            $(this).val('');
            currentPage = 1;
            loadApplications(1, true);
        }
    });

    // Sort functionality
    $(document).on('click', '.sortable', function() {
        const sortField = $(this).data('sort');

        if (currentSort === sortField) {
            // Toggle direction if same field
            currentDirection = currentDirection === 'asc' ? 'desc' : 'asc';
        } else {
            // New field, default to desc
            currentSort = sortField;
            currentDirection = 'desc';
        }

        $('#sortBySelect').val(currentSort);
        $('#sortDirectionSelect').val(currentDirection);

        currentPage = 1;
        loadApplications(1, true);
    });

    // Dropdown change handlers
    $('#sortBySelect, #sortDirectionSelect, #perPageSelect').on('change', function() {
        currentSort = $('#sortBySelect').val();
        currentDirection = $('#sortDirectionSelect').val();
        currentPage = 1;
        loadApplications(1, true);
    });

    // Pagination click handler
    $(document).on('click', '.pagination a', function(e) {
        e.preventDefault();
        const url = $(this).attr('href');
        if (url) {
            const urlParams = new URLSearchParams(url.split('?')[1]);
            const page = urlParams.get('page');
            if (page) {
                loadApplications(parseInt(page), true);
            }
        }
    });

    // Handle window resize for responsive behavior
    $(window).on('resize', function() {
        // Adjust table responsiveness if needed
    });

    // Prevent form submission on enter in search
    $('#searchInput').on('keypress', function(e) {
        if (e.which === 13) {
            e.preventDefault();
        }
    });

    // Keyboard navigation for sortable headers
    $(document).on('keydown', '.sortable', function(e) {
        if (e.key === 'Enter' || e.key === ' ') {
            e.preventDefault();
            $(this).click();
        }
    });

    // Keyboard shortcuts
    $(document).on('keydown', function(e) {
        // Ctrl/Cmd + F to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
            e.preventDefault();
            $('#searchInput').focus().select();
        }
        // Escape to clear search when focused
        if (e.key === 'Escape' && $('#searchInput').is(':focus')) {
            $('#searchInput').val('').trigger('input');
        }
    });

    // Handle browser back/forward buttons
    window.addEventListener('popstate', function(event) {
        if (event.state) {
            // Restore state from browser history
            const state = event.state;
            $('#searchInput').val(state.search || '');
            $('#sortBySelect').val(state.sort_by || 'created_at');
            $('#sortDirectionSelect').val(state.sort_direction || 'desc');
            $('#perPageSelect').val(state.per_page || '10');

            currentSort = state.sort_by || 'created_at';
            currentDirection = state.sort_direction || 'desc';
            currentPage = parseInt(state.page) || 1;

            // Load applications without updating URL (to avoid infinite loop)
            loadApplications(currentPage, false);
        } else {
            // Fallback to URL parameters
            const urlState = initializeFromUrl();
            loadApplications(parseInt(urlState.page), false);
        }
    });

    // Initialize from URL and load data
    const initialState = initializeFromUrl();

    // Check if we need to load fresh data or use server-rendered data
    const hasUrlParams = UrlManager.hasUrlParams();
    const urlMatchesServer = (
        initialState.search === (serverState.search || '') &&
        initialState.sort_by === (serverState.sort_by || 'created_at') &&
        initialState.sort_direction === (serverState.sort_direction || 'desc') &&
        initialState.per_page === (serverState.per_page || '10') &&
        initialState.page === (serverState.page || '1')
    );

    if (hasUrlParams && !urlMatchesServer) {
        // URL params differ from server state - load fresh data
        loadApplications(currentPage, false);
    } else {
        // URL matches server state or no URL params - just sync URL
        UrlManager.updateUrl(initialState, true);
        isInitialLoad = false;
    }

    // Initialize sort icons
    updateSortIcons();

    // Share URL functionality
    $('#shareUrlBtn').on('click', function() {
        const rawParams = {
            search: $('#searchInput').val(),
            sort_by: $('#sortBySelect').val() || currentSort,
            sort_direction: $('#sortDirectionSelect').val() || currentDirection,
            per_page: $('#perPageSelect').val(),
            page: currentPage.toString()
        };

        const currentParams = UrlManager.validateParams(rawParams);

        const shareableUrl = UrlManager.buildShareableUrl(currentParams);

        // Add analytics or tracking if needed
        if (typeof gtag !== 'undefined') {
            gtag('event', 'share_url', {
                'event_category': 'applications',
                'event_label': 'table_state'
            });
        }

        // Try to copy to clipboard
        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(shareableUrl).then(function() {
                showSuccess('Link panoya kopyalandı!');

                // Visual feedback
                const btn = $('#shareUrlBtn');
                const originalIcon = btn.find('i').attr('class');
                btn.find('i').attr('class', 'fas fa-check text-success');

                setTimeout(function() {
                    btn.find('i').attr('class', originalIcon);
                }, 2000);
            }).catch(function() {
                // Fallback for older browsers
                showShareModal(shareableUrl);
            });
        } else {
            // Fallback for older browsers or non-secure contexts
            showShareModal(shareableUrl);
        }
    });

    // Share modal fallback
    function showShareModal(url) {
        const modalHtml = `
            <div class="modal fade" id="shareModal" tabindex="-1">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Linki Paylaş</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2">Bu linki paylaşa bilərsiniz:</p>
                            <div class="input-group">
                                <input type="text" class="form-control" id="shareUrlInput" value="${url}" readonly>
                                <button class="btn btn-outline-secondary" type="button" id="copyUrlBtn">
                                    <i class="fas fa-copy"></i> Kopyala
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        // Remove existing modal
        $('#shareModal').remove();

        // Add modal to body
        $('body').append(modalHtml);

        // Show modal
        const modal = new bootstrap.Modal(document.getElementById('shareModal'));
        modal.show();

        // Copy functionality
        $('#copyUrlBtn').on('click', function() {
            const input = document.getElementById('shareUrlInput');
            input.select();
            input.setSelectionRange(0, 99999); // For mobile devices

            try {
                document.execCommand('copy');
                showSuccess('Link kopyalandı!');
                modal.hide();
            } catch (err) {
                showError('Kopyalama xətası baş verdi.');
            }
        });

        // Auto-select text when modal is shown
        $('#shareModal').on('shown.bs.modal', function() {
            $('#shareUrlInput').select();
        });

        // Clean up modal when hidden
        $('#shareModal').on('hidden.bs.modal', function() {
            $(this).remove();
        });
    }

    // Handle connection issues
    $(window).on('online', function() {
        showSuccess('İnternet bağlantısı bərpa olundu.');
    });

    $(window).on('offline', function() {
        showError('İnternet bağlantısı kəsildi.');
    });

    // Initialize tooltips if Bootstrap is available
    if (typeof bootstrap !== 'undefined') {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });
    }

    // Error handling function
    function showError(message) {
        // Remove existing error alerts
        $('.alert-danger').remove();

        // Create new error alert
        const errorAlert = `
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-triangle me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        $('.card-header').after(errorAlert);

        // Auto-hide after 5 seconds
        setTimeout(function() {
            $('.alert-danger').fadeOut();
        }, 5000);
    }

    // Success message function
    function showSuccess(message) {
        $('.alert-success').remove();

        const successAlert = `
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        $('.card-header').after(successAlert);

        setTimeout(function() {
            $('.alert-success').fadeOut();
        }, 3000);
    }

    // Enhanced loading state management
    $(document).ajaxStart(function() {
        $('#loadingSpinner').show();
        $('#tableContainer').css('opacity', '0.5');
        $('button, input, select').prop('disabled', true);
    }).ajaxStop(function() {
        $('#loadingSpinner').hide();
        $('#tableContainer').css('opacity', '1');
        $('button, input, select').prop('disabled', false);
    });
});
</script>
@endsection
