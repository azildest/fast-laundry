@extends('layouts.admin')

@section('content')
    {{-- Breadcrumb --}}
    <div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
        <a href="{{ route('dashboard') }}" class="text-primary small text-decoration-none">Dashboard</a>
        <h7 class="text-secondary small">/ Sales Records</h7>
    </div>
    {{-- <div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
        <a href="{{ route('sales-records') }}" class="text-primary small text-decoration-none">Sales</a>
    </div> --}}
    {{-- End Breadcrumb --}}

    <div class="sales-page">
        <div class="controls">
        <div class="filter-options">
            <h3>Filter By:</h3>
            <div class="filter-group">
            <label for="category">Category:</label>
            <select id="category">
                <option value="">All</option>
                <option value="electronics">Electronics</option>
                <option value="clothing">Clothing</option>
                <option value="books">Books</option>
                </select>
            </div>
            <div class="filter-group">
            <label for="price-range">Price Range:</label>
            <select id="price-range">
                <option value="">All</option>
                <option value="0-50">$0 - $50</option>
                <option value="51-100">$51 - $100</option>
                <option value="100+">$100+</option>
            </select>
            </div>
            </div>
    
        <div class="search-panel">
            <label for="search-term">Search:</label>
            <input type="text" id="search-term" placeholder="Enter keywords...">
            <button>Search</button>
        </div>
    
        <div class="actions">
            <button class="refresh-button">Refresh</button>
            <button class="reset-button">Reset Filters</button>
        </div>
        </div>
    
        <div class="sales-table-container">
        <table>
            <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Sales Quantity</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Awesome Gadget X</td>
                <td>Electronics</td>
                <td>$99.99</td>
                <td>150</td>
                <td>2025-05-04</td>
                <td>
                <button class="view-button">View</button>
                <button class="edit-button">Edit</button>
                <button class="delete-button">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        </div>
    
        <div class="add-new-button-container">
        <button class="add-new-button">+ Add New Product</button>
        </div>
    
    </div>
@endsection