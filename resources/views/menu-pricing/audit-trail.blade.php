<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu & Pricing System</title>
    <link rel="icon" href="{{ asset('favicon.png') }}">
    @vite(['resources/css/menu-pricing/audit.trail.css'])
    @vite('resources/js/menu-pricing/menu-pricing.js')
</head>
<body>
    <div class="parent-container">
        <div class="sidebar-container">
            <div class="nav-logo">
                <img src="{{ asset('photos/UMDiningcenter.png') }}" alt="UM Dining Center Logo" class ="dashboard-logoDiningCenter">
            </div>
            <div class="nav-general">
                <h1>General</h1>
            </div>
            <div class="navigation-container">
                <nav class = "navigation">
                    <ul class = "navigation-ul">
                        <li><a href="">Dashboard</a></li>
                        <li><a href="">Sales</a></li>
                        <li><a href="">Inventory</a></li>
                        <li><a href="{{ url('/menu-pricing')}}">Menu and Pricing</a></li>
                        <li><a href="">Kitchen Production</a></li>
                        <li><a href="">Cost and Variance Analysis</a></li>
                    </ul>
                    <button>Logout</button>
                </nav>
            </div>
        </div>
            <!-- TABLE -->

        <div class="table-header-container">
            <div class="table-header-sub-container">
                <div class="header-left-controls">
                    <button class="header-all-button">
                        <svg id="filter-button" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                            <polyline points="6 9 12 15 18 9"></polyline>
                        </svg>
                    </button>
                    <div class="header-search-box">
                        <form method="GET" action="{{ route('audit-trail') }}" id="searchForm">
                            <input type="text" 
                                class="search-input" 
                                placeholder="Search by item name" 
                                id="searchInput"
                                name="search"
                                value="{{ request('search') }}">
                            <input type="hidden" name="range" value="{{ request('range', '30') }}">
                        </form>
                    </div>
                </div>
                <div class="date-filter">
                    <form method="GET" action="{{ route('audit-trail') }}" id="filterForm">
                        <select name="range" class="date-filter-range" onchange="this.form.submit()">
                            <option value="0" {{ request('range') == '0' ? 'selected' : '' }}>Today</option>
                            <option value="30" {{ request('range') == '30' || !request('range') ? 'selected' : '' }}>Last 30 Days</option>
                            <option value="60" {{ request('range') == '60' ? 'selected' : '' }}>Last 60 Days</option>
                            <option value="all" {{ request('range') == 'all' ? 'selected' : '' }}>All</option>
                        </select>
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    </form>
                </div>
                <div class="pagination-controls">
                    <span>
                        {{ $logs->currentPage() }} out of {{ $logs->lastPage() }}
                    </span>
                    @if($logs->previousPageUrl())
                        <a href="{{ $logs->previousPageUrl() }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                <polyline points="15 18 9 12 15 6"></polyline> 
                            </svg>
                        </a>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="opacity: 0.3;">
                            <polyline points="15 18 9 12 15 6"></polyline> 
                        </svg>
                    @endif
                    
                    @if($logs->nextPageUrl())
                        <a href="{{ $logs->nextPageUrl() }}">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                <polyline points="9 6 15 12 9 18"></polyline> 
                            </svg>
                        </a>
                    @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16" style="opacity: 0.3;">
                            <polyline points="9 6 15 12 9 18"></polyline> 
                        </svg>
                    @endif
                </div>
                <div class="header-buttons">
                    <button>Export Audit Log</button>
                </div>
            </div>
            <div class="main-table">
                <div class="table-container">
                    <table>
                        <thead>
                            <tr class="tr">
                                <th class="th table-content-itemName">Item Name</th>
                                <th>Action Type</th>
                                <th class="th">Date & Time</th>
                                <th class="th">User ID</th>
                                <th class="th">Previous Price</th>
                                <th class="th">New Price</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @forelse($logs as $log)
                                <tr>
                                    <td>{{ $log->item_name }}</td>
                                    <td>{{ ucwords(str_replace('_', ' ', $log->action_type)) }}</td>
                                    <td>{{ $log->created_at->format('m/d/Y h:i A') }}</td>
                                    <td>{{ $log->user_id }}</td>
                                    <td>{{ $log->previous_price ? number_format($log->previous_price, 2) : '-' }}</td>
                                    <td>{{ $log->new_price ? number_format($log->new_price, 2) : '-' }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center;">No audit logs found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>        
            </div>
        </div>
    </div>
</body>
</html>