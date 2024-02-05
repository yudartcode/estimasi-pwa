<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ukuran;
use Alert;

class UkuranController extends Controller
{
    public function index()
    {
        $data['ukuran'] = Ukuran::all();
        return view('back.ukuran.data', $data);
    }

    public function store(Request $request)
    {
        $data = [
            'nama' => $request->nama,
            'meter_kain' => $request->meter_kain,
            'biaya' => $request->biaya,
        ];

        $ukuran = Ukuran::create($data);

        if($request->ajax()) {
            return response()->json([
                'sukses'          => 'berhasil',
            ]);
        } else {
            return redirect()->route('ukuran.index');
        }
    }

    public function update($id, Request $request)
    {

        $ukuran = Ukuran::findOrFail($id);

        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $ukuran->nama,
            'meter_kain' => $request->edit_meter_kain ? $request->edit_meter_kain : $ukuran->meter_kain,
            'biaya' => $request->edit_biaya ? $request->edit_biaya : $ukuran->biaya,
        ];
       
        $ukuran->update($data);

        Alert::success('Sukses', "Ukuran telah berhasil di ubah!");

        return redirect()->route('ukuran.index');
    }

    public function destroy($id)
    {
        $ukuran = Ukuran::findOrFail($id);

        $ukuran->delete()
        ? Alert::success('Sukses', "Ukuran berhasil dihapus.")
        : Alert::error('Error', "Ukuran gagal dihapus!");
        
        return redirect()->back();
    }
}