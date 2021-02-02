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
        $pengumuman = Pengumuman::where('status','1')->get();
        return view("pengumuman.index",compact("pengumuman"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengumuman.add');
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
        $current_timestamp = Carbon::now()->timestamp;

        
        $pengumumans = new Pengumuman;
        $pengumumans->tgl_tayang = $request->tgl_tayang;
        $pengumumans->tgl_akhir = $request->tgl_akhir;
        $pengumumans->isi = $request->isi;
        if($request->hasfile('gambar1'))
        {
            $gmbr1 = $request->file('gambar1');
            $name1=$gmbr1->getClientOriginalName();
            $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            if(File::exists($path1)) {
                $name1 = $current_timestamp.$gmbr1->getClientOriginalName();
                $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            }
            // $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $pengumumans->gambar1 = $path1;
        }

        if($request->hasfile('gambar2'))
        {
            $gmbr2 = $request->file('gambar2');
            $name2=$gmbr2->getClientOriginalName();
            $path2 = 'assets3/img/fotoPengumuman/'. $name2;
            if(File::exists($path2)) {
                $name2 = $current_timestamp.$gmbr2->getClientOriginalName();
                $path2 = 'assets3/img/fotoPengumuman/'. $name2;
            }
            $gmbr2->move(public_path().'/assets3/img/fotoPengumuman/', $name2);
            $pengumumans->gambar2 = $path2;
        }

        if($request->hasfile('gambar3'))
        {
            $gmbr3 = $request->file('gambar3');
            $name3=$gmbr3->getClientOriginalName();
            $path3 = 'assets3/img/fotoPengumuman/'. $name3;
            if(File::exists($path3)) {
                $name3 = $current_timestamp.$gmbr3->getClientOriginalName();
                $path3 = 'assets3/img/fotoPengumuman/'. $name3;
            }
            $gmbr3->move(public_path().'/assets3/img/fotoPengumuman/', $name3);
            $pengumumans->gambar3 = $path3;
        }

        if($request->hasfile('download'))
        {
            $dwnld = $request->file('download');
            $name4=$dwnld->getClientOriginalName();
            $path4 = 'assets3/dokumenPengumuman/'. $name4;
            if(File::exists($path4)) {
                $name4 = $current_timestamp.$dwnld->getClientOriginalName();
                $path4 = 'assets3/dokumenPengumuman/'. $name4;
            }
            $dwnld->move(public_path().'/assets3/dokumenPengumuman/', $name4);
            $pengumumans->download = $path4;
        }
        $pengumumans->status = '1';
        $pengumumans->save();
        // $pengumumans = Pengumuman::updateOrCreate(['id' => $request->id],
        // ['tgl_tayang' => $request->tgl_tayang, 'tgl_akhir' => $request->tgl_akhir, 'isi' => $request->isi,
        // 'gambar1' => $path1, 'gambar2' => $path2, 'gambar3' => $path3,
        // 'download' => $path4, 'status' => '1'],);
        if(Auth::user()->is_admin == 1){
            return redirect('/admin/pengumuman');
        }

        elseif(Auth::user()->is_admin == 2){
            return redirect('/pengumuman');
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
        $pengumumans = Pengumuman::find($id);
        return view('pengumuman.edit',compact('pengumumans'));
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

        $pengumumans = Pengumuman::find($id);
        $pengumumans->tgl_tayang = $request->tgl_tayang;
        $pengumumans->tgl_akhir = $request->tgl_akhir;
        $pengumumans->isi = $request->isi;
        if($request->hasfile('gambar1'))
        {
            $gmbr1 = $request->file('gambar1');
            $name1=$gmbr1->getClientOriginalName();
            $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            if(File::exists($path1)) {
                $name1 = $current_timestamp.$gmbr1->getClientOriginalName();
                $path1 = 'assets3/img/fotoPengumuman/'. $name1;
            }
            // $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $gmbr1->move(public_path().'/assets3/img/fotoPengumuman/', $name1);
            $pengumumans->gambar1 = $path1;
        }

        if($request->hasfile('gambar2'))
        {
            $gmbr2 = $request->file('gambar2');
            $name2=$gmbr2->getClientOriginalName();
            $path2 = 'assets3/img/fotoPengumuman/'. $name2;
            if(File::exists($path2)) {
                $name2 = $current_timestamp.$gmbr2->getClientOriginalName();
                $path2 = 'assets3/img/fotoPengumuman/'. $name2;
            }
            $gmbr2->move(public_path().'/assets3/img/fotoPengumuman/', $name2);
            $pengumumans->gambar2 = $path2;
        }

        if($request->hasfile('gambar3'))
        {
            $gmbr3 = $request->file('gambar3');
            $name3=$gmbr3->getClientOriginalName();
            $path3 = 'assets3/img/fotoPengumuman/'. $name3;
            if(File::exists($path3)) {
                $name3 = $current_timestamp.$gmbr3->getClientOriginalName();
                $path3 = 'assets3/img/fotoPengumuman/'. $name3;
            }
            $gmbr3->move(public_path().'/assets3/img/fotoPengumuman/', $name3);
            $pengumumans->gambar3 = $path3;
        }

        if($request->hasfile('download'))
        {
            $dwnld = $request->file('download');
            $name4=$dwnld->getClientOriginalName();
            $path4 = 'assets3/dokumenPengumuman/'. $name4;
            if(File::exists($path4)) {
                $name4 = $current_timestamp.$dwnld->getClientOriginalName();
                $path4 = 'assets3/dokumenPengumuman/'. $name4;
            }
            $dwnld->move(public_path().'/assets3/dokumenPengumuman/', $name4);
            $pengumumans->download = $path4;
        }
        $pengumumans->status = '1';
        $pengumumans->save();
        // $pengumumans = Pengumuman::updateOrCreate(['id' => $request->id],
        // ['tgl_tayang' => $request->tgl_tayang, 'tgl_akhir' => $request->tgl_akhir, 'isi' => $request->isi,
        // 'gambar1' => $path1, 'gambar2' => $path2, 'gambar3' => $path3,
        // 'download' => $path4, 'status' => '1'],);
        
        if(Auth::user()->is_admin == 1){
            return redirect('/admin/pengumuman');
        }

        elseif(Auth::user()->is_admin == 2){
            return redirect('/pengumuman');
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
        $pengumumans = Pengumuman::find($id);
        $pengumumans->status = '0';
        $pengumumans->save();

        
        return response()->json(['success'=>'Kabupaten deleted successfully']);
    }
}
