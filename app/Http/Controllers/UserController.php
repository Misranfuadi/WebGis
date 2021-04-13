<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Validator;

class UserController extends Controller
{
    /**
     * Class constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            return datatables()->of(User::orderBy('created_at', 'desc')->get())
                ->addIndexColumn()
                ->addColumn('verify', function ($data) {

                    if ($data->email_verified_at == null) {
                        return '<span class="right badge badge-danger">unverified</span>';
                    } else {
                        return ' <span class="right badge badge-success">Verified</span>';
                    }
                })
                ->addColumn('status', function ($data) {

                    if ($data->status == 0) {
                        return '<span class="right badge badge-warning">unaproval </span>';
                    } elseif ($data->status == 1) {
                        return ' <span class="right badge badge-success">aproval</span>';
                    } else {
                        return ' <span class="right badge badge-danger">Blocked</span>';
                    }
                })
                ->addColumn('created_at', function ($data) {
                    return date('d-m-Y', strtotime($data->created_at));
                })
                ->addColumn('aksi', function ($data) {
                    $dataId = Crypt::encryptString($data->id);
                    return  '<button type="button" name="edit" id="' . $dataId . '" class="edit btn btn-warning btn-xs  mr-2">Edit</button>' .
                        '<button type="button" name="delete" id="' . $dataId . '" token="' . csrf_token() . '" class="delete btn btn-danger btn-xs ">Hapus</button>';
                })->rawColumns(['aksi', 'status', 'verify'])->make(true);
        }

        return view('contents.user');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, User $user)
    {
        //
        $rules = array(
            'nama'     =>  'required|max:100|unique:haktanahs,nama',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()]);
        }

        $user->nama = $request->nama;

        $user->save();
        return response()->json(['success' => 'Data Added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
