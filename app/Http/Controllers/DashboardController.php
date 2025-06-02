<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Faq;

class DashboardController extends Controller
{
    public function index()
    {
        $todaySalesCount = Penjualan::whereDate('pesanan_dibuat', Carbon::today())->count();
        $todayIncome = Penjualan::whereDate('pesanan_dibuat', Carbon::today())->sum('total_harga');
        $articlesNeedingApproval = Article::where('status', 'pending')->count();
        $faqsNeedApproval = Faq::where('status', 'in_progress')->count();

        return view('dashboard.dashboard', compact(
            'todaySalesCount',
            'todayIncome',
            'articlesNeedingApproval',
            'faqsNeedApproval'
        ));
    }
}
