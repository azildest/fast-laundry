<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Faq;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('created_at', 'desc')->get();
        return view('faq.allfaq', compact('faqs'));
    }

  public function store(Request $request)
{
    $request->validate([
        'pertanyaan' => 'required|string|max:255',
        'jawaban' => 'required|string',
    ]);

    \App\Models\Faq::create([
        'pertanyaan' => $request->pertanyaan,
        'jawaban' => $request->jawaban,
    ]);

    return redirect()->route('allfaq')->with('success', 'FAQ berhasil ditambahkan.');
}

// Edit
public function edit($id)
{
    $faq = Faq::findOrFail($id);
    return view('faq.edit', compact('faq'));
}

// Update
public function update(Request $request, $id)
{
    $request->validate([
        'pertanyaan' => 'required|string|max:255',
        'jawaban' => 'required|string',
    ]);

    $faq = Faq::findOrFail($id);
   $faq->update([
    'pertanyaan' => $request->pertanyaan,
    'jawaban' => $request->jawaban,
    'status' => 'in_progress', // Tambahkan baris ini
]);


    return redirect()->route('faq.index')->with('success', 'FAQ berhasil diperbarui.');
}
public function destroy($id)
{
    

    $faq = Faq::findOrFail($id);
    $faq->delete();
    
    return redirect()->route('allfaq')->with('success', 'FAQ berhasil dihapus.');
}


public function approvalIndex()
{
$faqs = Faq::orderByRaw("FIELD(status, 'in_progress', 'approved', 'blocked')")
           ->orderBy('created_at', 'desc')
           ->get();

    return view('faq.ownerfaq', compact('faqs'));
}

public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:approved,blocked',
    ]);

    $faq = Faq::findOrFail($id);
    $faq->status = $request->status;
    $faq->save();

    return redirect()->back()->with('success', 'Status FAQ berhasil diperbarui.');
}


}
