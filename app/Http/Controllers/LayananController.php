<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Layanan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Symfony\Component\HttpFoundation\Session\Session;

class LayananController extends Controller
{
    public function index() {
        $layananData = Layanan::all();

        return view('penjualan.serviceview', compact('layananData'));
    }


    public function data_layanan(Request $request)
    {
        // $User = (object) Session::get('users');

        $query = Layanan::query()
            ->orderBy('created_at', 'desc');

        return DataTables::of($query)
            ->editColumn('id_layanan', function (Layanan $layanan) {
                return $layanan->id_layanan;
            })
            ->editColumn('nama_layanan', function (Layanan $layanan) {
                return $layanan->nama_layanan;
            })
            ->editColumn('harga_per_kg', function (Layanan $layanan) {
                return $layanan->harga_per_kg;
            })
            ->editColumn('deskripsi', function (Layanan $layanan) {
                $limitedText = Str::limit($layanan->deskripsi, 100, '...');
                $withLineBreaks = preg_replace('/(.{1,40})(\s|$)/u', '$1<br>', $limitedText);
                return nl2br($withLineBreaks);
            })
            ->editColumn('action', function (Layanan $layanan) {
                $editUrl = route('services.edit', $layanan->id_layanan);
                // $deleteUrl = route('services.delete', $layanan->id_layanan);
                $csrfToken = csrf_token();

                $editButton = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning edit-btn" data-id="' . $layanan->id_layanan . '">
                        <i class="fas fa-pencil-alt"></i>
                    </a>';
                // $deleteButton = '<form id="delete-form-' . $layanan->id_layanan . '" action="' . $deleteUrl . '" method="post" style="display:inline;">
                //                     <input type="hidden" name="_token" value="' . $csrfToken . '">
                //                     <input type="hidden" name="_method" value="delete">
                //                     <button type="button" onclick="deleteFile(' . $layanan->id_layanan . ')" class="btn btn-sm btn-danger">
                //                         <i class="fas fa-trash-alt"></i>
                //                     </button>
                //                 </form>';

                return $editButton;
                // . ' ' . $deleteButton;
            })
            ->rawColumns(['deskripsi', 'action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        Layanan::create($request->all());
        return redirect()->route('services.records')->with('success', 'Service has been added.');
    }

    public function edit($id_layanan)
    {
        $layanan = Layanan::findOrFail($id_layanan);
        return response()->json($layanan);
    }

    public function update(Request $request, $id_layanan)
    {
        $layanan = Layanan::findOrFail($id_layanan);

        $dataToUpdate = $request->all();

        $layanan->update($dataToUpdate);

        return response()->json(['success' => 'Service has been updated successfully!']);
    }

    public function delete($id_layanan)
    {
        $layanan = Layanan::findOrFail($id_layanan);
        $layanan->delete();
        return redirect()->route('services.records')->with('success', 'Service has been deleted.');
    }
}
