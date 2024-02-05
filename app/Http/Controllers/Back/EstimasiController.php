<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Estimasi;
use Alert;


class EstimasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['pemesanan'] = Estimasi::all();
        return view('back.pemesanan.data', $data);
    }

    public function select(Request $request)
    {   
        if ($request->status == "semua") {
            $data['pemesanan'] = Estimasi::all();
            return view('back.pemesanan.select', $data);
        }
        $data['pemesanan'] = Estimasi::where('status', $request->status)->get();
        return view('back.pemesanan.select', $data);
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
    
    public function terima_tolak(Request $request)
    {
        $data = Estimasi::findOrFail($request->id);
        $data->update(['status' => $request->status]);

        Alert::success('Sukses', "Pemesanan telah berhasil di ubah!");

        return redirect()->route('estimasi.index');
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