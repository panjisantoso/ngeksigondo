<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;
use App\Models\Kegiatan;
use App\Models\Kehadiran;
use App\Models\Pengumuman;
use App\Models\GambarKegiatan;
use App\Models\DokumenKegiatan;
use App\Models\Berita;
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
        $tglSkrng = $mytime->toDateTimeString();
        $dateMonth = date('F Y');
        
        $kegiatanList = Kegiatan::get();
        $beritaList = Berita::get();
        $pengumumanList = Pengumuman::get();
        $gambarKegiatan = GambarKegiatan::get();
        return view('dashboard1', compact('dateMonth','kegiatanList','tglSkrng','gambarKegiatan','pengumumanList','beritaList'));
    }


    public function lihatBerita($id){
        $mytime = Carbon::now();
        $tglSkrng = $mytime->toDateTimeString();
        $beritas = Berita::find($id);
        return view('berita.detail',compact('beritas','tglSkrng','mytime'));
    }

    public function lihatPengumuman($id){
        $mytime = Carbon::now();
        $tglSkrng = $mytime->toDateTimeString();
        $pengumumans = Pengumuman::find($id);
        return view('pengumuman.detail',compact('pengumumans','tglSkrng','mytime'));
    }

    public function lihatKegiatan($id){
        $mytime = Carbon::now();
        $tglSkrng = $mytime->toDateTimeString();
        $gambarKegiatan = GambarKegiatan::where('id_kegiatan',$id)->get();
        $dokumenKegiatan = DokumenKegiatan::where('id_kegiatan',$id)->first();
        $kegiatans = Kegiatan::find($id);
        if(Auth::check()){
            $sudahHadir = Kehadiran::where('id_anggota', Auth::user()->id)
                        ->where('id_kegiatan',$id)
                        ->first();
        }else{
            $sudahHadir = 0;
        }
        
        $sudahHadirs = Kehadiran::where('id_kegiatan', $id)
        ->where('kehadiran', '1')
        ->get();
        $kehadiranSemua = $sudahHadirs->count();
        return view('kegiatan.detail',compact('kegiatans','mytime','sudahHadir','kehadiranSemua', 'gambarKegiatan','sudahHadirs',
                    'dokumenKegiatan', 'tglSkrng'));
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
        }if(!empty($request->keterangan4)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan4;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan5)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan5;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan6)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan6;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan7)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan7;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan8)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan8;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan9)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan9;
            $kehadiranNew->kehadiran = '1';
            $kehadiranNew->save();
        }if(!empty($request->keterangan10)){
            $kehadiranNew = new Kehadiran;
            $kehadiranNew->id_kegiatan = $request->idKegiatan;
            $kehadiranNew->id_anggota = Auth::user()->id;
            $kehadiranNew->keterangan = $request->keterangan10;
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
