@extends('layouts.admin')

@section('content')
{{-- Breadcrumb --}}
    <div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
        <h7 class="text-secondary small"> Dashboard</h7>
    </div>

{{-- CONTENT START --}}
    {{-- Data Overview Cards --}}
    <div class="row g-2">
        <!-- Sales Card -->
        <div class="col-md-3">
            <a href="{{ route('sales.records') }}" style="text-decoration: none;">
                <div class="card text-white text-center p-1" style="background: #288bc5;">
                    <div class="card-body p-2">
                        <i class="fas fa-cart-shopping fa-2x mb-2"></i>
                        <h5>0 Sales Today</h5>
                        <p class="mb-1 small">Total Sales Today</p>
                    </div>
                </div>
            </a>
        </div>
        
     {{-- Articles Pending Approval Card --}}
<div class="col-md-3">
    <div class="card text-white text-center p-1" style="background: #6A00F4;">
        <div class="card-body p-2">
            <i class="fas fa-file-alt fa-2x mb-2"></i>
            <h5>{{ $pendingCount }} Articles Need Approval</h5>
            <p class="mb-1 small">Pending Articles</p>
        </div>
    </div>
</div>

{{-- Published Articles Card --}}
<div class="col-md-3">
    <div class="card text-white text-center p-1" style="background: #FF00B8;">
        <div class="card-body p-2">
            <i class="fas fa-check-circle fa-2x mb-2"></i>
            <h5>{{ $publishedCount }} Published Articles</h5>
            <p class="mb-1 small">Published Articles</p>
        </div>
    </div>
</div>

{{-- Pending FAQs Approval Card --}}
<div class="col-md-3">
    <div class="card text-white text-center p-1" style="background: #26a37e;">
        <div class="card-body p-2">
            <i class="fas fa-question-circle fa-2x mb-2"></i>
            <h5>{{ $faqPendingCount }} FAQs Need Approval</h5>
            <p class="mb-1 small">Pending FAQs</p>
        </div>
    </div>
</div>


    {{-- Title for Chart Section --}}
    <div class="p-2 rounded mb-3 mt-3 d-flex align-items-center gap-2" style="background-color: rgba(232,236,239,255);">
        <i class="fas fa-chart-simple text-secondary"></i>
        <span class="text-black small fw-semibold">Graphics</span>
    </div>
    

    {{-- Chart Section --}}
    <div class="mt-5">
        <canvas id="salesChart"></canvas>
    </div>

    {{-- Chart.js Script --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for the Bar Chart
        const ctx = document.getElementById('salesChart').getContext('2d');
        const salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May'], // Replace with dynamic months if needed
                datasets: [{
                    label: 'Sales',
                    data: [5, 10, 15, 20, 25], // Replace with dynamic sales data
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
{{-- CONTENT END --}}
@endsection
