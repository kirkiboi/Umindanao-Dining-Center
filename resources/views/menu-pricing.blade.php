<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu & Pricing System</title>
    <link rel="icon" href="{{asset('favicon.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css" integrity="sha512-2SwdPD6INVrV/lHTZbO2nodKhrnDdJK9/kg2XD1r9uGqPo1cUbujc+IYdlYdEErWNu69gVcYgdxlmVmzTWnetw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @vite(['resources/css/menu-pricing.css'])
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
                        <li class = "menu-pricing-navigation"><a href="{{ url('/menu-pricing')}}">Menu and Pricing</a></li>
                        <li><a href="">Kitchen Production</a></li>
                        <li><a href="">Cost and Variance Analysis</a></li>
                    </ul>
                    <button>Logout</button>
                </nav>
            </div>
        </div>
        <div class="table-header-container">
            <div class="table-header-sub-container">
                <div class="header-controls">
                    <div class="header-left-controls">
                        <button class="header-all-button">
                            <svg id="filter-button" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                <polyline points="6 9 12 15 18 9"></polyline>
                            </svg>
                            <div id="filter-options">
                                <div class="filter-container">
                                    <a href="{{ route('menu-pricing', ['category' => 'Drinks']) }}" class="filter-link">Drinks</a><br>
                                    <a href="{{ route('menu-pricing', ['category' => 'Meals']) }}" class="filter-link">Meals</a><br>
                                    <a href="{{ route('menu-pricing', ['category' => 'Snacks']) }}" class="filter-link">Snacks</a><br>
                                    <a href="{{ route('menu-pricing') }}" class="filter-link">All</a>
                                </div>
                            </div>
                        </button>
                        <div class="header-search-box">
                            <form action="{{ route('menu-pricing') }}" method="GET" id="searchForm">
                                <input type="hidden" name="category" value="{{ $category ?? '' }}">
                                <input type="text" 
                                    class="search-input" 
                                    placeholder="Search" 
                                    id="searchInput"
                                    name="search"
                                    value="{{ request('search') }}">
                            </form>
                        </div>
                        <div class="row-count">
                            {{ $products->firstItem() }} - {{ $products->lastItem() }} of {{ $products->total() }}
                        </div>
                        <div class="pagination-controls">
                            <div class="page-buttons">
                                <button class="page-btn" @if ($products->onFirstPage()) disabled @endif
                                    onclick="window.location='{{ $products->previousPageUrl() }}'">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <polyline points="15 18 9 12 15 6"></polyline> 
                                    </svg>
                                </button>
                                <div class="page-info">
                                    {{ $products->currentPage() }} / {{ $products->lastPage() }}
                                </div>
                                <button class="page-btn" @if (!$products->hasMorePages()) disabled @endif
                                    onclick="window.location='{{ $products->nextPageUrl() }}'">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="16" height="16">
                                        <polyline points="9 6 15 12 9 18"></polyline> 
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <div class="header-buttons">
                            <form action="{{route('create-product') }}" method="GET">
                                <button class="header-add-item-button"><i class="fa-solid fa-plus"></i>Add Item</button>
                            </form>
                            <a href="{{ route('audit-trail') }}">
                                <button class="logs-button">Audit Trail</button>
                            </a>
                            
                        </div>
                    </div>
                </div>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr class="tr">
                                <th class="th">Item Name</th>
                                <th class="th">Category</th>
                                <th class="th">Price</th>
                                <th class="th">Action</th>
                            </tr>
                        </thead>
                        <tbody id="tableBody">
                            @foreach($products as $product)
                            <tr class="tr">
                                <td>
                                    <div class="product-name-and-image">
                                        <img src="{{ asset($product->image) }}" 
                                            alt="{{ $product->name }}">
                                        <span>{{ $product->name }}</span>
                                    </div>
                                </td>
                                <td>{{ $product->category }}</td> 
                                <td>{{ $product->price }}</td>   
                                <td class="actions">
                                    <i class="fa-solid fa-pencil"
                                        onclick="window.location='{{ route('edit-product', $product->id) }}'">
                                    </i>
                                    <form action="{{ route('delete-product', $product->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="background: none; border: none; color: inherit; cursor: pointer; padding: 0;">
                                            <i class="fa-solid fa-trash-can"></i>
                                        </button>
                                    </form>
                                </td>                 
                            </tr> 
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>