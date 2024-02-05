<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Kemeja;
use Alert;

class KemejaController extends Controller
{
    public function index()
    {
        $data['kemeja'] = Kemeja::all();
        return view('back.kemeja.data', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'jenis' => $request->jenis,
            'biaya' => $request->biaya,
        ];

        $kemeja = Kemeja::create($data);

        if($request->ajax()) {
            return response()->json([
                'sukses'          => 'berhasil',
            ]);
        } else {
            return redirect()->route('kemeja.index');
        }
    }

    public function update($id, Request $request)
    {

        $kemeja = Kemeja::findOrFail($id);

        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $kemeja->nama,
            'jenis' => $request->edit_jenis ? $request->edit_jenis : $kemeja->jenis,
            'biaya' => $request->edit_biaya ? $request->edit_biaya : $kemeja->biaya,
        ];
       
        $kemeja->update($data);

        Alert::success('Sukses', "Kemeja telah berhasil di ubah!");

        return redirect()->route('kemeja.index');
    }

    public function destroy($id)
    {
        $kemeja = Kemeja::findOrFail($id);

        $kemeja->delete()
        ? Alert::success('Sukses', "Kemeja berhasil dihapus.")
        : Alert::error('Error', "Kemeja gagal dihapus!");
        
        return redirect()->back();
    }
}