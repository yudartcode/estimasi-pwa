<?php

namespace App\Http\Controllers\back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portpolio;
use App\Models\Kemeja;
use App\Models\Kain;
use App\Models\Lengan;
use App\Models\Ukuran;
use Alert;

class PortpolioController extends Controller
{
    public function index()
    {
        $data['portpolio'] = Portpolio::all();
        $data['kemeja'] = Kemeja::all();
        $data['kain'] = Kain::all();
        $data['lengan'] = Lengan::all();
        $data['ukuran'] = Ukuran::all();
        return view('back.portpolio.data', $data);
    }

    public function store(Request $request)
    {
        $portpolio = new Portpolio;

        $portpolio->nama = $request->nama;
        $portpolio->jenis = $request->jenis;
        $portpolio->bahan = $request->bahan;
        $portpolio->lengan = $request->lengan;
        $portpolio->biaya = $request->biaya;
        $portpolio->save();
        
        if ($request->file('foto')) {
            $nama_foto = time()."_".$request->nama.".jpg";
            $tujuan_upload = 'foto_portpolio';
            $request->file('foto')->move($tujuan_upload,$nama_foto);
            $portpolio->foto = $nama_foto;
            $portpolio->save();
        };
        
        if($request->ajax()) {
            return response()->json([
                'sukses'          => 'berhasil',
            ]);
        } else {
            return redirect()->route('portpolio.index');
        }
    }

    public function update($id, Request $request)
    {

        $portpolio = Portpolio::findOrFail($id);

        $data = [
            'nama' => $request->edit_nama ? $request->edit_nama : $portpolio->nama,
            'jenis' => $request->edit_jenis ? $request->edit_jenis : $portpolio->jenis,
            'bahan' => $request->edit_bahan ? $request->edit_bahan : $portpolio->bahan,
            'lengan' => $request->edit_lengan ? $request->edit_lengan : $portpolio->lengan,
            'biaya' => $request->edit_biaya ? $request->edit_biaya : $portpolio->biaya,
            'foto' => $request->edit_foto ? $request->edit_foto : $portpolio->foto,
        ];
       
        $portpolio->update($data);

        Alert::success('Sukses', "Portpolio telah berhasil di ubah!");

        return redirect()->route('portpolio.index');
    }

    public function destroy($id)
    {
        $portpolio = Portpolio::findOrFail($id);

        $portpolio->delete()
        ? Alert::success('Sukses', "Portpolio berhasil dihapus.")
        : Alert::error('Error', "Portpolio gagal dihapus!");
        
        return redirect()->back();
    }
}