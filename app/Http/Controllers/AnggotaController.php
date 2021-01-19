<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

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
        $request->validate([
            'nik' => ['required', 'string', 'max:30', 'unique:users'],
            'name' => ['required', 'string', 'max:100'],
            'tempat_lahir' => ['required', 'string', 'max:100'],
            'tgl_lahir' => ['required', 'date'],
            'jenis_kelamin' => 'required',
            'no_hp' => ['required', 'int'],
            'password' => ['required', 'string', 'max:100'],
        ]);
            

        $anggota = User::updateOrCreate(['id' => $request->id],
            [
                'nik' => $request->nik, 
                'name' => $request->name, 
                'tempat_lahir' => $request->tempat_lahir, 
                'tgl_lahir' => $request->tgl_lahir, 
                'jenis_kelamin' => $request->jenis_kelamin, 
                'no_hp' => $request->no_hp, 
                'password' => Hash::make($request->password), 
                'status' => "1",
                'is_admin' => "0"
            ]
        );
        
        return response()->json(['code'=>200, 'message'=>'Anggota Created successfully','data' => $anggota], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
    }
}
