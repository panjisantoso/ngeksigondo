<?php

namespace App\Http\Controllers;

use App\Models\JenisLayanan;
use Illuminate\Http\Request;

class JenisLayananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $layanan = JenisLayanan::where('status','=','1')->get();

        return view('berita.index', compact('layanan'));
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
        $request->validate([
            'nama_layanan' => ['required', 'string', 'max:255'],
        ]);

        // $layanan = JenisLayanan::create([
        //     'nama_layanan' => $request->nama_layanan,
        //     'status' => "1"
        //     ]);

        $layanan = JenisLayanan::updateOrCreate(['id' => $request->layanan_id],
        ['nama_layanan' => $request->nama_layanan, 'status' => "1"]);
        
        return response()->json(['code'=>200, 'message'=>'Service Created successfully','data' => $layanan], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $layanan = JenisLayanan::find($id);

        return response()->json($layanan);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JenisLayanan  $jenisLayanan
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
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        $layanan = JenisLayanan::find($id);
        $layanan->status = "0";
        $layanan->save();
     
        return response()->json(['success'=>'Layanan deleted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JenisLayanan  $jenisLayanan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // $layanan = JenisLayanan::find($id)->delete();
     
        // return response()->json(['success'=>'Layanan deleted successfully']);
    }
}
