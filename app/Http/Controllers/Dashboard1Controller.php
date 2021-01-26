<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Kegiatan;
use App\Models\Kehadiran;
use App\Models\Pengumuman;

class Dashboard1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    
    public function index()
    {
        
        $mytime = Carbon::now();
        
        $dateMonth = date('F Y');
        
        $kegiatanList = Kegiatan::get();
          
        return view('dashboard1', compact('dateMonth','kegiatanList'));
    }


    public function lihatBerita(){
        return view('berita.list');
    }

    public function lihatKegiatan($id){
        $mytime = Carbon::now();
        $pengumumans = Pengumuman::where('id_kegiatan',$id)->first();
     
        $kegiatans = Kegiatan::find($id);
        if(Auth::check()){
            $sudahHadir = Kehadiran::where('id_anggota', Auth::user()->id)->first();
        }else{
            $sudahHadir = 0;
        }
        
        $sudahHadirs = Kehadiran::where('id_kegiatan', $id)
        ->where('kehadiran', '1')
        ->get();
        $kehadiranSemua = $sudahHadirs->count();
        return view('kegiatan.detail',compact('kegiatans','mytime','sudahHadir','kehadiranSemua', 'pengumumans','sudahHadirs'));
    }

    public function addKehadiran(Request $request){
        // $request->validate([
        //     'jumlah_hadir' => ['required', 'string', 'max:255'],
        //     'keterangan' => ['required', 'string', 'max:255'],
        //     'kehadiran' => ['required', 'string', 'max:255'],
        //     'id_anggota' => ['required', 'string', 'max:255'],
        //     'id_kegiatan' => ['required', 'string', 'max:255'],
        // ]);

        $kehadiranNew = new Kehadiran;
        $kehadiranNew->id_kegiatan = $request->idKegiatan;
        $kehadiranNew->id_anggota = Auth::user()->id;
        $kehadiranNew->keterangan = Auth::user()->name;
        $kehadiranNew->kehadiran = '1';
        $kehadiranNew->save();

        if(!empty($request->keterangan1)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan1;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan2)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan2;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan3)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan3;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }
              
        return redirect()->back()->json(['code'=>200, 'message'=>'Kehadiran Created successfully','data' => $kehadiranNew], 200);
        
    }

    public function deleteKehadiran($id){
       
        $kehadiranDelete = Kehadiran::where('id_anggota',$id)->delete();
     
        return response()->json(['success'=>'Kehadiran deleted successfully']);
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
       

        $layanan = Kehadiran::updateOrCreate(['id' => $request->id],
        ['id_kegiatan' => $request->idKegiatan, 'id_anggota' => Auth::user()->id, 'keterangan' => Auth::user()->name, 'kehadiran' => "1"]);
        if(!empty($request->keterangan1)){
            $layanan = Kehadiran::updateOrCreate(['id' => $request->id],
            ['id_kegiatan' => $request->idkegiatan, 'id_anggota' => Auth::user()->id, 'keterangan' => $request->keterangan1, 'kehadiran' => "1"]);
        }elseif(!empty($request->keterangan2)){
            $layanan = Kehadiran::updateOrCreate(['id' => $request->id],
            ['id_kegiatan' => $request->idkegiatan, 'id_anggota' => Auth::user()->id, 'keterangan' => $request->keterangan2, 'kehadiran' => "1"]);
        }elseif(!empty($request->keterangan3)){
            $layanan = Kehadiran::updateOrCreate(['id' => $request->id],
            ['id_kegiatan' => $request->idkegiatan, 'id_anggota' => Auth::user()->id, 'keterangan' => $request->keterangan3, 'kehadiran' => "1"]);
        }
        
        
        return response()->json(['code'=>200, 'message'=>'Kehadiran Created successfully','data' => $layanan], 200);
    }

    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        
       
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
