<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
// use Shapefile\Shapefile;
use Shapefile\ShapefileException;
use Shapefile\ShapefileReader;

class ShpController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            // Open Shapefile
            $Shapefile = new ShapefileReader(public_path('file/kawasan_aceh/Kawasan_Strategis_Aceh'));


            // Read all the records
            while ($Geometry = $Shapefile->fetchRecord()) {
                // Skip the record if marked as "deleted"
                if ($Geometry->isDeleted()) {
                    continue;
                }

                // Print Geometry as an Array
                //dump($Geometry->getArray());

                // Print Geometry as WKT
                //dump($Geometry->getWKT());



                // Print DBF data
                $dbf[] = ($Geometry->getDataArray());


                // Print Geometry as GeoJSON
                $shp[] = ($Geometry->getGeoJSON());
            }

            foreach ($dbf as $key => $value) {
                $dbf[$key]['KOORDINAT'] = $shp[$key];
            }

            return view('contents.shp', compact('dbf'));
        } catch (ShapefileException $e) {
            // Print detailed error information
            echo "Error Type: " . $e->getErrorType()
                . "\nMessage: " . $e->getMessage()
                . "\nDetails: " . $e->getDetails();
        }
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
