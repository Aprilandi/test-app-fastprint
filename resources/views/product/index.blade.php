@extends('default')
@push('style')
@endpush

@section('pageContent')
<div class="content__wrap">
    <div class="btn__ctaData">
        <span class="btn__Getdata">
            <button type="button" class="getCta btn__cta" id="btnAmbil" href="{{ route('produk.data') }}">Ambil
                Data</button>
        </span>
        <span class="btn__Inpdata">
            <button type="button" class="btn__cta" data-toggle="modal" data-target="#tambahProduk" id="btnTambah"
                name="btnTambah">
                <i class="fa fa-plus"></i>
                Tambah Data
            </button>
        </span>
    </div>
    <table id="tableProduct" class="display dataTable" style="width:100%">
        <thead>
            <tr>
                <th>
                    No
                </th>
                <th>
                    Nama Produk
                </th>
                <th>
                    Harga Produk
                </th>
                <th>
                    Kategori
                </th>
                <th>
                    Aksi
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($products as $row)
            <tr>
                <td class="text-center">{{ $loop->iteration }}.</td>
                <td>{{ $row->nama_produk }}</td>
                {{-- <td>Rp {{ number_format($row->harga, 2, ',', '.') }}</td> --}}
                <td>{{ $row->harga }}</td>
                <td>{{ $row->kategori->nama_kategori }}</td>
                <td class="text-center">
                    <div class="row">
                        <button class="btn btn-sm col-6 btn__editCta border-0 shadow-0 outline-0 btnEdit"
                            href="{{ route('produk.update',  $row->id_produk) }}"
                            data-kategori="{{ $row->id_kategori }}" data-nama="{{ $row->nama_produk }}"
                            data-harga="{{ $row->harga }}" data-status="{{ $row->status }}"
                            data-desc="{{ $row->desc }}"><i class="fa fa-edit">
                            </i></button>

                        <button class="btn btn__destroyCta btn-sm col-6 deleteProduk"
                            href="{{ route('produk.destroy', $row->id_produk) }}" data-nama="{{ $row->nama_produk }}">
                            <i class="fa fa-trash"> </i>
                        </button>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<!-- Modal Tambah Produk -->
<div class="row">
    <div id="tambahProduk" name="tambahProduk" class="modal fade modalContainer" tabindex="-1" role="dialog"
        aria-labelledby="tambahProdukLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="insertForm" action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="inputKategori">Kategori</label><br>
                            <select name="inputKategori" id="inputKategori" class="form-control">
                                <option value="" selected hidden disabled>Pilih Kategori Produk</option>
                                @foreach($categories as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputNama">Nama Produk</label><br>
                            <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Masukkan nama produk...
                            " required>
                        </div>
                        <div class="form-group">
                            <label for="inputHarga">Harga Produk</label><br>
                            <input type="number" class="form-control numbersOnly" id="inputHarga" name="inputHarga"
                                placeholder="Masukkan harga produk...
                            ">
                        </div>
                        <div class="form-group">
                            <label for="inputStatus">Status</label><br>
                            <select name="inputStatus" id="inputStatus" class="form-control">
                                <option value="" selected hidden disabled>Pilih Status Produk</option>
                                <option value="bisa dijual">Bisa Dijual</option>
                                <option value="tidak bisa dijual">Tidak Bisa Dijual</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btnSave">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Produk -->
<div class="row">
    <div id="editProduk" name="editProduk" class="modal fade" tabindex="-1" role="dialog"
        aria-labelledby="editProdukLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
                        <div class="form-group">
                            <label for="inputedKategori">Kategori</label><br>
                            <select name="inputedKategori" id="inputedKategori" class="form-control">
                                <option value="" selected hidden disabled>Pilih Kategori Produk</option>
                                @foreach($categories as $row)
                                <option value="{{ $row->id }}">{{ $row->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="inputedNama">Nama Produk</label><br>
                            <input type="text" class="form-control" id="inputedNama" name="inputedNama" placeholder="Masukkan nama produk...
                            " required>
                        </div>
                        <div class="form-group">
                            <label for="inputedHarga">Harga Produk</label><br>
                            <input type="number" class="form-control numbersOnly" id="inputedHarga" name="inputedHarga"
                                placeholder="Masukkan harga...
                                ">
                        </div>
                        <div class="form-group">
                            <label for="inputedStatus">Status</label><br>
                            <select name="inputedStatus" id="inputedStatus" class="form-control">
                                <option value="" selected hidden disabled>Pilih Status Produk</option>
                                <option value="bisa dijual">Bisa Dijual</option>
                                <option value="tidak bisa dijual">Tidak Bisa Dijual</option>
                            </select>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btnSave">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<form action="" method="post" id="getData">
    {{ csrf_field() }}
</form>
@endsection

@push('scripts')
<script>
    $('.btnEdit').on('click', function(){
        $('#inputedNama').val($(this).data('nama'));
        $('#inputedHarga').val($(this).data('harga'));
        $('#inputedKategori').val($(this).data('kategori'));
        $('#inputedStatus').val($(this).data('status'));
        $('#updateForm').attr('action', $(this).attr('href'));
        $('#editProduk').modal('show');
    });

    $('button#btnAmbil').on('click', function(e) {
        var href = $(this).attr('href');
        Swal.fire({
                title: "Anda yakin untuk mengambil data dari API?",
                text: "Data yang ada pada local database tidak akan hilang, jika ada data baru dari API akan di simpan pada local database.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya',
                customClass: 'sweetAlert__class'
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $('#getData').attr('action', href);
                    $('#getData').submit();
                }
            })
    });

    $('.deleteProduk').on('click', function() {
        var href = $(this).attr('href');
        var nama = $(this).data('nama');
        Swal.fire({
                title: "Anda yakin untuk menghapus data produk : \"" + nama + "\"?",
                text: "Setelah dihapus, data tidak bisa dikembalikan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batal',
                confirmButtonText: 'Ya, hapus',
                customClass: 'sweetAlert__class'
            })
            .then((willDelete) => {
                if (willDelete.value) {
                    $('#deleteForm').attr('action', href);
                    $('#deleteForm').submit();
                }
            })
    });
</script>
@endpush