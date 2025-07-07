# TableHelper - Advanced Table Management Library

A comprehensive JavaScript library for managing dynamic tables with sorting, searching, pagination, and URL state management. Perfect for admin panels, data grids, and any application requiring advanced table functionality.

## Features

- ✅ **Dynamic Data Loading** - AJAX-powered table updates
- ✅ **Advanced Sorting** - Multi-column sorting with visual indicators
- ✅ **Real-time Search** - Debounced search with customizable delay
- ✅ **Smart Pagination** - URL-aware pagination with state management
- ✅ **URL State Management** - Shareable URLs with current table state
- ✅ **Keyboard Shortcuts** - Ctrl+F for search, Escape to clear, etc.
- ✅ **Responsive Design** - Mobile-friendly interface
- ✅ **Accessibility** - ARIA labels, keyboard navigation, screen reader support
- ✅ **Error Handling** - Comprehensive error management with user feedback
- ✅ **Connection Monitoring** - Online/offline detection
- ✅ **Perfect Scrollbar Integration** - Smooth scrolling for large tables
- ✅ **Bootstrap 5 Compatible** - Works seamlessly with Bootstrap themes
- ✅ **Customizable Messages** - Multi-language support
- ✅ **Analytics Integration** - Google Analytics event tracking
- ✅ **Multiple Instances** - Support for multiple tables on same page

## Quick Start

### 1. Include Dependencies

```html
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- TableHelper -->
<script src="path/to/table-helper.js"></script>
```

### 2. HTML Structure

```html
<div class="card">
    <div class="card-header">
        <h5>My Data Table</h5>
    </div>
    <div class="card-body">
        <!-- Controls -->
        <div class="row mb-3">
            <div class="col-md-4">
                <input type="text" class="form-control" id="searchInput" placeholder="Search...">
            </div>
            <div class="col-md-2">
                <select class="form-select" id="sortBySelect">
                    <option value="name">Name</option>
                    <option value="email">Email</option>
                    <option value="created_at">Created</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="sortDirectionSelect">
                    <option value="asc">Ascending</option>
                    <option value="desc">Descending</option>
                </select>
            </div>
            <div class="col-md-2">
                <select class="form-select" id="perPageSelect">
                    <option value="10">10 per page</option>
                    <option value="25">25 per page</option>
                    <option value="50">50 per page</option>
                </select>
            </div>
        </div>

        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="text-center" style="display: none;">
            <div class="spinner-border" role="status"></div>
        </div>

        <!-- Table Container -->
        <div id="tableContainer">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="sortable" data-sort="name">
                                Name <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th class="sortable" data-sort="email">
                                Email <i class="fas fa-sort sort-icon"></i>
                            </th>
                            <th class="sortable" data-sort="created_at">
                                Created <i class="fas fa-sort sort-icon"></i>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Data will be loaded here -->
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="row mt-3">
            <div class="col-md-6">
                <span id="paginationInfo">Loading...</span>
            </div>
            <div class="col-md-6">
                <div id="paginationLinks"></div>
            </div>
        </div>
    </div>
</div>
```

### 3. Initialize TableHelper

```javascript
$(document).ready(function() {
    const tableHelper = new TableHelper({
        ajaxUrl: '/api/data',
        serverState: {
            search: '',
            sort_by: 'created_at',
            sort_direction: 'desc',
            per_page: '10',
            page: '1'
        }
    });
});
```

## Configuration Options

### Basic Configuration

```javascript
const tableHelper = new TableHelper({
    // Required: AJAX endpoint for data fetching
    ajaxUrl: '/api/data',
    
    // Server state (usually from backend)
    serverState: {
        search: '',
        sort_by: 'created_at',
        sort_direction: 'desc',
        per_page: '10',
        page: '1'
    },
    
    // Timing
    searchDelay: 500,           // Search debounce delay (ms)
    
    // Defaults
    defaultPerPage: 10,
    defaultSort: 'created_at',
    defaultDirection: 'desc',
    
    // Validation
    allowedSorts: ['name', 'email', 'created_at'],
    allowedPerPage: [10, 25, 50, 100],
    
    // Features
    enableSharing: true,
    enableKeyboardShortcuts: true,
    enableTooltips: true,
    enableAnalytics: false
});
```

### Advanced Configuration

