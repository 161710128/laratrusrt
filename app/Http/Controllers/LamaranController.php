<?php

namespace App\Http\Controllers;

use App\Lamaran;
use App\Lowongan;
use App\User;
use Illuminate\Http\Request;
use Session;

class LamaranController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lamaran = Lamaran::with('Lowongan','User')->get();
        return view('lamaran.index',compact('lamaran'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        return view('lamaran.create',compact('user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'file_cv' => 'required|',
            'status' => 'required|',
            'lowongan_id' => 'required|',
            'user_id' => 'required|'
        ]);
        $lamaran = new Lamaran;
        $lamaran->file_cv = $request->file_cv;
        $lamaran->status = $request->status;
        $lamaran->lowongan_id = $request->lowongan_id;
        $lamaran->user_id = $request->user_id;
        $lamaran->save();
        // attach fungsinya untuk melampirkan data,yang dilampirkan disini ialah data dari method Pesanan
        //  yang ada di model pengantin
        Session::flash("flash_notification", [
        "level"=>"success",
        "message"=>"Berhasil menyimpan <b>$lamaran->file_cv</b>"
        ]);
        return redirect()->route('lamaran.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function show(Lamaran $lamaran)
    {
        $lamaran = Lamaran::findOrFail($id);
        return view('lamaran.show',compact('lamaran'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function edit(Lamaran $lamaran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lamaran $lamaran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Lamaran  $lamaran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lamaran $lamaran)
    {
        //
    }
}
