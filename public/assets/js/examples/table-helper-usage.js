/**
 * TableHelper Usage Examples
 *
 * This file demonstrates how to use the TableHelper class in different scenarios
 * across various pages in your application.
 */

// ========================================
// BASIC USAGE EXAMPLE
// ========================================

// Simple initialization with default settings
const basicTable = new TableHelper({
    ajaxUrl: '/api/data',
    serverState: {
        search: '',
        sort_by: 'created_at',
        sort_direction: 'desc',
        per_page: '10',
        page: '1'
    }
});

// ========================================
// ADVANCED CONFIGURATION EXAMPLE
// ========================================

// Full configuration with custom settings
const advancedTable = new TableHelper({
    // Required: AJAX endpoint for data fetching
    ajaxUrl: '/admin/users',

    // Server state (usually passed from backend)
    serverState: {
        search: 'john',
        sort_by: 'name',
        sort_direction: 'asc',
        per_page: '25',
        page: '2'
    },

    // Custom DOM selectors
    tableContainer: '.my-table-container .table',
    searchInput: '#userSearch',
    perPageSelect: '#itemsPerPage',
    sortBySelect: '#sortField',
    sortDirectionSelect: '#sortOrder',
    paginationLinks: '#pagination',
    paginationInfo: '#paginationInfo',
    loadingSpinner: '#loading',
    tableWrapper: '#tableData',
    shareUrlBtn: '#shareButton',
    clearSearchBtn: '#clearSearch',
    refreshBtn: '#refreshTable',
    alertContainer: '.alert-container',

    // Configuration options
    searchDelay: 750,                    // Delay for search input (ms)
    defaultPerPage: 25,                  // Default items per page
    defaultSort: 'name',                 // Default sort field
    defaultDirection: 'asc',             // Default sort direction
    allowedSorts: ['name', 'email', 'created_at', 'status'],
    allowedPerPage: [10, 25, 50, 100],

    // Feature toggles
    enableSharing: true,
    enableKeyboardShortcuts: true,
    enableTooltips: true,
    enableAnalytics: true,

    // Custom messages
    messages: {
        loadError: 'Failed to load data',
        copySuccess: 'Link copied to clipboard!',
        copyError: 'Copy failed',
        connectionRestored: 'Connection restored',
        connectionLost: 'Connection lost',
        shareTitle: 'Share Link',
        shareDescription: 'Share this link:',
        copyButton: 'Copy',
        linkCopied: 'Link copied!',
        validationError: 'Invalid request data',
        serverError: 'Server error occurred',
        networkError: 'Check your internet connection',
        generalError: 'An error occurred. Please try again.'
    }
});

// ========================================
// DIFFERENT PAGE EXAMPLES
// ========================================

// Example 1: User Management Page
const userTable = new TableHelper({
    ajaxUrl: '/admin/users',
    allowedSorts: ['name', 'email', 'role', 'created_at', 'last_login'],
    allowedPerPage: [10, 25, 50, 100],
    defaultSort: 'name',
    defaultDirection: 'asc',
    messages: {
        loadError: 'Failed to load users',
        generalError: 'Error loading user data'
    }
});

// Example 2: Order Management Page
const orderTable = new TableHelper({
    ajaxUrl: '/admin/orders',
    allowedSorts: ['order_number', 'customer_name', 'total', 'status', 'created_at'],
    allowedPerPage: [10, 25, 50],
    defaultSort: 'created_at',
    defaultDirection: 'desc',
    searchDelay: 1000, // Longer delay for complex searches
    messages: {
        loadError: 'Failed to load orders',
        generalError: 'Error loading order data'
    }
});

// Example 3: Product Catalog Page
const productTable = new TableHelper({
    ajaxUrl: '/admin/products',
    allowedSorts: ['name', 'price', 'category', 'stock', 'created_at'],
    allowedPerPage: [12, 24, 48, 96], // Different pagination for products
    defaultSort: 'name',
    defaultDirection: 'asc',
    enableSharing: false, // Disable sharing for admin pages
    messages: {
        loadError: 'Failed to load products',
        generalError: 'Error loading product data'
    }
});

// ========================================
// CUSTOM EVENT HANDLING
// ========================================

// Listen for table updates
$(document).on('table:updated', function(event, response) {
    console.log('Table data updated:', response);

    // Custom logic after table update
    if (response.pagination) {
        updateCustomPaginationInfo(response.pagination);
    }

    // Update any custom UI elements
    updateCustomStats(response.stats);
});

// Listen for table errors
$(document).on('table:error', function(event, xhr, status, error) {
    console.error('Table error:', error);

    // Custom error handling
    if (xhr.status === 403) {
        showCustomPermissionError();
    }
});

// ========================================
// PROGRAMMATIC CONTROL
// ========================================

// Get current table parameters
const currentParams = userTable.getCurrentParams();
console.log('Current search:', currentParams.search);
console.log('Current sort:', currentParams.sort_by);

// Update configuration at runtime
userTable.updateConfig({
    searchDelay: 1000,
    enableSharing: false
});

// Manual table refresh
userTable.refreshTable();

// Clear search programmatically
userTable.clearSearch();