```javascript
const tableHelper = new TableHelper({
    // Custom DOM selectors
    tableContainer: '.my-table-container .table',
    searchInput: '#mySearchInput',
    perPageSelect: '#myPerPageSelect',
    sortBySelect: '#mySortBySelect',
    sortDirectionSelect: '#mySortDirectionSelect',
    paginationLinks: '#myPaginationLinks',
    paginationInfo: '#myPaginationInfo',
    loadingSpinner: '#myLoadingSpinner',
    tableWrapper: '#myTableContainer',
    shareUrlBtn: '#myShareUrlBtn',
    clearSearchBtn: '#myClearSearchBtn',
    refreshBtn: '#myRefreshBtn',
    alertContainer: '.my-alert-container',
    
    // Custom messages
    messages: {
        loadError: 'Failed to load data',
        copySuccess: 'Link copied to clipboard!',
        copyError: 'Failed to copy link',
        connectionRestored: 'Connection restored',
        connectionLost: 'Connection lost',
        shareTitle: 'Share Table',
        shareDescription: 'Share this table view:',
        copyButton: 'Copy Link',
        linkCopied: 'Link copied!',
        validationError: 'Invalid request data',
        serverError: 'Server error occurred',
        networkError: 'Check your internet connection',
        generalError: 'An error occurred. Please try again.'
    }
});
```

## Server-Side Integration

### Laravel Example

```php
// Controller
public function index(Request $request)
{
    $query = User::query();
    
    // Search
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('email', 'like', "%{$search}%");
        });
    }
    
    // Sorting
    $sortBy = $request->get('sort_by', 'created_at');
    $sortDirection = $request->get('sort_direction', 'desc');
    
    if (in_array($sortBy, ['name', 'email', 'created_at'])) {
        $query->orderBy($sortBy, $sortDirection);
    }
    
    // Pagination
    $perPage = $request->get('per_page', 10);
    $users = $query->paginate($perPage);
    
    // AJAX Response
    if ($request->ajax()) {
        return response()->json([
            'html' => view('users.table', compact('users'))->render(),
            'pagination' => [
                'current_page' => $users->currentPage(),
                'last_page' => $users->lastPage(),
                'per_page' => $users->perPage(),
                'total' => $users->total(),
                'from' => $users->firstItem(),
                'to' => $users->lastItem(),
                'links' => $users->links('custom.pagination')->render()
            ]
        ]);
    }
    
    return view('users.index', compact('users'));
}
```

### Express.js Example

```javascript
app.get('/api/users', (req, res) => {
    const {
        search = '',
        sort_by = 'created_at',
        sort_direction = 'desc',
        per_page = 10,
        page = 1
    } = req.query;
    
    // Build query
    let query = User.find();
    
    // Search
    if (search) {
        query = query.where({
            $or: [
                { name: { $regex: search, $options: 'i' } },
                { email: { $regex: search, $options: 'i' } }
            ]
        });
    }
    
    // Sort
    const sortOrder = sort_direction === 'desc' ? -1 : 1;
    query = query.sort({ [sort_by]: sortOrder });
    
    // Paginate
    const skip = (page - 1) * per_page;
    query = query.skip(skip).limit(parseInt(per_page));
    
    // Execute
    const users = await query.exec();
    const total = await User.countDocuments();
    
    res.json({
        html: renderUserTable(users),
        pagination: {
            current_page: parseInt(page),
            last_page: Math.ceil(total / per_page),
            per_page: parseInt(per_page),
            total: total,
            from: skip + 1,
            to: Math.min(skip + per_page, total),
            links: generatePaginationLinks(page, Math.ceil(total / per_page))
        }
    });
});
```

## Usage Examples

### Basic Usage

```javascript
// Simple initialization
const table = new TableHelper({
    ajaxUrl: '/api/data'
});
```

### Multiple Tables

```javascript
// Table 1: Active Users
const activeUsersTable = new TableHelper({
    ajaxUrl: '/api/users/active',
    tableContainer: '#activeUsersTable .table',
    searchInput: '#searchActiveUsers',
    perPageSelect: '#perPageActiveUsers',
    paginationLinks: '#paginationActiveUsers',
    loadingSpinner: '#loadingActiveUsers',
    tableWrapper: '#activeUsersContainer'
});

// Table 2: Inactive Users
const inactiveUsersTable = new TableHelper({
    ajaxUrl: '/api/users/inactive',
    tableContainer: '#inactiveUsersTable .table',
    searchInput: '#searchInactiveUsers',
    perPageSelect: '#perPageInactiveUsers',
    paginationLinks: '#paginationInactiveUsers',
    loadingSpinner: '#loadingInactiveUsers',
    tableWrapper: '#inactiveUsersContainer'
});
```

### Custom Event Handling

```javascript
// Listen for table updates
$(document).on('table:updated', function(event, response) {
    console.log('Table updated:', response);
    
    // Update custom UI elements
    updateDashboardStats(response.stats);
    
    // Update charts
    updateCharts(response.chartData);
});

// Listen for table errors
$(document).on('table:error', function(event, xhr, status, error) {
    console.error('Table error:', error);
    
    // Custom error handling
    if (xhr.status === 403) {
        showPermissionDeniedModal();
    }
});
```

### Programmatic Control

```javascript
// Get current parameters
const params = tableHelper.getCurrentParams();
console.log('Current search:', params.search);

// Manual refresh
tableHelper.refreshTable();

// Clear search
tableHelper.clearSearch();

// Show alerts
tableHelper.showSuccess('Data saved successfully!');
tableHelper.showError('Failed to save data');
tableHelper.showWarning('Please check your input');
tableHelper.showInfo('Processing request...');

// Update configuration
tableHelper.updateConfig({
    searchDelay: 1000,
    enableSharing: false
});
```

