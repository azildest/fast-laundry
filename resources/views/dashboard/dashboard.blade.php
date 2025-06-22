@extends('layouts.admin')

@section('content')
{{-- Breadcrumb --}}
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
    <h7 class="text-secondary small"> Dashboard</h7>
</div>

{{-- Overview Cards --}}
<div class="row g-2">
    @php
        $cards = [
            ['route' => 'sales.records', 'bg' => '#288bc5', 'icon' => 'fa-cart-shopping', 'title' => "$todaySalesCount Sales Today", 'desc' => 'Total Sales Today'],
            ['route' => 'sales.records', 'bg' => '#FF00B8', 'icon' => 'fa-dollar-sign', 'title' => 'Rp. ' . number_format($todayIncome, 0, ',', '.'), 'desc' => 'Total Income Today'],
            ['route' => 'admin.artikel.publikasi', 'bg' => '#6A00F4', 'icon' => 'fa-file-alt', 'title' => "$articlesNeedingApproval Articles Need Approval", 'desc' => 'Pending Articles'],
            ['route' => 'faq.approval', 'bg' => '#26a37e', 'icon' => 'fa-question-circle', 'title' => "$faqsNeedApproval FAQs Need Approval", 'desc' => 'Pending FAQs'],
        ];
    @endphp

    @foreach ($cards as $card)
        <div class="col-md-3">
            @if ($card['route'])
                <a href="{{ route($card['route']) }}" style="text-decoration: none;">
            @endif
                <div class="card text-white text-center p-1" style="background: {{ $card['bg'] }};">
                    <div class="card-body p-2">
                        <i class="fas {{ $card['icon'] }} fa-2x mb-2"></i>
                        <h5>{{ $card['title'] }}</h5>
                        <p class="mb-1 small">{{ $card['desc'] }}</p>
                    </div>
                </div>
            @if ($card['route'])
                </a>
            @endif
        </div>
    @endforeach
</div>

{{-- Section Title --}}
<div class="p-2 rounded mb-3 mt-4 d-flex align-items-center gap-2" style="background-color: rgba(232,236,239,255);">
    <i class="fas fa-chart-simple text-secondary"></i>
    <span class="text-black small fw-semibold">Graphics</span>
</div>

{{-- Charts --}}
<div class="row">
    {{-- Bar Chart --}}
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <strong>Grafik Pendapatan Harian</strong>
                <span class="small text-muted" id="dashboardChartLabel"></span>
            </div>
            <div class="card-body" style="height: 250px;">
                <canvas id="dashboardDailyChart"></canvas>
            </div>
        </div>
    </div>

    {{-- Pie Chart --}}
    <div class="col-md-6">
        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light d-flex justify-content-between align-items-center">
                <strong>Layanan Terlaris Hari Ini</strong>
                <span class="small text-muted" id="dashboardPieLabel"></span>
            </div>
            <div class="card-body" style="height: 250px;">
                <canvas id="dashboardPieChart"></canvas>
            </div>
        </div>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
const today = new Date().toISOString().slice(0, 10);

// BAR CHART
const barChart = new Chart(document.getElementById('dashboardDailyChart').getContext('2d'), {
    type: 'bar',
    data: { labels: [], datasets: [{
        label: 'Pendapatan Harian',
        data: [],
        backgroundColor: 'rgba(54, 162, 235, 0.5)',
        borderColor: 'rgba(54, 162, 235, 1)',
        borderWidth: 1
    }]},
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            tooltip: {
                callbacks: {
                    label: ctx => 'Rp ' + new Intl.NumberFormat('id-ID').format(ctx.raw)
                }
            }
        },
        scales: {
            y: {
                beginAtZero: true,
                ticks: {
                    callback: val => 'Rp ' + val.toLocaleString('id-ID')
                }
            }
        }
    }
});

// PIE CHART
const pieChart = new Chart(document.getElementById('dashboardPieChart').getContext('2d'), {
    type: 'pie',
    data: { labels: [], datasets: [{
        label: 'Layanan',
        data: [],
        backgroundColor: [
            '#007bff', '#ffc107', '#28a745', '#dc3545', '#6f42c1',
            '#17a2b8', '#fd7e14', '#20c997', '#6610f2', '#e83e8c'
        ]
    }]},
    options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: {
                position: 'right', // Show labels on the right
                labels: {
                    usePointStyle: true,
                    padding: 20,
                    boxWidth: 10
                }
            },
            tooltip: {
                callbacks: {
                    label: ctx => `${ctx.label}: ${ctx.raw} transaksi`
                }
            }
        }
    }
});

// Fetch data
async function fetchDashboardData() {
    try {
        const res = await fetch(`/admin/graphics/sales-data?period=daily&date=${today}`);
        const data = await res.json();

        // Bar Chart
        barChart.data.labels = data.labels;
        barChart.data.datasets[0].data = data.data;
        barChart.update();
        document.getElementById('dashboardChartLabel').textContent = `Tanggal: ${today}`;

        // Pie Chart
        if (data.layanan_pie) {
            pieChart.data.labels = data.layanan_pie.labels;
            pieChart.data.datasets[0].data = data.layanan_pie.data;
            pieChart.update();
            document.getElementById('dashboardPieLabel').textContent = `Tanggal: ${today}`;
        }

    } catch (err) {
        console.error('Gagal mengambil data dashboard:', err);
    }
}

document.addEventListener('DOMContentLoaded', fetchDashboardData);
</script>
@endsection
