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

       $allArticles = $query->orderBy('tanggal_terbit', 'desc')->get();

        $highlight = $allArticles->first(); // Ambil artikel terbaru untuk highlight
        $articles = $allArticles->slice(1); // Sisanya untuk grid

        return view('visitor.visitorarticle', compact('highlight', 'articles', 'categories'));
    }
    public function show($id)
    {
        $article = Article::where('id_artikel', $id)
            ->where('status', 'publish')
            ->firstOrFail();

        return view('visitor.articledetail', compact('article'));   
    }

    public function kelola()
{
    $artikels = Article::orderBy('created_at', 'desc')->get();
    return view('artikel.artikel', compact('artikels'));
}

public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'isi' => 'required|string',
        'gambar' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
      
    ]);

    $artikel = new Article();
    $artikel->judul = $request->judul;
    $artikel->kategori = $request->kategori;
    $artikel->isi = $request->isi;
    $artikel->status = 'draft'; // default
    $artikel->tanggal_terbit = now();

    // Jika ada upload gambar, simpan file
   if ($request->hasFile('gambar')) {
    $file = $request->file('gambar');
    $filename = $file->store('artikel', 'public');
    $artikel->gambar = $filename;
}


    $artikel->save();

    return redirect()->route('admin.artikel.kelola')->with('success', 'Artikel berhasil ditambahkan');
}

public function update(Request $request, $id)
{
    $artikel = Article::findOrFail($id);

    $request->validate([
        'judul' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'isi' => 'required|string',
        'gambar' => 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
       
    ]);

    $artikel->judul = $request->judul;
    $artikel->kategori = $request->kategori;
    $artikel->isi = $request->isi;
      $artikel->status = 'draft'; // default
    $artikel->tanggal_terbit = now();
    
 if ($request->hasFile('gambar')) {
    $file = $request->file('gambar');
    $filename = $file->store('artikel', 'public');
    $artikel->gambar = $filename;
}


    $artikel->save();

    return redirect()->route('admin.artikel.kelola')->with('success', 'Artikel berhasil diperbarui');
}

public function showVerifikasi($id)
{
    $artikel = Article::findOrFail($id);
    return view('admin.artikel.verifikasi', compact('artikel'));
}

public function approve($id)
{
    $artikel = Article::findOrFail($id);
    $artikel->status = 'publish'; // Gunakan 'publish' agar tampil di website
    $artikel->tanggal_terbit = now(); // Update tanggal
    $artikel->save();

    return redirect()->route('admin.artikel.publikasi')->with('success', 'Artikel berhasil dipublikasikan.');
}

public function block($id)
{
    $artikel = Article::findOrFail($id);
    $artikel->status = 'blocked';
    $artikel->save();

    return redirect()->route('admin.artikel.publikasi')->with('danger', 'Artikel berhasil diblokir.');
}


public function publikasi()
{
    $artikels = Article::whereIn('status', ['draft', 'blocked', 'publish'])->orderBy('created_at', 'desc')->get();
    return view('artikel.publikasi', compact('artikels'));
}



}
