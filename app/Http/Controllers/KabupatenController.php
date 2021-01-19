<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kabupaten;

class KabupatenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kabupaten = Kabupaten::where('status','1')->get();
        return view("kabupaten.index",compact("kabupaten"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_kabupaten' => ['required', 'string', 'max:255'],
        ]);


        $kabupaten = Kabupaten::updateOrCreate(['id' => $request->id],
        ['nama_kabupaten' => $request->nama_kabupaten, 'status' => "1"]);
        
        return response()->json(['code'=>200, 'message'=>'Kabupaten Created successfully','data' => $kabupaten], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kabupaten = Kabupaten::find($id);

        return response()->json($kabupaten);
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
        $kabupaten = Kabupaten::find($id);
        $kabupaten->status = "0";
        $kabupaten->save();
     
        return response()->json(['success'=>'Kabupaten deleted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kabupaten = Kabupaten::find($id);
        $kabupaten->status = "0";
        $kabupaten->save();
     
        return response()->json(['success'=>'Kabupaten deleted successfully']);
        // $kabupaten = Kabupaten::find($id)->delete();
     
        // return response()->json(['success'=>'Kabupaten deleted successfully']);
    }
}