// Show custom alerts
userTable.showSuccess('Data saved successfully!');
userTable.showError('Failed to save data');
userTable.showWarning('Please check your input');
userTable.showInfo('Processing your request...');

// ========================================
// CLEANUP
// ========================================

// Destroy table helper when no longer needed
// (Important for single-page applications)
function cleanup() {
    if (window.userTable) {
        window.userTable.destroy();
        window.userTable = null;
    }
}

// ========================================
// JQUERY PLUGIN USAGE
// ========================================

// Use as jQuery plugin
$('#myTable').tableHelper({
    ajaxUrl: '/api/data',
    allowedSorts: ['name', 'date', 'status'],
    defaultSort: 'name'
});

// Get instance from jQuery element
const tableInstance = $('#myTable').data('tableHelper');

// ========================================
// MULTIPLE TABLES ON SAME PAGE
// ========================================

// Table 1: Active Users
const activeUsersTable = new TableHelper({
    ajaxUrl: '/admin/users/active',
    tableContainer: '#activeUsersTable .table',
    searchInput: '#searchActiveUsers',
    perPageSelect: '#perPageActiveUsers',
    paginationLinks: '#paginationActiveUsers',
    loadingSpinner: '#loadingActiveUsers',
    tableWrapper: '#activeUsersContainer',
    allowedSorts: ['name', 'last_login', 'created_at']
});

// Table 2: Inactive Users
const inactiveUsersTable = new TableHelper({
    ajaxUrl: '/admin/users/inactive',
    tableContainer: '#inactiveUsersTable .table',
    searchInput: '#searchInactiveUsers',
    perPageSelect: '#perPageInactiveUsers',
    paginationLinks: '#paginationInactiveUsers',
    loadingSpinner: '#loadingInactiveUsers',
    tableWrapper: '#inactiveUsersContainer',
    allowedSorts: ['name', 'last_login', 'created_at']
});

// ========================================
// INTEGRATION WITH EXISTING CODE
// ========================================

// Example of integrating with existing form submission
$('#filterForm').on('submit', function(e) {
    e.preventDefault();

    // Get form data
    const formData = $(this).serialize();

    // Update table with form filters
    const params = userTable.getCurrentParams();
    params.search = $('#searchInput').val();
    params.category = $('#categorySelect').val();
    params.status = $('#statusSelect').val();

    // Trigger table update
    userTable.updateTableAndUrl(params);
});

// ========================================
// CUSTOM VALIDATION
// ========================================

// Override parameter validation if needed
const customTable = new TableHelper({
    ajaxUrl: '/api/custom-data',
    allowedSorts: ['custom_field', 'another_field'],

    // Custom validation can be added by extending the class
    validateCustomParams: function(params) {
        // Add custom validation logic
        if (params.custom_field && !this.isValidCustomField(params.custom_field)) {
            params.custom_field = this.config.defaultCustomField;
        }
        return params;
    }
});

// ========================================
// ACCESSIBILITY FEATURES
// ========================================

// The TableHelper automatically includes:
// - Keyboard navigation (Enter/Space for sortable headers)
// - ARIA labels for screen readers
// - Focus management
// - Keyboard shortcuts (Ctrl+F for search, Escape to clear)

// Additional accessibility can be added:
$(document).on('table:updated', function() {
    // Announce updates to screen readers
    const announcement = `Table updated with ${$('.table tbody tr').length} results`;
    $('#screenReaderAnnouncement').text(announcement);
});

// ========================================
// PERFORMANCE OPTIMIZATION
// ========================================

// For large datasets, consider:
const optimizedTable = new TableHelper({
    ajaxUrl: '/api/large-dataset',
    searchDelay: 1000,        // Longer delay for expensive searches
    defaultPerPage: 50,       // Larger page size to reduce requests
    enableSharing: false,     // Disable if not needed
    enableAnalytics: false,   // Disable if not needed

    // Custom debouncing for heavy operations
    customDebounce: true
});

// ========================================
// ERROR HANDLING STRATEGIES
// ========================================

// Global error handler
$(document).on('table:error', function(event, xhr, status, error) {
    // Log errors for debugging
    console.error('TableHelper Error:', {
        url: xhr.responseURL,
        status: xhr.status,
        message: error,
        timestamp: new Date().toISOString()
    });

    // Send to error tracking service
    if (window.errorTracker) {
        window.errorTracker.captureException(error, {
            extra: {
                xhr: xhr,
                status: status
            }
        });
    }
});

// ========================================
// MOBILE RESPONSIVENESS
// ========================================

// TableHelper automatically handles mobile responsiveness
// Additional mobile-specific configurations:
const mobileOptimizedTable = new TableHelper({
    ajaxUrl: '/api/mobile-data',
    defaultPerPage: 10,       // Smaller page size for mobile
    searchDelay: 300,         // Faster response for mobile
    enableKeyboardShortcuts: false, // Disable on mobile

    // Mobile-specific messages
    messages: {
        loadError: 'Failed to load',
        copySuccess: 'Copied!',
        generalError: 'Error occurred'
    }
});

// Responsive behavior
$(window).on('resize', function() {
    if ($(window).width() < 768) {
        // Mobile-specific adjustments
        mobileOptimizedTable.updateConfig({
            searchDelay: 300,
            defaultPerPage: 10
        });
    }
});
