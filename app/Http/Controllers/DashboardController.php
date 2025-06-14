<?php

namespace App\Http\Controllers;

use App\Models\Penjualan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Faq;
// use App\Http\Controllers\DashboardController;

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

// namespace App\Http\Controllers;

// use App\Http\Controllers\Controller;
// use Illuminate\Http\Request;
// use App\Models\Article;
// use App\Models\Faq;

// class DashboardController extends Controller
// {

// public function index()
// {
//   $pendingCount = Article::where('status', 'draft')->count();
//     $publishedCount = Article::where('status', 'publish')->count(); // atau 'publish' jika Anda pakai status itu
//     $faqPendingCount = Faq::where('status', 'in_progress')->count();

//     return view('dashboard.dashboard', compact('pendingCount', 'publishedCount', 'faqPendingCount'));
// }

// public function dashboard()
// {
//     $pendingCount = Article::where('status', 'draft')->count(); // sesuaikan dengan data yang ada
//     $publishedCount = Article::where('status', 'publish')->count(); // sesuaikan juga
//      $faqPendingCount = Faq::where('status', 'in_progress')->count();

//     return view('dashboard.dashboard', compact('pendingCount', 'publishedCount', 'faqPendingCount'));
// }

//  public function home()
//     {
//         $latestArticles = Article::where('status', 'publish')
//                             ->orderBy('tanggal_terbit', 'desc')
//                             ->take(3)
//                             ->get();

//         return view('visitor.visitordashboard', compact('latestArticles'));
//     }
// }
