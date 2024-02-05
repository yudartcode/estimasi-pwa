<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lengan;
use Alert;

class LenganController extends Controller
{
    public function index()
    {
        $data['lengan'] = Lengan::all();
        return view('back.lengan.data', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'meter_kain' => $request->meter_kain,
            'biaya' => $request->biaya,
        ];

        $lengan = Lengan::create($data);

        if($request->ajax()) {
            return response()->json([
                'sukses'          => 'berhasil',
            ]);
        } else {
            return redirect()->route('lengan.index');
        }
    }

    public function update($id, Request $request)
    {

        $lengan = Lengan::findOrFail($id);

        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $lengan->nama,
            'meter_kain' => $request->edit_meter_kain ? $request->edit_meter_kain : $lengan->meter_kain,
            'biaya' => $request->edit_biaya ? $request->edit_biaya : $lengan->biaya,
        ];
       
        $lengan->update($data);

        Alert::success('Sukses', "Lengan telah berhasil di ubah!");

        return redirect()->route('lengan.index');
    }

    public function destroy($id)
    {
        $lengan = Lengan::findOrFail($id);

        $lengan->delete()
        ? Alert::success('Sukses', "Lengan berhasil dihapus.")
        : Alert::error('Error', "Lengan gagal dihapus!");
        
        return redirect()->back();
    }
}