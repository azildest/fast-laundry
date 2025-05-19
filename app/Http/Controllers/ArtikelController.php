<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Article;

class ArtikelController extends Controller
{
    public function index(Request $request)
    {
        $categories = Article::select('kategori')
            ->distinct()
            ->orderBy('kategori')
            ->pluck('kategori');

        $query = Article::where('status', 'publish');

        if ($request->has('query') && $request->query('query') != '') {
            $query->where('judul', 'like', '%' . $request->query('query') . '%');
        }

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $articles = $query->orderBy('tanggal_terbit', 'desc')->get();

        return view('visitor.visitorarticle', compact('articles', 'categories'));
    }
    public function show($id)
    {
        $article = Article::where('id_artikel', $id)
            ->where('status', 'publish')
            ->firstOrFail();

        return view('visitor.articledetail', compact('article'));   
    }

}
