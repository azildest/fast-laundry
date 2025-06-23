<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Penjualan;
use App\Models\Layanan;
use Carbon\Carbon;

class GrafikController extends Controller
{
    public function getSalesData(Request $request)
    {
        $periode = $request->query('period', 'monthly');
        $selectedMonth = (int) $request->query('month', Carbon::now()->month);
        $selectedYear = (int) $request->query('year', Carbon::now()->year);
        $query = Penjualan::query();

        $rangeStart = null;
        $rangeEnd = null;
        $labels = [];
        $labelFormat = fn($label) => $label;
        $data = collect();
        $selectedDate = null;

        switch ($periode) {
            case 'daily':
                $selectedDate = $request->query('date', Carbon::now()->toDateString());
                $parsedDate = Carbon::parse($selectedDate);
                $rangeStart = $parsedDate->copy()->startOfDay();
                $rangeEnd = $parsedDate->copy()->endOfDay();
                $labels = [$parsedDate->format('Y-m-d')];
                $labelFormat = fn($label) => Carbon::parse($label)->translatedFormat('d M Y');

                $data = $query->whereDate('pesanan_dibuat', $parsedDate)
                    ->selectRaw('DATE(pesanan_dibuat) as label, SUM(total_harga) as total')
                    ->groupBy('label')
                    ->get();
                break;

            case 'weekly':
                $selectedWeek = (int) $request->query('week', Carbon::now()->isoWeek());
                $startOfWeek = Carbon::now()->setISODate($selectedYear, $selectedWeek)->startOfWeek();
                $endOfWeek = $startOfWeek->copy()->endOfWeek();
                $rangeStart = $startOfWeek->copy()->startOfDay();
                $rangeEnd = $endOfWeek->copy()->endOfDay();
                $labelFormat = fn($label) => Carbon::parse($label)->translatedFormat('D, d M');

                for ($date = $startOfWeek->copy(); $date->lte($endOfWeek); $date->addDay()) {
                    $labels[] = $date->format('Y-m-d');
                }

                $data = $query->whereBetween('pesanan_dibuat', [$rangeStart, $rangeEnd])
                    ->selectRaw('DATE(pesanan_dibuat) as label, SUM(total_harga) as total')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
                break;

            case 'yearly':
                $rangeStart = Carbon::create($selectedYear, 1, 1)->startOfYear();
                $rangeEnd = Carbon::create($selectedYear, 12, 31)->endOfYear();

                $data = $query->whereYear('pesanan_dibuat', $selectedYear)
                    ->selectRaw('MONTH(pesanan_dibuat) as label, SUM(total_harga) as total')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();

                $bulanIndo = [
                    1 => 'Januari', 2 => 'Februari', 3 => 'Maret',
                    4 => 'April', 5 => 'Mei', 6 => 'Juni',
                    7 => 'Juli', 8 => 'Agustus', 9 => 'September',
                    10 => 'Oktober', 11 => 'November', 12 => 'Desember',
                ];
                $labels = array_keys($bulanIndo);
                $data = $data->map(fn($item) => (object)[
                    'label' => (int) $item->label,
                    'total' => $item->total
                ]);
                $labelFormat = fn($label) => $bulanIndo[$label];
                break;

            case 'monthly':
            default:
                $rangeStart = Carbon::create($selectedYear, $selectedMonth, 1)->startOfMonth();
                $rangeEnd = Carbon::create($selectedYear, $selectedMonth, 1)->endOfMonth();
                $jumlahHari = $rangeStart->daysInMonth;
                $labels = range(1, $jumlahHari);
                $labelFormat = fn($label) => Carbon::create($selectedYear, $selectedMonth, $label)->translatedFormat('d M');

                $data = $query->whereMonth('pesanan_dibuat', $selectedMonth)
                    ->whereYear('pesanan_dibuat', $selectedYear)
                    ->selectRaw('DAY(pesanan_dibuat) as label, SUM(total_harga) as total')
                    ->groupBy('label')
                    ->orderBy('label')
                    ->get();
                break;
        }

        $dataAssoc = $data->keyBy('label');
        $dataset = [];
        foreach ($labels as $label) {
            $dataset[] = isset($dataAssoc[$label]) ? (float) $dataAssoc[$label]->total : 0;
        }

        $formattedLabels = array_map($labelFormat, $labels);
        $totalNow = array_sum($dataset);

        // Statistik tambahan
        $queryStatistik = Penjualan::whereBetween('pesanan_dibuat', [$rangeStart, $rangeEnd]);
        $transaksiAktif = $queryStatistik->count();
        $beratTotal = $queryStatistik->sum('berat');

        // Layanan terlaris
        $layananTerpopuler = Penjualan::with('layanan')
            ->whereBetween('pesanan_dibuat', [$rangeStart, $rangeEnd])
            ->select('id_layanan', DB::raw('SUM(total_harga) as total'))
            ->groupBy('id_layanan')
            ->orderByDesc('total')
            ->first();

        // $layananInfo = $layananTerpopuler ? [
        //     'nama' => $layananTerpopuler->layanan?->nama_layanan,
        //     'total' => $layananTerpopuler->total
        // ] : null;

        $layananInfo = $layananTerpopuler ? [
            'nama' => optional($layananTerpopuler->layanan)->nama_layanan,
            'total' => $layananTerpopuler->total
        ] : null;

        // Perbandingan dengan periode sebelumnya
        switch ($periode) {
            case 'daily':
                $prev = $rangeStart->copy()->subDay();
                $previousStart = $prev->copy()->startOfDay();
                $previousEnd = $prev->copy()->endOfDay();
                break;
            case 'weekly':
                $prev = $rangeStart->copy()->subWeek();
                $previousStart = $prev->copy()->startOfWeek();
                $previousEnd = $prev->copy()->endOfWeek();
                break;
            case 'yearly':
                $prev = $rangeStart->copy()->subYear();
                $previousStart = $prev->copy()->startOfYear();
                $previousEnd = $prev->copy()->endOfYear();
                break;
            case 'monthly':
            default:
                $prev = $rangeStart->copy()->subMonth();
                $previousStart = $prev->copy()->startOfMonth();
                $previousEnd = $prev->copy()->endOfMonth();
                break;
        }

        $totalPrevious = Penjualan::whereBetween('pesanan_dibuat', [$previousStart, $previousEnd])->sum('total_harga');

        $perbandingan = null;
        if ($totalPrevious > 0) {
            $selisih = $totalNow - $totalPrevious;
            $perbandingan = [
                'naik' => $selisih >= 0,
                'persentase' => round(abs($selisih / $totalPrevious) * 100, 1)
            ];
        }

        // Pie chart layanan harian
        $layananPie = null;
        if ($periode === 'daily' && $selectedDate) {
            $penjualanLayanan = Penjualan::whereDate('pesanan_dibuat', $selectedDate)
                ->with('layanan')
                ->get()
                ->groupBy('id_layanan');

            $pieLabels = [];
            $pieData = [];

            foreach ($penjualanLayanan as $layananId => $transaksis) {
                // $total = $transaksis->sum('total_harga');
                $count = $transaksis->count();
                $namaLayanan = optional($transaksis->first()->layanan)->nama_layanan ?? 'Tidak diketahui';
                $pieLabels[] = $namaLayanan;
                // $pieData[] = $total;
                $pieData[] = $count;
            }

            $layananPie = [
                'labels' => $pieLabels,
                'data' => $pieData
            ];
        }

        return response()->json([
            'labels' => $formattedLabels,
            'data' => $dataset,
            'total_pendapatan' => $totalNow,
            'total_transaksi' => $transaksiAktif,
            'berat_total' => $beratTotal,
            'layanan_terlaris' => $layananInfo,
            'perbandingan_sebelumnya' => $perbandingan,
            'layanan_pie' => $layananPie,
            'range_keterangan' => $rangeStart->translatedFormat('d M Y') . ' - ' . $rangeEnd->translatedFormat('d M Y'),
        ]);
    }
}
