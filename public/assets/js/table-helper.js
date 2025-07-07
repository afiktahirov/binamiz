class TableHelper {
    constructor(options = {}) {
        // Core state
        this.currentPage = 1;
        this.searchTimeout = null;
        this.isInitialLoad = true;
        this.serverState = options.serverState || {};
        this.currentSort = this.serverState.sort_by || "created_at";
        this.currentDirection = this.serverState.sort_direction || "desc";

        // Configuration
        this.config = {
            ajaxUrl: options.ajaxUrl || window.location.pathname,
            searchDelay: options.searchDelay || 500,
            defaultPerPage: options.defaultPerPage || 10,
            defaultSort: options.defaultSort || "created_at",
            defaultDirection: options.defaultDirection || "desc",
            allowedSorts: options.allowedSorts || [
                "title",
                "created_at",
                "type",
                "status",
            ],
            allowedPerPage: options.allowedPerPage || [10, 25, 50, 100],
            enableSharing: options.enableSharing !== false,
            enableKeyboardShortcuts: options.enableKeyboardShortcuts !== false,
            enableTooltips: options.enableTooltips !== false,
            enableAnalytics: options.enableAnalytics || false,
            messages: {
                loadError:
                    options.messages?.loadError || "Məlumat yüklənə bilmədi.",
                copySuccess:
                    options.messages?.copySuccess || "Link panoya kopyalandı!",
                copyError:
                    options.messages?.copyError ||
                    "Kopyalama xətası baş verdi.",
                connectionRestored:
                    options.messages?.connectionRestored ||
                    "İnternet bağlantısı bərpa olundu.",
                connectionLost:
                    options.messages?.connectionLost ||
                    "İnternet bağlantısı kəsildi.",
                shareTitle: options.messages?.shareTitle || "Linki Paylaş",
                shareDescription:
                    options.messages?.shareDescription ||
                    "Bu linki paylaşa bilərsiniz:",
                copyButton: options.messages?.copyButton || "Kopyala",
                linkCopied: options.messages?.linkCopied || "Link kopyalandı!",
                validationError:
                    options.messages?.validationError ||
                    "Sorğu məlumatları yanlışdır.",
                serverError:
                    options.messages?.serverError || "Server xətası baş verdi.",
                networkError:
                    options.messages?.networkError ||
                    "İnternet bağlantısını yoxlayın.",
                generalError:
                    options.messages?.generalError ||
                    "Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.",
            },
        };

        // DOM elements
        this.elements = {
            tableContainer: $(
                options.tableContainer || ".table-responsive .table",
            ),
            searchInput: $(options.searchInput || "#searchInput"),
            perPageSelect: $(options.perPageSelect || "#perPageSelect"),
            paginationContainer: $(
                options.paginationContainer || "#paginationContainer",
            ),
            sortBySelect: $(options.sortBySelect || "#sortBySelect"),
            sortDirectionSelect: $(
                options.sortDirectionSelect || "#sortDirectionSelect",
            ),
            paginationLinks: $(options.paginationLinks || "#paginationLinks"),
            paginationInfo: $(options.paginationInfo || "#paginationInfo"),
            loadingSpinner: $(options.loadingSpinner || "#loadingSpinner"),
            tableWrapper: $(options.tableWrapper || "#tableContainer"),
            shareUrlBtn: $(options.shareUrlBtn || "#shareUrlBtn"),
            clearSearchBtn: $(options.clearSearchBtn || "#clearSearchBtn"),
            refreshBtn: $(options.refreshBtn || "#refreshBtn"),
            alertContainer: $(options.alertContainer || ".card-header"),
        };

        // Initialize PerfectScrollbar if available
        if (
            this.elements.tableContainer.length &&
            typeof PerfectScrollbar !== "undefined"
        ) {
            this.ps = new PerfectScrollbar(this.elements.tableContainer[0]);
        }

        // Initialize components
        this.initializeEventListeners();
        this.initializeFromUrl();
        this.initializeAdditionalFeatures();
    }

    // URL management utilities
    static UrlManager = {
        getParams: function () {
            const urlParams = new URLSearchParams(window.location.search);
            return {
                search: urlParams.get("search") || "",
                sort_by: urlParams.get("sort_by") || "created_at",
                sort_direction: urlParams.get("sort_direction") || "desc",
                per_page: urlParams.get("per_page") || "10",
                page: urlParams.get("page") || "1",
            };
        },

        updateUrl: function (params, replaceState = false) {
            const url = new URL(window.location);

            // Clear existing params
            ["search", "sort_by", "sort_direction", "per_page", "page"].forEach(
                (param) => {
                    url.searchParams.delete(param);
                },
            );

            // Add non-default params
            if (params.search && params.search.trim() !== "") {
                url.searchParams.set("search", params.search);
            }
            if (params.sort_by && params.sort_by !== "created_at") {
                url.searchParams.set("sort_by", params.sort_by);
            }
            if (params.sort_direction && params.sort_direction !== "desc") {
                url.searchParams.set("sort_direction", params.sort_direction);
            }
            if (params.per_page && params.per_page !== "10") {
                url.searchParams.set("per_page", params.per_page);
            }
            if (params.page && params.page !== "1") {
                url.searchParams.set("page", params.page);
            }

            const method = replaceState ? "replaceState" : "pushState";
            window.history[method](params, "", url.toString());
        },

        hasUrlParams: function () {
            return window.location.search.length > 0;
        },

        getCurrentUrl: function () {
            return window.location.href;
        },

        buildShareableUrl: function (params) {
            const url = new URL(
                window.location.origin + window.location.pathname,
            );

            if (params.search && params.search.trim() !== "") {
                url.searchParams.set("search", params.search);
            }
            if (params.sort_by !== "created_at") {
                url.searchParams.set("sort_by", params.sort_by);
            }
            if (params.sort_direction !== "desc") {
                url.searchParams.set("sort_direction", params.sort_direction);
            }
            if (params.per_page !== "10") {
                url.searchParams.set("per_page", params.per_page);
            }
            if (params.page !== "1") {
                url.searchParams.set("page", params.page);
            }

            return url.toString();
        },

        validateParams: function (
            params,
            allowedSorts = [
                "title",
                "created_at",
                "type",
                "status",
                "assigned_user",
            ],
            allowedPerPage = [10, 25, 50, 100],
        ) {
            const validatedParams = {
                search: (params.search || "").toString().trim(),
                sort_by: allowedSorts.includes(params.sort_by)
                    ? params.sort_by
                    : "created_at",
                sort_direction: ["asc", "desc"].includes(params.sort_direction)
                    ? params.sort_direction
                    : "desc",
                per_page: allowedPerPage.includes(parseInt(params.per_page))
                    ? params.per_page.toString()
                    : "10",
                page: parseInt(params.page) > 0 ? params.page.toString() : "1",
            };
            return validatedParams;
        },

        cleanCurrentUrl: function (allowedSorts, allowedPerPage) {
            const params = this.getParams();
            const cleanParams = this.validateParams(
                params,
                allowedSorts,
                allowedPerPage,
            );
            const needsCleaning =
                params.search !== cleanParams.search ||
                params.sort_by !== cleanParams.sort_by ||
                params.sort_direction !== cleanParams.sort_direction ||
                params.per_page !== cleanParams.per_page ||
                params.page !== cleanParams.page;

            if (needsCleaning) {
                this.updateUrl(cleanParams, true);
                return cleanParams;
            }
            return params;
        },
    };

    // Initialize all event listeners
    initializeEventListeners() {
        // Search functionality
        this.elements.searchInput.on("input", (e) => this.handleSearch(e));

        // Clear search functionality
        this.elements.clearSearchBtn.on("click", () => this.clearSearch());

        // Refresh functionality
        this.elements.refreshBtn.on("click", () => this.refreshTable());

        // Sort functionality
        $(document).on("click", ".sortable", (e) => this.handleSort(e));

        // Dropdown change handlers
        this.elements.perPageSelect.on("change", (e) =>
            this.handlePerPageChange(e),
        );

        if (this.elements.sortBySelect.length) {
            this.elements.sortBySelect.on("change", (e) =>
                this.handleSortByChange(e),
            );
        }

        if (this.elements.sortDirectionSelect.length) {
            this.elements.sortDirectionSelect.on("change", (e) =>
                this.handleSortDirectionChange(e),
            );
        }

        // Pagination functionality
        $(document).on("click", ".pagination a", (e) =>
            this.handlePaginationClick(e),
        );

        // Browser navigation
        $(window).on("popstate", () => this.handlePopState());

        // Share functionality
        if (this.config.enableSharing && this.elements.shareUrlBtn.length) {
            this.elements.shareUrlBtn.on("click", () => this.handleShareUrl());
        }

        // Keyboard navigation for sortable headers
        $(document).on("keydown", ".sortable", function (e) {
            if (e.key === "Enter" || e.key === " ") {
                e.preventDefault();
                $(this).click();
            }
        });

        // Prevent form submission on enter in search
        this.elements.searchInput.on("keypress", function (e) {
            if (e.which === 13) {
                e.preventDefault();
            }
        });

        // Handle window resize for responsive behavior
        $(window).on("resize", () => this.handleResize());
    }

    // Initialize from URL parameters
    initializeFromUrl() {
        const params = TableHelper.UrlManager.cleanCurrentUrl(
            this.config.allowedSorts,
            this.config.allowedPerPage,
        );
        this.updateTable(params);
        this.updateUIState(params);
    }

    // Initialize additional features
    initializeAdditionalFeatures() {
        // Keyboard shortcuts
        if (this.config.enableKeyboardShortcuts) {
            this.initializeKeyboardShortcuts();
        }

        // Connection monitoring
        this.initializeConnectionMonitoring();

        // Tooltips
        if (this.config.enableTooltips) {
            this.initializeTooltips();
        }

        // AJAX loading states
        this.initializeAjaxStates();
    }

    // Keyboard shortcuts
    initializeKeyboardShortcuts() {
        $(document).on("keydown", (e) => {
            // Ctrl/Cmd + F to focus search
            if ((e.ctrlKey || e.metaKey) && e.key === "f") {
                e.preventDefault();
                this.elements.searchInput.focus().select();
            }

            // Escape to clear search when focused
            if (e.key === "Escape") {
                if (this.elements.searchInput.is(":focus")) {
                    this.clearSearch();
                } else {
                    this.elements.searchInput.blur();
                }
            }

            // Ctrl/Cmd + R to refresh
            if ((e.ctrlKey || e.metaKey) && e.key === "r") {
                e.preventDefault();
                this.refreshTable();
            }
        });
    }

    // Connection monitoring
    initializeConnectionMonitoring() {
        $(window).on("online", () => {
            this.showSuccess(this.config.messages.connectionRestored);
        });

        $(window).on("offline", () => {
            this.showError(this.config.messages.connectionLost);
        });
    }

    // Initialize tooltips
    initializeTooltips() {
        if (typeof bootstrap !== "undefined") {
            const tooltipTriggerList = [].slice.call(
                document.querySelectorAll('[data-bs-toggle="tooltip"]'),
            );
            const tooltipList = tooltipTriggerList.map(
                function (tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                },
            );
        }
    }

    // AJAX loading states
    initializeAjaxStates() {
        $(document)
            .ajaxStart((event, xhr, settings) => {
                var targetUrl = event.currentTarget.origin + '' + event.currentTarget.pathname;
                if (targetUrl === this.config.ajaxUrl) {
                    this.setLoadingState(true);
                }
            })
            .ajaxStop((event, xhr, settings) => {
                var targetUrl = event.currentTarget.origin + '' + event.currentTarget.pathname;
                if (targetUrl === this.config.ajaxUrl) {
                    this.setLoadingState(false);
                }
            });
    }

    // Event handlers
    handleSearch(e) {
        clearTimeout(this.searchTimeout);
        this.searchTimeout = setTimeout(() => {
            const params = TableHelper.UrlManager.getParams();
            params.search = e.target.value;
            params.page = "1";
            this.updateTableAndUrl(params);
        }, this.config.searchDelay);
    }

    handleSort(e) {
        const sortBy = $(e.currentTarget).data("sort");
        const params = TableHelper.UrlManager.getParams();

        if (sortBy === params.sort_by) {
            params.sort_direction =
                params.sort_direction === "asc" ? "desc" : "asc";
        } else {
            params.sort_by = sortBy;
            params.sort_direction = this.config.defaultDirection;
        }

        params.page = "1";
        this.updateTableAndUrl(params);
    }

    handleSortByChange(e) {
        const params = TableHelper.UrlManager.getParams();
        params.sort_by = e.target.value;
        params.page = "1";
        this.updateTableAndUrl(params);
    }

    handleSortDirectionChange(e) {
        const params = TableHelper.UrlManager.getParams();
        params.sort_direction = e.target.value;
        params.page = "1";
        this.updateTableAndUrl(params);
    }

    handlePerPageChange(e) {
        const params = TableHelper.UrlManager.getParams();
        params.per_page = e.target.value;
        params.page = "1";
        this.updateTableAndUrl(params);
    }

    handlePaginationClick(e) {
        e.preventDefault();
        const href = $(e.currentTarget).attr("href");
        if (!href) return;

        const url = new URL(href, window.location.origin);
        const params = TableHelper.UrlManager.getParams();
        params.page = url.searchParams.get("page") || "1";
        this.updateTableAndUrl(params);
    }

    handlePopState() {
        const params = TableHelper.UrlManager.getParams();
        this.updateTable(params);
        this.updateUIState(params);
    }

    handleResize() {
        if (this.ps) {
            this.ps.update();
        }
    }

    // Core functionality
    updateTableAndUrl(params) {
        TableHelper.UrlManager.updateUrl(params);
        this.updateTable(params);
        this.updateUIState(params);
    }

    updateTable(params) {
        const validatedParams = TableHelper.UrlManager.validateParams(
            params,
            this.config.allowedSorts,
            this.config.allowedPerPage,
        );

        if (this.elements.loadingSpinner.length)
            this.elements.loadingSpinner.show();
        if (this.elements.tableWrapper.length)
            this.elements.tableWrapper.hide();

        $.ajax({
            url: this.config.ajaxUrl,
            method: "GET",
            data: validatedParams,
            headers: {
                "X-Requested-With": "XMLHttpRequest",
            },
            success: (response) => {
                this.handleAjaxSuccess(response);
            },
            error: (xhr, status, error) => {
                this.handleAjaxError(xhr, status, error);
            },
        });
    }

    handleAjaxSuccess(response) {
        if (response.html) {
            if (this.elements.tableWrapper.length) {
                this.elements.tableWrapper.html(response.html).show();
            } else {
                this.elements.tableContainer
                    .closest(".table-responsive")
                    .html(response.html);
            }

            if (this.elements.paginationLinks.length && response.pagination) {
                this.elements.paginationLinks.html(response.pagination.links);
                this.updatePaginationInfo(response.pagination);
            }

            if (this.ps) {
                this.ps.update();
            }

            // Trigger custom event
            $(document).trigger("table:updated", [response]);
        }

        if (this.elements.loadingSpinner.length)
            this.elements.loadingSpinner.hide();
    }

    handleAjaxError(xhr, status, error) {
        if (this.elements.loadingSpinner.length)
            this.elements.loadingSpinner.hide();
        if (this.elements.tableWrapper.length)
            this.elements.tableWrapper.show();

        let errorMessage = this.config.messages.generalError;

        if (xhr.status === 422) {
            errorMessage = this.config.messages.validationError;
        } else if (xhr.status === 500) {
            errorMessage = this.config.messages.serverError;
        } else if (xhr.status === 0) {
            errorMessage = this.config.messages.networkError;
        }

        this.showError(errorMessage);

        // Trigger custom event
        $(document).trigger("table:error", [xhr, status, error]);
    }

    updateUIState(params) {
        // Update form elements
        if (this.elements.searchInput.length)
            this.elements.searchInput.val(params.search);
        if (this.elements.perPageSelect.length)
            this.elements.perPageSelect.val(params.per_page);
        if (this.elements.sortBySelect.length)
            this.elements.sortBySelect.val(params.sort_by);
        if (this.elements.sortDirectionSelect.length)
            this.elements.sortDirectionSelect.val(params.sort_direction);

        // Update sort icons
        this.updateSortIcons(params.sort_by, params.sort_direction);

        // Update internal state
        this.currentSort = params.sort_by;
        this.currentDirection = params.sort_direction;
        this.currentPage = parseInt(params.page);
    }

    updateSortIcons(sortBy, sortDirection) {
        $(".sort-icon").removeClass("active desc");

        const currentSortHeader = $(`.sortable[data-sort="${sortBy}"]`);
        if (currentSortHeader.length) {
            const icon = currentSortHeader.find(".sort-icon");
            icon.addClass("active");
            if (sortDirection === "desc") {
                icon.addClass("desc");
            }
        }
    }

    updatePaginationInfo(pagination) {
        if (this.elements.paginationInfo.length) {
            const info = `${pagination.from || 0} - ${pagination.to || 0} / ${pagination.total} nəticə`;
            this.elements.paginationInfo.text(info);
        }
    }

    // Utility methods
    clearSearch() {
        this.elements.searchInput.val("");
        const params = TableHelper.UrlManager.getParams();
        params.search = "";
        params.page = "1";
        this.updateTableAndUrl(params);
    }

    refreshTable() {
        const params = TableHelper.UrlManager.getParams();
        this.updateTable(params);

        if (this.config.enableAnalytics && typeof gtag !== "undefined") {
            gtag("event", "table_refresh", {
                event_category: "table_interaction",
            });
        }
    }

    setLoadingState(isLoading) {
        if (isLoading) {
            if (this.elements.loadingSpinner.length)
                this.elements.loadingSpinner.show();
            if (this.elements.tableWrapper.length)
                this.elements.tableWrapper.css("opacity", "0.5");
            $("button:not(.btn-close), input, select").prop("disabled", true);
        } else {
            if (this.elements.loadingSpinner.length)
                this.elements.loadingSpinner.hide();
            if (this.elements.tableWrapper.length)
                this.elements.tableWrapper.css("opacity", "1");
            $("button:not(.btn-close), input, select").prop("disabled", false);
        }
    }

    // Alert methods
    showError(message) {
        this.showAlert(message, "danger", "fas fa-exclamation-triangle", 5000);
    }

    showSuccess(message) {
        this.showAlert(message, "success", "fas fa-check-circle", 3000);
    }

    showWarning(message) {
        this.showAlert(message, "warning", "fas fa-exclamation-triangle", 4000);
    }

    showInfo(message) {
        this.showAlert(message, "info", "fas fa-info-circle", 3000);
    }

    showAlert(
        message,
        type = "info",
        icon = "fas fa-info-circle",
        duration = 3000,
    ) {
        $(`.alert-${type}`).remove();

        const alertHtml = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                <i class="${icon} me-2"></i>
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;

        this.elements.alertContainer.after(alertHtml);

        if (duration > 0) {
            setTimeout(() => {
                $(`.alert-${type}`).fadeOut();
            }, duration);
        }
    }

    // Share functionality
    handleShareUrl() {
        const params = TableHelper.UrlManager.getParams();
        const shareableUrl = TableHelper.UrlManager.buildShareableUrl(params);

        if (this.config.enableAnalytics && typeof gtag !== "undefined") {
            gtag("event", "share_url", {
                event_category: "table_interaction",
                event_label: "share_table_state",
            });
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard
                .writeText(shareableUrl)
                .then(() => {
                    this.showSuccess(this.config.messages.copySuccess);
                    this.updateShareButtonState();
                })
                .catch(() => {
                    this.showShareModal(shareableUrl);
                });
        } else {
            this.showShareModal(shareableUrl);
        }
    }

    updateShareButtonState() {
        const btn = this.elements.shareUrlBtn;
        const originalIcon = btn.find("i").attr("class");
        btn.find("i").attr("class", "fas fa-check text-success");

        setTimeout(() => {
            btn.find("i").attr("class", originalIcon);
        }, 2000);
    }

    showShareModal(url) {
        const modalHtml = `
            <div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="shareModalLabel">${this.config.messages.shareTitle}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <p class="mb-2">${this.config.messages.shareDescription}</p>
                            <div class="input-group">
                                <input type="text" class="form-control" id="shareUrlInput" value="${url}" readonly>
                                <button class="btn btn-outline-secondary" type="button" id="copyUrlBtn">
                                    <i class="fas fa-copy"></i> ${this.config.messages.copyButton}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;

        $("#shareModal").remove();
        $("body").append(modalHtml);

        const modal = new bootstrap.Modal(
            document.getElementById("shareModal"),
        );
        modal.show();

        $("#copyUrlBtn").on("click", () => {
            const input = document.getElementById("shareUrlInput");
            input.select();
            input.setSelectionRange(0, 99999);

            try {
                document.execCommand("copy");
                this.showSuccess(this.config.messages.linkCopied);
                modal.hide();
            } catch (err) {
                this.showError(this.config.messages.copyError);
            }
        });

        $("#shareModal").on("shown.bs.modal", () => {
            $("#shareUrlInput").select();
        });

        $("#shareModal").on("hidden.bs.modal", function () {
            $(this).remove();
        });
    }

    // Public API methods
    getCurrentParams() {
        return TableHelper.UrlManager.getParams();
    }

    updateConfig(newConfig) {
        this.config = { ...this.config, ...newConfig };
    }

    destroy() {
        // Remove event listeners
        $(document).off("click", ".sortable");
        $(document).off("click", ".pagination a");
        $(document).off("keydown", ".sortable");
        $(window).off("popstate");
        $(window).off("resize");

        // Clear timeouts
        if (this.searchTimeout) {
            clearTimeout(this.searchTimeout);
        }

        // Destroy PerfectScrollbar
        if (this.ps) {
            this.ps.destroy();
        }

        // Remove modals
        $("#shareModal").remove();
    }

    // Static helper methods
    static create(options) {
        return new TableHelper(options);
    }

    static getInstance(element) {
        return $(element).data("tableHelper");
    }
}

// jQuery plugin wrapper
if (typeof $ !== "undefined") {
    $.fn.tableHelper = function (options) {
        return this.each(function () {
            if (!$(this).data("tableHelper")) {
                $(this).data("tableHelper", new TableHelper(options));
            }
        });
    };
}

// Export for module systems
if (typeof module !== "undefined" && module.exports) {
    module.exports = TableHelper;
}

// Global registration
if (typeof window !== "undefined") {
    window.TableHelper = TableHelper;
}
