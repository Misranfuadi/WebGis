<?php

namespace App\Http\Controllers;

use App\Models\Alias;
use App\Models\Datashp;
use App\Models\Rencana;
use Illuminate\Http\Request;
use App\Models\Shp;
use Validator;
use Illuminate\Support\Facades\DB;

class ShpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if (request()->ajax()) {
            return datatables()->of(Shp::orderBy('created_at', 'desc')->get())
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

        $listAlias  = Alias::select('id', 'alias', 'nama_field')->orderBy('alias', 'asc')->get();
        $listRencana  = Rencana::select('id', 'title')->orderBy('title', 'asc')->get();

        return view('contents.shp', compact('listAlias', 'listRencana'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Shp $shp, Datashp $datashp)
    {
        //
        $rules = array(
            'nama_peta'       => 'required|max:200|unique:shps,peta',
            'keluaran'            => 'required|max:200',
            'sumber_dokumen'            => 'required|max:200',
            'jenis_rencana'            => 'required',
            'jenis_data'            => 'required|in:polygon,line,point',
            'nama_field'            => 'required',
            'file_shp'            => 'required|mimes:zip,rar',
        );

        $error = Validator::make($request->all(), $rules);

        if ($error->fails()) {
            return response()->json(['errors' => $error->errors()]);
        }

        $year = date('Y');
        $month = date('m');
        $data = $this->getYears($year, $month);
        $max_protocol = $data['max_id'];

        if ($max_protocol && !empty($max_protocol) && $max_protocol != NULL) {
            $data = (int) $max_protocol + 1;
            $nomor = str_pad($data, 4, '0', STR_PAD_LEFT);
        } else {
            $data = 1;
            $nomor =  str_pad($data, 4, '0', STR_PAD_LEFT);
        }

        $noRegis = $year . $month . $nomor;


        $shp->register = $noRegis;
        $shp->peta = $request->nama_peta;
        $shp->keluaran = $request->keluaran;
        $shp->id_rencana = $request->jenis_rencana;
        $shp->sumber_dokumen = $request->sumber_dokumen;
        $shp->peta = $request->nama_peta;
        $shp->peta = $request->nama_peta;
        $shp->created_by = Auth::user()->id;
        $shp->updated_by = Auth::user()->id;

        $shp->save();






        $uploadFile = $request->file('file_shp');

        $file = $uploadFile->store('public/fileShp');





        return response()->json($file);
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

    public function getYears($year, $month)
    {
        $data = Shp::select(DB::raw('count(id) as max_id'))
            ->whereYear('created_at', $year)
            ->whereMonth('created_at', $month)
            ->get();

        if ($data->count() > 0) {
            return  $data->first();
        }
        return FALSE;
    }
}
