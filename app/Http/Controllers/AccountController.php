<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use DataTables;
use App\Models\DetailRealisasi;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $account = User::all();
        $account = User::where("status","=","1")->get();
        return view('account', compact('account'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // return view('detailrealisasi.add');
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
        //     'keterangan' => 'required',
        //     'tanggal' => 'required',
        //     'jumlah' => 'required',
        //     'harga' => 'required',
        //   ]);
    
        // $post = DetailRealisasi::updateOrCreate(['id' => $request->id], [
        //         'keterangan' => $request->keterangan,
        //         'tanggal' => $request->tanggal,
        //         'jumlah' => $request->jumlah,
        //         'harga' => $request->harga,
        //         'total' => ($request->jumlah) * ($request->harga)
        //         ]);

        // return response()->json(['code'=>200, 'message'=>'Post Created successfully','data' => $post], 200);
  
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'is_admin' => 'required',
        ]);

        // $account = User::updateOrCreate(['id' => $request->id], [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'is_admin' => $request->is_admin,
        //         'password' => Hash::make($request->password),
        //         'status' => "1"
        //         ]);

        $account = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'is_admin' => $request->is_admin,
            'password' => Hash::make($request->password),
            'status' => "1"
            ]);

        if ($request->is_admin == 0) {
            $account2 = 'Super Admin';
        }else if ($request->is_admin == 1) {
            $account2 = 'Admin Kabupaten Badung';
        }else if ($request->is_admin == 2) {
            $account2 = 'Admin Kabupaten Bangli';
        }else if ($request->is_admin == 3) {
            $account2 = 'Admin Kabupaten Buleleng';
        }else if ($request->is_admin == 4) {
            $account2 = 'Admin Kabupaten Denpasar';
        }else if ($request->is_admin == 5) {
            $account2 = 'Admin Kabupaten Gianyar';
        }else if ($request->is_admin == 6) {
            $account2 = 'Admin Kabupaten Jembrana';
        }else if ($request->is_admin == 7) {
            $account2 = 'Admin Kabupaten Karangasem';
        }else if ($request->is_admin == 8) {
            $account2 = 'Admin Kabupaten Klungkung';
        }else if ($request->is_admin == 9) {
            $account2 = 'Admin Kabupaten Tabanan';
        }
        
        return response()->json(['code'=>200, 'message'=>'Account Created successfully','data' => $account, 'data2' => $account2], 200);
  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $account = User::find($id);

        return response()->json($account);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // return view('detailRealisasi.edit');
        // $account = User::find($id);
        // return response()->json($account);
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
        $account = User::find($id);
        $account->status = "0";
        $account->save();
     
        return response()->json(['success'=>'Account deleted successfully']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $account = User::find($id)->delete();
     
        return response()->json(['success'=>'Account deleted successfully']);
    }
}
