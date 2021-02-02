<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $anggota = User::where('status','1')->get();
        return view("anggota.index",compact("anggota"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('anggota.add');
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
        //     'nik' => ['required', 'string', 'max:30', 'unique:users'],
        //     'name' => ['required', 'string', 'max:100'],
        //     'tempat_lahir' => ['required', 'string', 'max:100'],
        //     'tgl_lahir' => ['required', 'date'],
        //     'jenis_kelamin' => 'required',
        //     'no_hp' => ['required', 'int'],
        //     'password' => ['required', 'string', 'max:100'],
        // ]);
        // $anggota = User::updateOrCreate();
        // $anggota->id = $request->id;
        // $anggota->nik = $request->nik; 
        // $anggota->name = $request->name; 
        // $anggota->tempat_lahir = $request->tempat_lahir; 
        // $anggota->tgl_lahir = $request->tgl_lahir; 
        // $anggota->jenis_kelamin = $request->jenis_kelamin;
        // $anggota->no_hp = $request->no_hp; 
        // $anggota->password = Hash::make($request->password);
        // $anggota->status = "1";
        // $anggota->is_admin = $request->is_admin;
        // $anggota->save();
        
            $anggota = User::updateOrCreate(['id' => $request->id],
                [
                    'nik' => $request->nik, 
                    'name' => $request->name, 
                    'tempat_lahir' => $request->tempat_lahir, 
                    'tgl_lahir' => $request->tgl_lahir, 
                    'jenis_kelamin' => $request->jenis_kelamin, 
                    'no_hp' => $request->no_hp, 
                    'is_admin' => $request->is_admin,
                    'password' => Hash::make($request->password),
                    'status' => '1',
                    'email' => $request->email
                ]
            );
       
        return redirect('/admin/anggota');
    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $anggota = User::find($id);

        return response()->json($anggota);
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
    public function pengurusSet(Request $request, $id)
    {
        $anggota = User::find($id);
        $anggota->is_admin = "2";
        $anggota->save();
     
        return redirect('/admin/anggota');
    }
    
    public function anggotaSet(Request $request, $id)
    {
        $anggota = User::find($id);
        $anggota->is_admin = "0";
        $anggota->save();
     
        return redirect('/admin/anggota');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anggota = User::find($id);
        $anggota->status = "0";
        $anggota->save();
     
        return response()->json(['success'=>'anggota deleted successfully']);
    }
}
