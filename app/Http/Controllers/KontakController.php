<?php
namespace App\Http\Controllers;

use App\Models\Kontak;
use Illuminate\Http\Request;

class KontakController extends Controller
{
   public function index() {
    $kontak = \App\Models\Kontak::first();

    if (!$kontak) {
        // Buat satu data kosong dulu (default)
        $kontak = \App\Models\Kontak::create([
            'address' => '',
            'phone' => '',
            'email' => '',
            'maps_embed' => '',
        ]);
    }

    return redirect()->route('kontak.edit', $kontak->id);
}

    public function edit($id) {
        $kontak = Kontak::findOrFail($id);
        return view('kontak.edit', compact('kontak'));
    }

    public function update(Request $request, $id) {
        $request->validate([
            'address' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'maps_embed' => 'nullable|string',
        ]);

        $kontak = Kontak::findOrFail($id);
        $kontak->update($request->all());

        return redirect()->route('kontak.index')->with('success', 'Informasi kontak diperbarui.');
    }
}
