<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;


class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        return Profile::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->validate([
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required'
        ]);
    // dd($data);
    // return Auth::user()->profiles()->create($request->all());
        return Profile::create($request->all());

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Profile::find($id);

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
        $status = Profile::find($id);
        $status->update($request->all());
        return $status;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletestatus = Profile::destroy($id);
        return $deletestatus;
    }
}
