<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pengumuman;
use Carbon\Carbon;
use File;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pengumuman = Pengumuman::get();
        return view("pengumuman.index",compact("pengumuman"));
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
        $pengumumans->gambar3=$path3;  
        $pengumumans->download=$path4;

        $pengumumans = Pengumuman::updateOrCreate(['id' => $request->id],
        ['tgl_tayang' => $request->tgl_tayang, 'tgl_selesai' => $request->tgl_selesai, 'isi' => $request->isi,
        'gambar1' => $path1, 'gambar2' => $path2, 'gambar3' => $path3,
        'download' => $path4, 'status' => '1'],);
        
        return response()->json(['code'=>200, 'message'=>'Pengumuman Created successfully','data' => $pengumumans], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pengumuman = Pengumuman::find($id);

        return response()->json($pengumuman);
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
        $pengumumans = Pengumuman::find($id);
        $pengumumans->status = '0';
        $pengumumans->save();

        
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
        $pengumumans = Pengumuman::find($id);
        
        $pengumumans->delete();

        
        return response()->json(['success'=>'Kabupaten deleted successfully']);
    }
}
