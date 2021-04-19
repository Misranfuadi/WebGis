<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
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
            'nip'       => 'required|digits:18|unique:users,nip',
            'nama'      => 'required|max:100',
            'email'     => 'required|email|max:255|unique:users,email',
            'role'      =>  'required|in:approver,master,staff',
            'status'      =>  'required|in:0,1,2',
            'password'  => 'required|min:8|confirmed',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()]);
        }

        $user->name = $request->nama;
        $user->nip = $request->nip;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->status = $request->status;
        $user->password = $request->password;

        $user->save();
        return response()->json(['success' => 'Data Added successfully.']);
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
        try {
            $dataId = Crypt::decryptString($id);
            if (request()->ajax()) {
                $data = User::findOrFail($dataId)->makeHidden('id');
                return response()->json($data);
            }
        } catch (DecryptException $e) {
            return response()->json(['errors' => 'Oops! somthing wrong']);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
        try {
            $dataId = Crypt::decryptString($request->input('id'));

            $password = $request->input('password');
            if ($password != '') {
                $rules = array(
                    'nip'        =>  'required|digits:18|unique:users,nip,' . $dataId,
                    'nama'       =>  'required|max:100',
                    'role'      =>  'required|in:approver,master,staff',
                    'status'      =>  'required|in:0,1,2',
                    'email'      =>  'required|email|max:255|unique:users,email,' . $dataId,
                    'password'   =>  'required|min:4|max:100|confirmed',
                );
                $error = Validator::make($request->all(), $rules);
                if ($error->fails()) {
                    return response()->json(['errors' => $error->errors()]);
                }
                $formData = array(
                    'nip'            =>  $request->nip,
                    'name'           =>  $request->nama,
                    'email'          =>  $request->email,
                    'role'          =>  $request->role,
                    'status'          =>  $request->status,
                    'password'       =>  bcrypt($request->password),
                );
            } else {
                $rules = array(
                    'nip'        =>  'required|digits:18|unique:users,nip,' . $dataId,
                    'nama'       =>  'required|max:100',
                    'email'      =>  'required|email|max:255|unique:users,email,' . $dataId,
                    'role'      =>  'required|in:approver,master,staff',
                    'status'      =>  'required|in:0,1,2',
                );

                $error = Validator::make($request->all(), $rules);

                if ($error->fails()) {
                    return response()->json(['errors' => $error->errors()]);
                }
                $formData = array(
                    'nip'           =>  $request->nip,
                    'name'          =>  $request->nama,
                    'email'         =>  $request->email,
                    'role'          =>  $request->role,
                    'status'          =>  $request->status,
                );
            }

            $user->whereId($dataId)->update($formData);

            return response()->json(['success' => 'Data is successfully updated']);
        } catch (DecryptException $e) {
            return response()->json(['errors' => 'Oops! somthing wrong']);
        }
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
        try {
            $dataId = Crypt::decryptString($id);
            $data = User::findOrFail($dataId);
            $data->delete();
            return response()->json(['success' => 'Data is successfully deleted']);
        } catch (DecryptException $e) {
            return response()->json(['errors' => 'Oops! somthing wrong']);
        }
    }
}
