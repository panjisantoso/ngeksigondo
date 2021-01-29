<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Kehadiran;
use App\Models\Pengumuman;
use App\Models\GambarKegiatan;
use App\Models\DokumenKegiatan;
use Carbon\Carbon;
use File;

class KegiatanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kegiatan = Kegiatan::get();
        
        return view("kegiatan.index",compact("kegiatan"));
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
        // $request->validate([
        //     'nama_kabupaten' => ['required', 'string', 'max:255'],
        // ]);


        $kegiatan = Kegiatan::updateOrCreate(['id' => $request->id],
        ['acara' => $request->acara, 'tempat' => $request->tempat, 'alamat' => $request->alamat, 'link_gmaps' => $request->link_gmaps, 'tanggal' => $request->tanggal, 'jammulai' => $request->jammulai, 'jamselesai' => $request->jamselesai]);
        
        return response()->json(['code'=>200, 'message'=>'Kabupaten Created successfully','data' => $kegiatan], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    
    public function show($id)
    {
        $sudahHadirs = Kehadiran::where('id_kegiatan', $id)
                        ->where('kehadiran', '1')
                        ->get();
        $kehadiranSemua = $sudahHadirs->count();
        $kegiatans = Kegiatan::find($id);
        $kehadirans = Kehadiran::where('id_kegiatan',$id)->get();
        $gambarKegiatan = GambarKegiatan::where('id_kegiatan',$id)->get();
        $dokumenKegiatan = DokumenKegiatan::where('id_kegiatan',$id)->first();
        if(!isset($gambarKegiatan) && !isset($dokumenKegiatan)){
            $checkKegiatan = 1;
        }else{
            $checkKegiatan = 0;
        }
        return view("kegiatan.detailAdmin",compact("kegiatans","kehadirans",'gambarKegiatan','dokumenKegiatan','kehadiranSemua',
                    'checkKegiatan'));
    }
    public function showEdit($id){
        $kegiatan = Kegiatan::find($id);

        return response()->json($kegiatan);
    }

    public function storePengumuman(Request $request){
                
        if($request->hasfile('gambar'))
        {
            $current_timestamp = Carbon::now()->timestamp;
            $i = 1;
            foreach($request->file('gambar') as $file)
            {
                
                    $name=$file->getClientOriginalName();
                    $path = 'assets3/img/fotoPengumuman/'. $name;
                    if(File::exists($path)) {
                        $name = $current_timestamp.$file->getClientOriginalName();
                        $path = 'assets3/img/fotoPengumuman/'. $name;
                    }
                    
                    $file->move(public_path().'/assets3/img/fotoPengumuman/', $name);

                    $gambarKegiatan = new GambarKegiatan;
                    $gambarKegiatan->id_kegiatan = $request->id_kegiatan;
                    $gambarKegiatan->gambar=$path;
                    $gambarKegiatan->save();
                $i++;    
            }
            
        }
        if($request->hasfile('dokumen')){
            $current_timestamp = Carbon::now()->timestamp;
            $fileD = $request->file('dokumen');
            $nameD=$fileD->getClientOriginalName();
            $pathD = 'assets3/dokumenKegiatan/'. $nameD;
            if(File::exists($pathD)) {
                $nameD = $current_timestamp.$fileD->getClientOriginalName();
                $pathD = 'assets3/dokumenKegiatan/'. $nameD;
            }
            
            $fileD->move(public_path().'/assets3/dokumenKegiatan/', $nameD);

            $dokumenKegiatan = new DokumenKegiatan;
            $dokumenKegiatan->id_kegiatan=$request->id_kegiatan;     
            $dokumenKegiatan->dokumen = $pathD;
            $dokumenKegiatan->save();
                   
            
        }
        

        
        return redirect()->back();
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

     public function updateKehadiran(Request $request, $id){
        $kehadiranUpdate = Kehadiran::find($id);
        $kehadiranUpdate->kehadiran = $request->kehadiran;
        $kehadiranUpdate->save();

        $kegiatan = Kegiatan::get();
        return redirect()->back();
     }

    public function destroy($id)
    {
        $pengumumanDelete = Pengumuman::where('id_kegiatan',$id)->delete();
        $kegiatan = Kegiatan::get();
        return redirect()->back();
    }
    public function destroyGambarKegiatan($id)
    {
        $gambarDelete = GambarKegiatan::find($id);
        $gambarDelete->delete();
        return redirect()->back();
    }

    public function gantiDokumen(Request $request, $id){
        if($request->hasfile('dokumen')){
            $current_timestamp = Carbon::now()->timestamp;
            
            $fileD = $request->file('dokumen');
            $nameD=$fileD->getClientOriginalName();
            $pathD = 'assets3/dokumenKegiatan/'. $nameD;
            if(File::exists($pathD)) {
                $nameD = $current_timestamp.$fileD->getClientOriginalName();
                $pathD = 'assets3/dokumenKegiatan/'. $nameD;
            }
            
            $fileD->move(public_path().'/assets3/dokumenKegiatan/', $nameD);

            $dokumenKegiatan = DokumenKegiatan::find($id);
            $dokumenKegiatan->id_kegiatan=$request->id_kegiatan;     
            $dokumenKegiatan->dokumen = $pathD;
            $dokumenKegiatan->save();
                   
            
        }
        return redirect()->back();
     }
}
