<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kegiatan;
use App\Models\Kehadiran;
use App\Models\Pengumuman;
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
        ['acara' => $request->acara, 'tempat' => $request->tempat, 'tanggal' => $request->tanggal, 'jammulai' => $request->jammulai, 'jamselesai' => $request->jamselesai]);
        
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
        $pengumumans = Pengumuman::where('id_kegiatan',$id)->first();
        return view("kegiatan.detailAdmin",compact("kegiatans","kehadirans",'pengumumans','kehadiranSemua'));
    }
    public function showEdit($id){
        $kegiatan = Kegiatan::find($id);

        return response()->json($kegiatan);
    }

    public function storePengumuman(Request $request){
        $current_timestamp = Carbon::now()->timestamp;
        
        $gmbr1 = $request->file('gambar1');
        $name1=$gmbr1->getClientOriginalName();
        
        $path1 = 'assets3/img/fotoPengumuman/'. $name1;
        if(File::exists($path1)) {
            $name1 = $current_timestamp.$gmbr1->getClientOriginalName();
            $path1 = 'assets3/img/fotoPengumuman/'. $name1;
        }
        // $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
        $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
        
        $gmbr2 = $request->file('gambar2');
        $name2=$gmbr2->getClientOriginalName();
        $path2 = 'assets3/img/fotoPengumuman/'. $name2;
        if(File::exists($path2)) {
            $name2 = $current_timestamp.$gmbr2->getClientOriginalName();
            $path2 = 'assets3/img/fotoPengumuman/'. $name2;
        }
        $gmbr2->move(public_path().'/assets3/img/fotoPengumuman/', $name2);

        $gmbr3 = $request->file('gambar3');
        $name3=$gmbr3->getClientOriginalName();
        $path3 = 'assets3/img/fotoPengumuman/'. $name3;
        if(File::exists($path3)) {
            $name3 = $current_timestamp.$gmbr3->getClientOriginalName();
            $path3 = 'assets3/img/fotoPengumuman/'. $name3;
        }
        $gmbr3->move(public_path().'/assets3/img/fotoPengumuman/', $name3);

        $dwnld = $request->file('download');
        $name4=$dwnld->getClientOriginalName();
        $path4 = 'assets3/dokumenPengumuman/'. $name4;
        if(File::exists($path4)) {
            $name4 = $current_timestamp.$dwnld->getClientOriginalName();
            $path4 = 'assets3/dokumenPengumuman/'. $name4;
        }
        $dwnld->move(public_path().'/assets3/dokumenPengumuman/', $name4);


        $pengumumans = new Pengumuman;
        $pengumumans->id_kegiatan=$request->id_kegiatan;     
        $pengumumans->isi = $request->isi;
        $pengumumans->gambar1=$path1;         
        $pengumumans->gambar2=$path2;  
        $pengumumans->gambar3=$path3;  
        $pengumumans->download=$path4;   
        $pengumumans->save();

        $kegiatan = Kegiatan::get();
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
}
