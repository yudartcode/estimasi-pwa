<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kain;
use Alert;

class KainController extends Controller
{
    public function index()
    {
        $data['kain'] = Kain::all();
        return view('back.kain.data', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'keterangan' => $request->keterangan,
            'harga_per_meter' => $request->harga_per_meter,
        ];

        $kain = Kain::create($data);

        if($request->ajax()) {
            return response()->json([
                'sukses'          => 'berhasil',
            ]);
        } else {
            return redirect()->route('kain.index');
        }
    }

    public function update($id, Request $request)
    {

        $kain = Kain::findOrFail($id);

        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $kain->nama,
            'keterangan' => $request->edit_keterangan ? $request->edit_keterangan : $kain->keterangan,
            'harga_per_meter' => $request->edit_harga_per_meter ? $request->edit_harga_per_meter : $kain->harga_per_meter,
        ];
       
        $kain->update($data);

        Alert::success('Sukses', "Kain telah berhasil di ubah!");

        return redirect()->route('kain.index');
    }

    public function destroy($id)
    {
        $kain = Kain::findOrFail($id);

        $kain->delete()
        ? Alert::success('Sukses', "Kain berhasil dihapus.")
        : Alert::error('Error', "Kain gagal dihapus!");
        
        return redirect()->back();
    }
}