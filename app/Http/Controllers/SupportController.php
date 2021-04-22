<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Validator;
use App\Models\Alias;
use App\Models\Rencana;


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

    public function alias()
    {
        if (request()->ajax()) {
            return datatables()->of(Alias::orderBy('created_at', 'desc')->get())
                ->addIndexColumn()
                ->addColumn('created_by', function ($data) {
                    return $data->createdBy->name;
                })
                ->addColumn('aksi', function ($data) {
                    $dataId = Crypt::encryptString($data->id);

                    return  '<button type="button" name="edit_alias" id="' . $dataId . '" class="edit_alias btn btn-warning btn-xs  mr-2">Edit</button>' .
                        '<button type="button" name="delete" id="' . $dataId . '" token="' . csrf_token() . '" class="delete_alias btn btn-danger btn-xs ">Hapus</button>';
                })->rawColumns(['aksi'])->make(true);
        }
    }

    public function rencana()
    {
        if (request()->ajax()) {
            return datatables()->of(Rencana::orderBy('created_at', 'desc')->get())
                ->addIndexColumn()
                ->addColumn('created_by', function ($data) {
                    return $data->createdBy->name;
                })
                ->addColumn('aksi', function ($data) {
                    $dataId = Crypt::encryptString($data->id);

                    return  '<button type="button" name="edit" id="' . $dataId . '" class="edit_rencana btn btn-warning btn-xs  mr-2">Edit</button>' .
                        '<button type="button" name="delete" id="' . $dataId . '" token="' . csrf_token() . '" class="delete_rencana btn btn-danger btn-xs ">Hapus</button>';
                })->rawColumns(['aksi'])->make(true);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function storeAlias(Request $request, Alias $alias)
    {
        //
        $rules = array(
            'nama_field'       => 'required|max:200|unique:aliases,nama_field',
            'alias'            => 'required|max:200',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()]);
        }

        $alias->nama_field = $request->nama_field;
        $alias->alias = $request->alias;
        $alias->created_by = Auth::user()->id;
        $alias->updated_by = Auth::user()->id;

        $alias->save();
        return response()->json(['success' => 'Data Added successfully.']);
    }


    public function storeRencana(Request $request, Rencana $rencana)
    {
        //
        $rules = array(
            'nama_rencana'       => 'required|max:200|unique:rencanas,title',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()]);
        }

        $rencana->title = $request->nama_rencana;
        $rencana->created_by = Auth::user()->id;
        $rencana->updated_by = Auth::user()->id;
        $rencana->save();
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
    public function editAlias($id)
    {
        //
        try {
            $dataId = Crypt::decryptString($id);
            if (request()->ajax()) {
                $data = Alias::findOrFail($dataId)->makeHidden('id');
                return response()->json($data);
            }
        } catch (DecryptException $e) {
            return response()->json(['errors' => 'Oops! somthing wrong']);
        }
    }

    public function editRencana($id)
    {
        //
        try {
            $dataId = Crypt::decryptString($id);
            if (request()->ajax()) {
                $data = Rencana::findOrFail($dataId)->makeHidden('id');
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
    public function updateAlias(Request $request, Alias $alias)
    {
        try {
            $dataId = Crypt::decryptString($request->input('id'));


            $rules = array(

                'nama_field'       => 'required|max:200|unique:aliases,nama_field,' . $dataId,
                'alias'            => 'required|max:200',

            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()]);
            }
            $formData = array(
                'nama_field'        =>  $request->nama_field,
                'alias'             =>  $request->alias,
            );

            $alias->whereId($dataId)->update($formData);

            return response()->json(['success' => 'Data is successfully updated']);
        } catch (DecryptException $e) {
            return response()->json(['errors' => 'Oops! somthing wrong']);
        }
    }

    public function updateRencana(Request $request, Rencana $rencana)
    {
        try {
            $dataId = Crypt::decryptString($request->input('id'));


            $rules = array(

                'nama_rencana'       => 'required|max:200|unique:rencanas,title,' . $dataId

            );
            $error = Validator::make($request->all(), $rules);
            if ($error->fails()) {
                return response()->json(['errors' => $error->errors()]);
            }
            $formData = array(
                'title'        =>  $request->nama_rencana,
            );

            $rencana->whereId($dataId)->update($formData);

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
    public function destroyAlias($id)
    {
        //
        try {
            $dataId = Crypt::decryptString($id);
            $data = Alias::findOrFail($dataId);
            $data->delete();
            return response()->json(['success' => 'Data is successfully deleted']);
        } catch (DecryptException $e) {
            return response()->json(['errors' => 'Oops! somthing wrong']);
        }
    }

    public function destroyRencana($id)
    {
        //
        try {
            $dataId = Crypt::decryptString($id);
            $data = Rencana::findOrFail($dataId);
            $data->delete();
            return response()->json(['success' => 'Data is successfully deleted']);
        } catch (DecryptException $e) {
            return response()->json(['errors' => 'Oops! somthing wrong']);
        }
    }
}
