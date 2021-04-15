<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Validator;


class SupportController extends Controller
{
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
        return view('contents.supportData');
    }

    public function rencana()
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
                        return '<span class="right badge badge-warning">Unapproval </span>';
                    } elseif ($data->status == 1) {
                        return ' <span class="right badge badge-success">Approval</span>';
                    } else {
                        return ' <span class="right badge badge-danger">Blocked</span>';
                    }
                })
                ->addColumn('aksi', function ($data) {
                    $dataId = Crypt::encryptString($data->id);
                    if (Auth::user()->id == $data->id) {
                        return  '<button type="button" name="edit" id="' . $dataId . '" class="edit btn btn-warning btn-xs  mr-2">Edit</button>' .
                            '<button type="button" disabled  class="delete btn btn-danger btn-xs">Hapus</button>';
                    } else {
                        return  '<button type="button" name="edit" id="' . $dataId . '" class="edit btn btn-warning btn-xs  mr-2">Edit</button>' .
                            '<button type="button" name="delete" id="' . $dataId . '" token="' . csrf_token() . '" class="delete btn btn-danger btn-xs ">Hapus</button>';
                    }
                })->rawColumns(['aksi', 'status', 'verify'])->make(true);
        }
    }

    public function alias()
    {
        return view('contents.supportData');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
