<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Berita;
use Auth;
use Carbon\Carbon;
use File;
class BeritaController extends Controller

{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $berita = Berita::where('status','1')->get();
        return view("berita.index",compact("berita"));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("berita.add");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $current_timestamp = Carbon::now()->timestamp;

        
        $beritas = new Berita;
        $beritas->isi_berita = $request->isi_berita;
        $beritas->judul_berita = $request->judul_berita;
        $beritas->tanggal_berita = $request->tanggal_berita;
        if($request->hasfile('gambar'))
        {
            $gmbr1 = $request->file('gambar');
            $name1=$gmbr1->getClientOriginalName();
            $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            if(File::exists($path1)) {
                $name1 = $current_timestamp.$gmbr1->getClientOriginalName();
                $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            }
            // $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $beritas->gambar = $path1;
        }
        $beritas->id_user = Auth::user()->id;
        $beritas->status = '1';
        $beritas->save();

        if(Auth::user()->is_admin == 1){
            return redirect('/admin/berita');
        }

        elseif(Auth::user()->is_admin == 2){
            return redirect('/berita');
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $beritas = Berita::find($id);

        return response()->json($beritas);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $berita = Berita::find($id);
        return view("berita.edit",compact("berita"));
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
        $current_timestamp = Carbon::now()->timestamp;

        
        $beritas = Berita::find($id);
        $beritas->isi_berita = $request->isi_berita;
        $beritas->judul_berita = $request->judul_berita;
        $beritas->tanggal_berita = $request->tanggal_berita;
        if($request->hasfile('gambar'))
        {
            $gmbr1 = $request->file('gambar');
            $name1=$gmbr1->getClientOriginalName();
            $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            if(File::exists($path1)) {
                $name1 = $current_timestamp.$gmbr1->getClientOriginalName();
                $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            }
            // $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $beritas->gambar = $path1;
        }
        $beritas->id_user = Auth::user()->id;
        $beritas->status = '1';
        $beritas->save();

        if(Auth::user()->is_admin == 1){
            return redirect('/admin/berita');
        }

        elseif(Auth::user()->is_admin == 2){
            return redirect('/berita');
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
        $berita = Berita::find($id);
        $berita->status = "0";
        $berita->save();
     
        return response()->json(['success'=>'berita deleted successfully']);
    }
}
