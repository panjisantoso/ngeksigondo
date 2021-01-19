<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        
        return view("profil");
    }

    public function updateProfile(Request $request, $id)
    {
        $profile = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $emailRequest = $request->email;
        $allEmail = User::select('id','email')->get();

        $count = 0;

        foreach($allEmail as $all){
            if ($emailRequest == $all->email) {
                $userid = $all->id;
                $count = +1;
            }
        }

        if ($count == 1 && $userid == $id) {
            $profile = User::find($id);

            $profile->name = $request->name; 
            $profile->email = $request->email;

            $profile->save();

            return redirect()->back()->with('successprofile','Updated successfully');
        }elseif ($count == 1 && $userid != $id) {
            return redirect()->back()->with('emailtaken','Email is already taken');
        }else {
            $profile = User::find($id);

            $profile->name = $request->name; 
            $profile->email = $request->email;

            $profile->save();

            return redirect()->back()->with('successprofile','Updated successfully');
        }
        // $userEmail = User::where('email', $emailRequest)->first();
        // $checkEmail = User
        // $countEmail = $userEmail->count();

        // if ($userEmail->id) {
        //     # code...
        // }else if(condition) {

        // }else{

        // }

        
        // return $userid;
        // return redirect()->route('profile')->with('successprofile','Updated successfully');
    }

    public function updatePassword(Request $request, $id)
    {
        $profile = $request->validate([
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $profile = User::find($id);

        $profile->password = Hash::make($request->password); 

        $profile->save();
        
        return redirect()->route('profile')->with('successpassword','Updated successfully');
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
        //
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
