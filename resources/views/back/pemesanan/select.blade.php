<table id="data_pesanan_table" class="table dt-responsive" style="width:100%">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pemesan</th>
            <th>Tipe Estimasi</th>
            <th>Jenis Kain</th>
            {{-- <th>Jenis Kemeja</th> --}}
            <th>Ukuran</th>
            <th>Lengan</th>
            <th>Total Biaya</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>

    <tbody>

        @php
            $increment = 1;
        @endphp

        @foreach ($pemesanan as $data)
            <tr>
                <td>{{ $increment++ }} </td>
                <td>{{ $data->user->nama }}</td>
                <td>{{ $data->tipe_estimasi == '1' ? 'Menggunakan Kain Yang Tersedia' : 'Menggunakan Kain Yang Dibawa Sendiri' }}
                </td>
                <td>{{ $data->kain->nama }}</td>
                {{-- <td>{{ $data->kemeja->nama }}</td> --}}
                <td>{{ $data->ukuran->nama }}</td>
                <td>{{ $data->lengan->nama }}</td>
                <td>{{ $data->total_biaya }}</td>
                <td>{{ $data->status }}</td>
                <td>
                    <div class="form-group">
                        <form action="{{ route('aksi.status') }}" id="formTerima" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <input type="hidden" name="status" value="diterima">
                            <button type="submit" style="width: 100%;"" class="btn btn-xs text-white btn-success"
                                id="terimaButton">Terima</button>
                        </form>
                        <form action="{{ route('aksi.status') }}" id="formTolak" method="post">
                            @csrf
                            <input type="hidden" name="id" value="{{ $data->id }}">
                            <input type="hidden" name="status" value="ditolak">
                            <button type="submit" style="width: 100%;" class="btn btn-xs text-white btn-danger"
                                id="tolakButton">Tolak</button>
                        </form>
                    </div>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
