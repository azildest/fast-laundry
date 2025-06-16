@extends('layouts.admin')

@section('content')

<style>
    #dailyWrapper .card-body {
        height: 300px;
    }
</style>

<!-- Breadcrumb -->
<div class="p-2 rounded mb-3" style="background-color: rgba(232,236,239,255);">
    <a href="{{ route('dashboard') }}" class="text-primary small text-decoration-none">Dashboard</a>
    <h7 class="text-secondary small">/ Grafik</h7>
</div>

<!-- Filter Waktu -->
<div class="d-flex flex-wrap gap-2 mb-3 align-items-center">
    <button class="btn btn-outline-primary btn-sm filter-btn" data-period="daily">Harian</button>
    <button class="btn btn-outline-primary btn-sm filter-btn" data-period="weekly">Mingguan</button>
    <button class="btn btn-primary btn-sm filter-btn" data-period="monthly" id="defaultFilter">Bulanan</button>
    <button class="btn btn-outline-primary btn-sm filter-btn" data-period="yearly">Tahunan</button>

    <div class="ms-3" id="calendarFilterWrapper">
        <label class="small me-1">Pilih Tanggal:</label>
        <input id="calendarInput" class="form-control form-control-sm" type="month" style="width: auto;">
    </div>
</div>

<!-- Ringkasan & Export -->
<div class="d-flex justify-content-between align-items-center mb-3">
    <h5>Total Pendapatan: <span id="totalPendapatan" class="badge bg-success">💰 Rp 0</span></h5>
    <div class="d-flex gap-2">
        <button class="btn btn-outline-danger btn-sm" onclick="exportToPDF()">🧾 Ekspor PDF</button>
    </div>
</div>

<!-- Statistik & Grafik -->
<div id="exportWrapper">
    <div class="text-muted small mb-3" id="statistikTambahan"></div>

    <!-- Grafik Harian + Pie Chart (side by side) -->
    <div class="row mb-4" id="dailyWrapper" style="display: none;">
        <div class="col-md-8">
            <div class="card shadow-sm h-100">
                <div class="card-header bg-light"><strong>Grafik Harian</strong></div>
                <div class="card-body">
                    <canvas id="dailyChart" height="250"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card shadow-sm h-100" id="pieChartCard">
                <div class="card-header bg-light"><strong>Komposisi Layanan Harian</strong></div>
                <div class="card-body">
                    <canvas id="pieChart" height="250"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Grafik Utama -->
    <div class="card shadow-sm mb-4" id="mainChartCard">
        <div class="card-header bg-light">
            <strong>Grafik Penjualan</strong> <span id="judulPeriode" class="text-muted small"></span>
        </div>
        <div class="card-body">
            <canvas id="salesChart" height="100"></canvas>
        </div>
    </div>

    <!-- Tabel Penjualan -->
    <div class="card shadow-sm" id="tabelCard">
        <div class="card-header bg-light"><strong>Data Tabel Penjualan</strong></div>
        <div class="card-body p-0">
            <table class="table table-sm mb-0">
                <thead>
                    <tr>
                        <th>Tanggal</th>
                        <th>Total Pendapatan</th>
                    </tr>
                </thead>
                <tbody id="dataTableBody"></tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js & PDF -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

<script>
let salesChart, dailyChart, pieChart;
let activePeriod = 'monthly';

const calendarInput = document.getElementById('calendarInput');
const judulPeriode = document.getElementById('judulPeriode');
const ctxMain = document.getElementById('salesChart').getContext('2d');
const ctxDaily = document.getElementById('dailyChart').getContext('2d');
const ctxPie = document.getElementById('pieChart').getContext('2d');

