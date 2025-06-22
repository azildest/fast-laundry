<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Layanan;
use App\Models\Penjualan;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Session\Session;

class PenjualanController extends Controller
{
    public function index() {
        $penjualanData = Penjualan::all();
        $layananData = Layanan::all();

        return view('penjualan.salesview', compact('penjualanData', 'layananData'));
    }


    public function data_penjualan(Request $request)
    {
        // $User = (object) Session::get('users');

        $filter_status = Request('filter_status') ?? '';
        $filter_layanan = Request('filter_layanan') ?? '';

        $today = Carbon::today();
        $dateBetween = [];
        $filterTgl = false;

        if ($request->input('filter_tanggal')) {
            $filter_tanggal = explode(" - ", $request->input('filter_tanggal'));

            foreach ($filter_tanggal as $date) {
                $formattedDate = date_create($date);
                if ($formattedDate) {
                    $dateBetween[] = date_format($formattedDate, 'Y-m-d H:i:s');
                }
            }

            if (count($dateBetween) === 2) {
                $filterTgl = true;
            }
        } else {
            $dateBetween = [
                '1900-01-01 00:00:00',
                Carbon::today()->endOfDay()->format('Y-m-d H:i:s'),
            ];
        }

        $query = Penjualan::query()
            ->orderByRaw("CASE WHEN status = 'belum selesai' THEN 0 ELSE 1 END")
            ->orderBy('id_penjualan', 'desc');

        if ($filterTgl) {
            $query->whereBetween('pesanan_dibuat', [$dateBetween[0], $dateBetween[1]]);
        }

        if ($filter_status) {
            $query->where('status', $filter_status);
        }

        if ($filter_layanan) {
            $query->where('id_layanan', $filter_layanan);
        }

        return DataTables::of($query)
            ->editColumn('id_penjualan', function (Penjualan $penjualan) {
                return $penjualan->id_penjualan;
            })
            ->editColumn('nama_customer', function (Penjualan $penjualan) {
                $limitedText = Str::limit($penjualan->nama_customer, 30, '...');
                $withLineBreaks = preg_replace('/(.{1,40})(\s|$)/u', '$1<br>', $limitedText);
                return nl2br($withLineBreaks);
            })
            ->addColumn('layanan', function (Penjualan $penjualan) {
                return $penjualan->layanan->nama_layanan ?? 'N/A';
            })
            // ->editColumn('id_layanan', function (Penjualan $penjualan) {
            //     return $penjualan->id_layanan;
            // })
            ->editColumn('berat', function (Penjualan $penjualan) {
                return $penjualan->berat;
            })
            ->editColumn('total_harga', function (Penjualan $penjualan) {
                return $penjualan->total_harga;
            })
            ->editColumn('whatsapp', function (Penjualan $penjualan) {
                return $penjualan->whatsapp;
            })
            ->editColumn('status', function (Penjualan $penjualan) {
                if ($penjualan->status == "selesai") {
                    $status = '<span class="badge bg-success">Selesai</span>';
                } else if ($penjualan->status == "belum selesai") {
                    $status = '<span class="badge bg-secondary">Belum Selesai</span>';
                }
                return $status;
            })
            ->editColumn('pesanan_dibuat', function (Penjualan $penjualan) {
                return $penjualan->pesanan_dibuat ? $penjualan->pesanan_dibuat->format('Y-m-d, H:i:s') : '-';
            })
            ->editColumn('pesanan_selesai', function (Penjualan $penjualan) {
                return $penjualan->pesanan_selesai
                    ? Carbon::parse($penjualan->pesanan_selesai)->format('Y-m-d, H:i:s') : '-';
            })
            ->editColumn('action', function (Penjualan $penjualan) {
                $editUrl = route('sales.edit', $penjualan->id_penjualan);
                $deleteUrl = route('sales.delete', $penjualan->id_penjualan);
                $csrfToken = csrf_token();

                $editButton = '<a href="' . $editUrl . '" class="btn btn-sm btn-warning edit-btn" data-id="' . $penjualan->id_penjualan . '">
                        <i class="fas fa-pencil-alt"></i>
                    </a>';
                $deleteButton = '<form id="delete-form-' . $penjualan->id_penjualan . '" action="' . $deleteUrl . '" method="post" style="display:inline;">
                                    <input type="hidden" name="_token" value="' . $csrfToken . '">
                                    <input type="hidden" name="_method" value="delete">
                                    <button type="button" class="btn btn-sm btn-danger delete-btn" data-id="' . $penjualan->id_penjualan . '">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>';

                return $editButton . ' ' . $deleteButton;
            })
            ->rawColumns(['nama_customer', 'status', 'total_harga', 'action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        Penjualan::create($request->all());
        return redirect()->route('sales.records')->with('success', 'Record has been added.');
    }

    public function edit($id_penjualan)
    {
        $penjualan = Penjualan::findOrFail($id_penjualan);
        return response()->json($penjualan);
        // return redirect()->route('sales.records')->with('success', 'Record has been updated.');
    }

    public function update(Request $request, $id_penjualan)
    {
        $penjualan = Penjualan::findOrFail($id_penjualan);

        $dataToUpdate = $request->all();

        if ($request->input('status') === 'selesai' && $penjualan->pesanan_selesai === null) {
            $dataToUpdate['pesanan_selesai'] = Carbon::now();
        }

        $penjualan->update($dataToUpdate);

        // return response()->json(['success' => 'Record has been updated successfully!']);
        return redirect()->route('sales.records')->with('success', 'Record has been updated.');
    }

    public function delete($id_penjualan)
    {
        try {
            $penjualan = Penjualan::findOrFail($id_penjualan);
            $penjualan->delete();
            return response()->json(['success' => 'Record has been deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting sales record: ' . $e->getMessage(), ['id_penjualan' => $id_penjualan]);
            return response()->json(['error' => 'Failed to delete record.', 'message' => $e->getMessage()], 500);
        }
        return redirect()->route('sales.records')->with('success', 'Record has been deleted.');
    }
}
