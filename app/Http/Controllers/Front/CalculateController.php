<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Portpolio;
use App\Models\Kemeja;
use App\Models\Kain;
use App\Models\Lengan;
use App\Models\Ukuran;
use App\Models\Estimasi;
use DB;

class CalculateController extends Controller
{
    public function index()
    {
        $data['portpolio'] = Portpolio::all();
        $data['kemeja'] = Kemeja::all();
        $data['kain'] = Kain::all();
        $data['lengan'] = Lengan::all();
        $data['ukuran'] = Ukuran::all();
        return view('front.calculate', $data);
    }
    
    public function calculate_result(Request $request)
    {
        $tipe = $request->tipe;
        $kain = Kain::where('id', $request->bahan)->first();
        $kemeja = Kemeja::where('id', $request->jenis)->first();
        $lengan = Lengan::where('id', $request->lengan)->first();
        $ukuran = Ukuran::where('id', $request->ukuran)->first();
        
        $portpolio = Portpolio::where('bahan', 'like', '%' . $kain->nama . '%')
            ->where('lengan', 'like', '%' . $lengan->nama . '%')
            ->first();

        $totalKain = $lengan->meter_kain + $ukuran->meter_kain;
        $totalBiaya = $kemeja->biaya + $lengan->biaya + $ukuran->biaya + ($tipe == "1" ? ($totalKain * $kain->harga_per_meter) : 0);
        // perhitungan $totalBiaya : untuk tipe estimasi 1 (kain yg tersedia) => ditambah dengan mengalikan total panjang kain dengan harga kain per meter, 
        // sedankan untuk tipe estimasi 2 (kain yg dibawa sendiri) => hanya menghitung total biaya dari kemeja, lengan dan ukuran.

        $data['tipe'] = $tipe;
        $data['kain'] = $kain->nama;
        $data['kemeja'] = $kemeja->nama;
        $data['lengan'] = $lengan->nama;
        $data['ukuran'] = $ukuran->nama;
        $data['estimasi_kain'] = $totalKain;
        $data['estimasi_biaya'] = $totalBiaya;
        $data['portpolio'] = $portpolio;
        
        $data['kain_id'] = $kain->id;
        $data['kemeja_id'] = $kemeja->id;
        $data['lengan_id'] = $lengan->id;
        $data['ukuran_id'] = $ukuran->id;

        return view('front.result', $data);
    }

    public function simpan(Request $request)
    {
        $data = [
            'tipe_estimasi' => $request->tipe,
            'kain_id' => $request->kain_id,
            'kemeja_id' => $request->kemeja_id,
            'ukuran_id' => $request->ukuran_id,
            'lengan_id' => $request->lengan_id,
            'total_meter_kain' => $request->total_meter_kain,
            'total_biaya' => $request->total_biaya,
            'user_id' => $request->user_id,
            'status' => "diproses"
        ];
        $estimasi = Estimasi::create($data);
        
        $kain = Kain::where('id', $estimasi->kain_id)->first();
        $kemeja = Kemeja::where('id', $estimasi->kemeja_id)->first();
        $lengan = Lengan::where('id', $estimasi->lengan_id)->first();
        $ukuran = Ukuran::where('id', $estimasi->ukuran_id)->first();
        
        $data['tipe_estimasi'] = $estimasi->tipe_estimasi;
        $data['kain_id'] = $kain->nama;
        $data['kemeja_id'] = $kemeja->nama;
        $data['ukuran_id'] = $ukuran->nama;
        $data['lengan_id'] = $lengan->nama;
        $data['total_meter_kain'] = $estimasi->total_meter_kain;
        $data['total_biaya'] = $estimasi->total_biaya;
        $data['user_id'] = $estimasi->user_id;
        $data['status'] = $estimasi->status;
        
        return view('front.status', $data);
    }

    public function history($id)
    {
        $data['history'] = Estimasi::where('user_id', $id)->get();
        return view('front.history', $data);
    }

}