function createChart(ctx, type = 'bar') {
    return new Chart(ctx, {
        type: type,
        data: {
            labels: [],
            datasets: [{
                label: 'Total Pendapatan',
                data: [],
                backgroundColor: [],
                borderColor: [],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            animation: { duration: 1000 },
            plugins: {
                legend: {
                    display: type === 'pie',
                    position: 'bottom'
                },
                tooltip: {
                        callbacks: {
                        label: function(context) {
                            const value = context.raw;
                            return 'Rp ' + new Intl.NumberFormat('id-ID').format(value);
                        }
                    }

                }
            },
            scales: type !== 'pie' ? {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: value => new Intl.NumberFormat('id-ID', {
                            style: 'currency',
                            currency: 'IDR',
                            minimumFractionDigits: 0
                        }).format(value)
                    }
                }
            } : undefined
        }
    });
}

salesChart = createChart(ctxMain);
dailyChart = createChart(ctxDaily);
pieChart = createChart(ctxPie, 'pie');

function updateCalendarInput(period) {
    const now = new Date();
    switch (period) {
        case 'daily':
            calendarInput.type = 'date';
            calendarInput.value = now.toISOString().slice(0, 10);
            break;
        case 'weekly':
            calendarInput.type = 'week';
            const week = getWeekNumber(now);
            calendarInput.value = `${now.getFullYear()}-W${String(week).padStart(2, '0')}`;
            break;
        case 'monthly':
            calendarInput.type = 'month';
            calendarInput.value = `${now.getFullYear()}-${String(now.getMonth() + 1).padStart(2, '0')}`;
            break;
        case 'yearly':
            calendarInput.type = 'number';
            calendarInput.min = 2020;
            calendarInput.max = now.getFullYear();
            calendarInput.value = now.getFullYear();
            break;
    }
}

function getWeekNumber(d) {
    d = new Date(Date.UTC(d.getFullYear(), d.getMonth(), d.getDate()));
    const dayNum = d.getUTCDay() || 7;
    d.setUTCDate(d.getUTCDate() + 4 - dayNum);
    const yearStart = new Date(Date.UTC(d.getUTCFullYear(), 0, 1));
    return Math.ceil((((d - yearStart) / 86400000) + 1) / 7);
}

function getIndonesianDayName(dateStr) {
    const hariIndo = ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'];
    const date = new Date(dateStr);
    let day = date.getDay();
    return hariIndo[(day + 1) % 7];
}

