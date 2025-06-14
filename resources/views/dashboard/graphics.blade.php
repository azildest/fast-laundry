@extends('layouts.admin')

@section('content')

    {{-- Title for Chart Section --}}
  <!-- Breadcrumb -->
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
  <h7 class="text-secondary small">
    <a href="{{ route('dashboard') }}" class="text-primary text-decoration-none">Dashboard</a> /
    <span class="text-dark">Grafik</span>
  </h7>
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