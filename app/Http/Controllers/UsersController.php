<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Users;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index() {
        $usersData = Users::all();

        return view('users.usersview', compact('usersData'));
    }

    public function data_users(Request $request)
    {
        // $User = (object) Session::get('users');

        $filter_roles = Request('filter_roles') ?? '';

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

        $query = Users::query()
            ->orderBy('id_akun', 'desc');

        if ($filter_roles) {
            $query->where('level', $filter_roles);
        }

        return DataTables::of($query)
            ->editColumn('id_akun', function (Users $users) {
                return $users->id_akun;
            })
            ->editColumn('username', function (Users $users) {
                $limitedText = Str::limit($users->username, 30, '...');
                $withLineBreaks = preg_replace('/(.{1,40})(\s|$)/u', '$1<br>', $limitedText);
                return nl2br($withLineBreaks);
            })
            ->editColumn('email', function (Users $users) {
                return $users->email;
            })
            ->editColumn('no_telp', function (Users $users) {
                return $users->no_telp;
            })
            ->addColumn('level', function (Users $users) {
                $roles = '';

                if ($users->level == "1") {
                    $roles = '<span class="badge bg-success">Operator</span>';
                } else if ($users->level == "2") {
                    $roles = '<span class="badge bg-primary">Owner</span>';
                }

                return '<div class="text-center">' . $roles . '</div>';
            })
            ->editColumn('action', function (Users $users) {
                // $editUrl = route('users.edit', $users->id_akun);
                $deleteUrl = route('users.delete', $users->id_akun);
                $csrfToken = csrf_token();

                $deleteButton = '<a href="' . $deleteUrl . '" class="btn btn-sm btn-danger delete-btn" data-id="' . $users->id_akun . '">
                                    <i class="fas fa-trash-alt"></i>
                                </a>';

                return '<div class="text-center">' . $deleteButton . '</div>';
            })
            ->rawColumns(['username', 'level', 'action'])
            ->toJson();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'level' => 'required|in:1,2',
            'email' => 'required|email|unique:akun,email',
            'username' => 'required|unique:akun,username',
            'password' => 'required|min:6|confirmed',
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
    
        Users::create([
            'level' => $request->level,
            'email' => $request->email,
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'no_telp' => $request->no_telp,
        ]);

        return response()->json([
            'success' => 'User has been added successfully!',
            'message' => 'User added successfully!' // You can also send a generic message
        ], 200);

        // return redirect()->route('users.list')->with('success', 'User has been added.');
    }

    public function edit($id_akun)
    {
        $users = Users::findOrFail($id_akun);
        return response()->json($users);
    }

    public function update(Request $request, $id_akun)
    {
        $users = Users::findOrFail($id_akun);

        $dataToUpdate = $request->all();

        // if ($request->input('status') === 'selesai' && $users->pesanan_selesai === null) {
        //     $dataToUpdate['pesanan_selesai'] = Carbon::now();
        // }

        $users->update($dataToUpdate);

        return response()->json(['success' => 'Record has been updated successfully!']);
    }

    public function delete($id_akun)
    {
        try {
            $users = Users::findOrFail($id_akun);
            $users->delete();
            return response()->json(['success' => 'User has been deleted successfully!']);
        } catch (\Exception $e) {
            Log::error('Error deleting users record: ' . $e->getMessage(), ['id_akun' => $id_akun]);
            return response()->json(['error' => 'Failed to delete user.', 'message' => $e->getMessage()], 500);
        }
    }
}