async function fetchSalesData(period, _b = null, _t = null, customUrl = null) {
    try {
        document.querySelectorAll('.filter-btn').forEach(btn =>
            btn.classList.replace('btn-primary', 'btn-outline-primary')
        );
        const activeBtn = document.querySelector(`[data-period="${period}"]`);
        if (activeBtn) activeBtn.classList.replace('btn-outline-primary', 'btn-primary');

        let url = customUrl ?? `/admin/graphics/sales-data?period=${period}`;
        const response = await fetch(url);
        const result = await response.json();

        // Chart switching
        document.getElementById('dailyWrapper').style.display = 'none';
        document.getElementById('mainChartCard').style.display = 'none';


        const colors = result.data.map(val => val >= 0 ? 'rgba(54, 162, 235, 0.5)' : 'rgba(255, 99, 132, 0.5)');
        const borders = result.data.map(val => val >= 0 ? 'rgba(54, 162, 235, 1)' : 'rgba(255, 99, 132, 1)');

        const chart = period === 'daily' ? dailyChart : salesChart;
        const cardToShow = period === 'daily' ? 'dailyCard' : 'mainChartCard';

        chart.data.labels = result.labels;
        chart.data.datasets[0].data = result.data;
        chart.data.datasets[0].backgroundColor = colors;
        chart.data.datasets[0].borderColor = borders;
        chart.update();

        if (period === 'daily') {
            document.getElementById('dailyWrapper').style.display = 'flex';
        } else {
            document.getElementById(cardToShow).style.display = 'block';
        }

        // Judul
        const val = calendarInput.value;
        if (period === 'daily') {
            judulPeriode.textContent = `(Tanggal: ${val})`;
        } else if (period === 'weekly') {
            const [year, week] = val.split('-W');
            judulPeriode.textContent = `(Minggu ke-${week}, ${year})`;
        } else if (period === 'monthly') {
            const [y, m] = val.split('-');
            const bulanText = new Date(y, m - 1).toLocaleString('id-ID', { month: 'long' });
            judulPeriode.textContent = `(Bulan: ${bulanText} ${y})`;
        } else if (period === 'yearly') {
            judulPeriode.textContent = `(Tahun: ${val})`;
        }

        // Total Pendapatan
        const total = result.total_pendapatan || 0;
        document.getElementById('totalPendapatan').textContent = new Intl.NumberFormat('id-ID', {
            style: 'currency', currency: 'IDR', minimumFractionDigits: 0
        }).format(total);

        // Statistik tambahan
        const max = Math.max(...result.data);
        const avg = result.data.reduce((a, b) => a + b, 0) / result.data.length;
        const naik = result.perbandingan_sebelumnya?.naik;
        const persen = result.perbandingan_sebelumnya?.persentase;
        const keterangan = persen !== undefined
            ? (naik ? `📈 Naik ${persen}% dari periode sebelumnya |` : `📉 Menurun ${Math.abs(persen)}% dari periode sebelumnya |`)
            : '';
        const populer = result.layanan_terlaris?.nama ?? 'belum ada';
        document.getElementById('statistikTambahan').textContent = `📊 Rata-rata: Rp ${Math.round(avg).toLocaleString('id-ID')} | Tertinggi: Rp ${max.toLocaleString('id-ID')} | ${keterangan} ⭐ Layanan terpopuler: ${populer}`;

        // Tabel
        let html = '';
        result.labels.forEach((label, i) => {
            let hari = label;
            if (activePeriod === 'weekly') {
                hari = `${getIndonesianDayName(label)} (${label})`;
            }
            html += `<tr><td>${hari}</td><td>Rp ${result.data[i].toLocaleString('id-ID')}</td></tr>`;
        });
        document.getElementById('dataTableBody').innerHTML = html;

        // Pie Chart (khusus harian)
        if (period === 'daily') {
            const layananLabels = result.layanan_pie?.labels || [];
            const layananData = result.layanan_pie?.data || [];

            pieChart.data.labels = layananLabels;
            pieChart.data.datasets[0].data = layananData;
            pieChart.data.datasets[0].backgroundColor = layananLabels.map((_, i) =>
                `hsl(${i * 360 / layananLabels.length}, 70%, 60%)`
            );
            pieChart.update();

            document.getElementById('pieChartCard').style.display = layananData.length > 0 ? 'block' : 'none';
        }

    } catch (error) {
        console.error('Gagal mengambil data:', error);
        alert('Terjadi kesalahan saat mengambil data penjualan.');
    }
}

function fetchByCalendar() {
    const value = calendarInput.value;
    let url = `/admin/graphics/sales-data?period=${activePeriod}`;
    if (activePeriod === 'daily') {
        if (!value) return alert('Tanggal harus dipilih.');
        url += `&date=${value}`;
    } else if (activePeriod === 'weekly') {
        const [year, week] = value.split('-W');
        url += `&year=${year}&week=${week}`;
    } else if (activePeriod === 'monthly') {
        const [year, month] = value.split('-');
        url += `&month=${month}&year=${year}`;
    } else if (activePeriod === 'yearly') {
        url += `&year=${value}`;
    }
    fetchSalesData(activePeriod, null, null, url);
}

function exportToPDF() {
    const element = document.getElementById('exportWrapper');
    const opt = {
        margin: 0.5,
        filename: `laporan_penjualan_${activePeriod}.pdf`,
        image: { type: 'jpeg', quality: 0.98 },
        html2canvas: { scale: 2 },
        jsPDF: { unit: 'in', format: 'a4', orientation: 'portrait' }
    };
    html2pdf().set(opt).from(element).save();
}

document.querySelectorAll('.filter-btn').forEach(button => {
    button.addEventListener('click', () => {
        activePeriod = button.dataset.period;
        updateCalendarInput(activePeriod);
        fetchByCalendar();
    });
});
calendarInput.addEventListener('change', fetchByCalendar);

document.addEventListener('DOMContentLoaded', () => {
    updateCalendarInput(activePeriod);
    fetchByCalendar();
});
</script>
@endsection
