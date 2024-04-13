@extends('layouts.template')

@section('content')
    <div class="grid-container">
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $pageBarang->title }}</h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-striped table-hover table-sm" id="tableBarang">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Barang</th>
                            <th>Harga Barang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($barang as $index => $item)
                            <tr>
                                <td>{{ $item->barang_id }}</td>
                                <td>{{ $item->barang_nama }}</td>
                                <td>{{ $item->harga_jual }}</td>
                                <td>
                                    <button class="btn btn-primary tambah-barang" data-barang-id="{{ $item->barang_id }}"
                                        data-barang-nama="{{ $item->barang_nama }}"
                                        data-harga-jual="{{ $item->harga_jual }}" data-jumlah="1">Tambah</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card card-outline card-primary">
            <div class="card-header">
                <h3 class="card-title">{{ $page->title }}</h3>
                <div class="card-tools"></div>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ url('penjualan') }}" class="form-horizontal">
                    @csrf
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Pengguna</label>
                        <div class="col-10">
                            <select class="form-control" id="user_id" name="user_id" required>
                                <option value="">- Pilih Pengguna -</option>
                                @foreach ($user as $item)
                                    <option value="{{ $item->user_id }}">{{ $item->nama }}</option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Kode Penjualan</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="penjualan_kode" name="penjualan_kode"
                                value="{{ old('penjualan_kode') }}" required>
                            @error('penjualan_kode')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Pembeli</label>
                        <div class="col-10">
                            <input type="text" class="form-control" id="pembeli" name="pembeli"
                                value="{{ old('pembeli') }}" required>
                            @error('pembeli')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Tanggal</label>
                        <div class="col-10">
                            <input type="date" class="form-control" id="penjualan_tanggal" name="penjualan_tanggal"
                                value="{{ old('penjualan_tanggal') }}" required>
                            @error('penjualan_tanggal')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-12">
                            <table class="table table-bordered table-striped table-hover table-sm"
                                id="tableTambahPenjualan">
                                <thead>
                                    <tr>
                                        <th>Nama Barang</th>
                                        <th>Harga Barang</th>
                                        <th>Jumlah </th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <!-- Baris data barang yang akan ditambahkan -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-2 control-label col-form-label">Total Harga</label>
                        <div class="col-10">
                            <input type="number" class="form-control" id="total_harga" name="total_harga" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('penjualan') }}">Kembali</a>
                        </div>
                    </div>
                </form>
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // Function untuk menghitung dan memperbarui total harga
            function updateTotalHarga() {
                var total_harga = 0;
                $('#tableTambahPenjualan tbody tr').each(function() {
                    var harga = parseFloat($(this).find('td:eq(1)').text());
                    var jumlah = parseInt($(this).find('td:eq(2)').text());
                    total_harga += harga * jumlah;
                });
                console.log(total_harga); // Periksa total harga di konsol browser
                $('#total_harga').val(total_harga.toFixed(2)); // Menampilkan total harga dengan 2 digit desimal
            }

            // Tangani klik tombol "Tambah" di tabel "Data Barang"
            $('.tambah-barang').click(function() {
                // Dapatkan data barang dari tombol yang diklik
                var barangId = $(this).data('barang-id');
                var barangNama = $(this).data('barang-nama');
                var hargaJual = $(this).data('harga-jual');
                var jumlah = $(this).data('jumlah');

                // Cari apakah sudah ada baris dengan nama barang yang sama
                var existingRow = $('#tableTambahPenjualan tbody tr').filter(function() {
                    return $(this).find('td:first').text() === barangNama;
                });

                if (existingRow.length > 0) {
                    // Jika sudah ada, perbarui jumlahnya
                    var existingJumlah = parseInt(existingRow.find('td:eq(2)').text());
                    existingJumlah++;
                    existingRow.find('td:eq(2)').text(existingJumlah);
                } else {
                    // Jika belum ada, tambahkan baris baru
                    var newRow = '<tr>' +
                        '<td>' + barangNama + '</td>' +
                        '<td>' + hargaJual + '</td>' +
                        '<td>' + jumlah + '</td>' +
                        '<td><button type="button" class="btn btn-danger hapus-barang">Hapus</button></td>' +
                        '</tr>';
                    // Tambahkan input hidden untuk menyimpan barang[]
                    newRow += '<input type="hidden" name="barang[]" value="' + barangId + '">';
                    newRow += '<input type="hidden" name="jumlah[]" value="' + jumlah + '">';
                    newRow += '<input type="hidden" name="harga[]" value="' + hargaJual + '">';
                    $('#tableTambahPenjualan tbody').append(newRow);
                }

                // Perbarui total harga
                updateTotalHarga();
            });

            // Tangani klik tombol "Hapus" di dalam tabel "Tambah Penjualan"
            $('#tableTambahPenjualan').on('click', '.hapus-barang', function() {
                $(this).closest('tr').remove();
                // Perbarui total harga setelah menghapus barang
                updateTotalHarga();
            });
        });
    </script>
@endsection

@push('css')
    <style>
        .grid-container {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            grid-column-gap: 20px;
        }
    </style>
@endpush