## CSS Styling

### Required CSS

```css
.sortable {
    cursor: pointer;
    user-select: none;
}

.sortable:hover {
    background-color: #f8f9fa;
}

.sort-icon {
    opacity: 0.5;
    transition: all 0.3s ease;
}

.sort-icon.active {
    opacity: 1;
}

.sort-icon.desc {
    transform: rotate(180deg);
}

.table-responsive {
    position: relative;
}

#loadingSpinner {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 1000;
}
```

### Optional Enhancements

```css
/* Hover effects */
.table tbody tr:hover {
    background-color: #f8f9fa;
}

/* Loading state */
.table-loading {
    opacity: 0.6;
    pointer-events: none;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .table-responsive {
        font-size: 0.875rem;
    }
    
    .sortable {
        padding: 0.5rem 0.25rem;
    }
}

/* Custom scrollbar */
.table-responsive::-webkit-scrollbar {
    height: 8px;
}

.table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
}

.table-responsive::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
}

.table-responsive::-webkit-scrollbar-thumb:hover {
    background: #555;
}
```

## API Reference

### Constructor Options

| Option | Type | Default | Description |
|--------|------|---------|-------------|
| `ajaxUrl` | string | `window.location.pathname` | AJAX endpoint URL |
| `serverState` | object | `{}` | Initial server state |
| `searchDelay` | number | `500` | Search debounce delay (ms) |
| `defaultPerPage` | number | `10` | Default items per page |
| `defaultSort` | string | `'created_at'` | Default sort field |
| `defaultDirection` | string | `'desc'` | Default sort direction |
| `allowedSorts` | array | `['title', 'created_at', 'type', 'status', 'assigned_user']` | Allowed sort fields |
| `allowedPerPage` | array | `[10, 25, 50, 100]` | Allowed per-page options |
| `enableSharing` | boolean | `true` | Enable URL sharing |
| `enableKeyboardShortcuts` | boolean | `true` | Enable keyboard shortcuts |
| `enableTooltips` | boolean | `true` | Enable Bootstrap tooltips |
| `enableAnalytics` | boolean | `false` | Enable Google Analytics |

### Methods

| Method | Parameters | Description |
|--------|------------|-------------|
| `getCurrentParams()` | none | Get current table parameters |
| `updateConfig(config)` | config object | Update configuration |
| `refreshTable()` | none | Refresh table data |
| `clearSearch()` | none | Clear search input |
| `showSuccess(message)` | message string | Show success alert |
| `showError(message)` | message string | Show error alert |
| `showWarning(message)` | message string | Show warning alert |
| `showInfo(message)` | message string | Show info alert |
| `destroy()` | none | Cleanup and destroy instance |

### Events

| Event | Parameters | Description |
|-------|------------|-------------|
| `table:updated` | event, response | Fired when table is updated |
| `table:error` | event, xhr, status, error | Fired when AJAX error occurs |

### Static Methods

| Method | Parameters | Description |
|--------|------------|-------------|
| `TableHelper.create(options)` | options object | Create new instance |
| `TableHelper.getInstance(element)` | DOM element | Get instance from element |

## Keyboard Shortcuts

| Shortcut | Action |
|----------|--------|
| `Ctrl+F` / `Cmd+F` | Focus search input |
| `Escape` | Clear search or blur input |
| `Ctrl+R` / `Cmd+R` | Refresh table |
| `Enter` / `Space` | Activate sortable header |

## Browser Support

- Chrome 60+
- Firefox 55+
- Safari 12+
- Edge 79+
- Internet Explorer 11 (with polyfills)

## Dependencies

- jQuery 3.6+
- Bootstrap 5.0+ (optional, for styling)
- Font Awesome 6.0+ (optional, for icons)

## Contributing

1. Fork the repository
2. Create a feature branch
3. Make your changes
4. Add tests if applicable
5. Submit a pull request

## License

MIT License. See LICENSE file for details.

## Changelog

### Version 1.0.0
- Initial release with core functionality
- AJAX table management
- URL state management
- Keyboard shortcuts
- Accessibility features
- Mobile responsive design

### Version 1.1.0
- Added multiple table support
- Enhanced error handling
- Connection monitoring
- Custom event system
- jQuery plugin wrapper

### Version 1.2.0
- Performance optimizations
- Better mobile support
- Analytics integration
- Custom validation support
- Improved documentation

## Support

For issues and questions:
- Create an issue on GitHub
- Check the documentation
- Review the examples

## Examples

See the `/examples` directory for complete working examples:
- `user-table-example.html` - Complete user management example
- `table-helper-usage.js` - Comprehensive usage examples
- `multiple-tables.html` - Multiple tables on one page
- `custom-styling.html` - Custom styling examples