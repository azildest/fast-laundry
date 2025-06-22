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

          // Ambil artikel highlight yang ditandai
          $highlight = Article::where('is_highlight', true)
                ->where('status', 'publish')
                ->first();
       $articles = $query
                ->where('is_highlight', false)
                ->orderBy('tanggal_terbit', 'desc')
                ->get();
        return view('visitor.visitorarticle', compact('highlight', 'articles', 'categories'));
    }
    public function show($id)
    {
        $article = Article::where('id_artikel', $id)
            ->where('status', 'publish')
            ->firstOrFail();
        
        $highlight = Article::where('is_highlight', true)
                ->where('status', 'publish')
                ->first();

        return view('visitor.articledetail', compact('article', 'highlight'));   
    }

  public function kelola()
{
    $artikels = Article::orderBy('created_at', 'desc')->get();
    $highlightExists = Article::where('is_highlight', true)->exists(); // cek apakah sudah ada artikel highlight

    return view('artikel.artikel', compact('artikels', 'highlightExists'));
}


public function store(Request $request)
{
    $request->validate([
        'judul' => 'required|string|max:255',
        'kategori' => 'required|string|max:100',
        'isi' => 'required|string',
        'gambar' => $request->isMethod('post') ? 'required|image|mimes:jpeg,png,jpg,pdf,docx|max:2048' : 'nullable|file|mimes:jpg,jpeg,png,pdf,docx|max:2048',
      
    ]);

    $artikel = new Article();
    $artikel->judul = $request->judul;
    $artikel->kategori = $request->kategori;
    $artikel->isi = $request->isi;
    $artikel->status = 'draft'; // default
    $artikel->tanggal_terbit = now();
    
  if ($request->has('is_highlight')) {
    // Hapus highlight dari artikel lain
    Article::where('is_highlight', true)->update(['is_highlight' => false]);
    $artikel->is_highlight = true;
} else {
    $artikel->is_highlight = false;
}


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
    if ($request->has('is_highlight')) {
    // Reset semua highlight
    Article::where('is_highlight', true)->update(['is_highlight' => false]);
    $artikel->is_highlight = true;
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

public function destroy($id)
{
    $artikel = Article::findOrFail($id);
    $artikel->delete();

    return redirect()->route('admin.artikel.kelola')->with('success', 'Artikel berhasil dihapus.');
}


}
