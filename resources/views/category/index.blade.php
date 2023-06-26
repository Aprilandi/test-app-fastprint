@extends('default')
@push('style')
@endpush

@section('pageContent')
{{--
<!-- Modal Tambah Category -->
<div id="tambahKategoriKategori" name="tambahKategoriKategori" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="tambahKategoriKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="tambahKategoriKategoriLabel"><b>tambahKategori Data Reward</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="inputNama">Nama Kategori</label><br>
                        <input type="text" class="form-control" id="inputNama" name="inputNama" placeholder="Nama kategori...
                        ">
                    </div>
                    <div class="form-group">
                        <label for="inputDeskripsi">Deskripsi</label><br>
                        <input type="textarea" class="form-control" id="inputDeskripsi" name="inputDeskripsi"
                            placeholder="Deskripsi kategori...">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Edit Category -->
<div id="editKategori" name="editKategori" class="modal fade" tabindex="-1" role="dialog"
    aria-labelledby="editKategoriLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editKategoriLabel"><b>Edit Data Reward</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateForm" action="" method="post" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group">
                        <label for="inputedNama">Nama Kategori</label><br>
                        <input type="text" class="form-control" id="inputedNama" name="inputedNama"
                            placeholder="Nama kategori...">
                    </div>
                    <div class="form-group">
                        <label for="inputedDeskripsi">Deskripsi</label><br>
                        <input type="textarea" class="form-control" id="inputedDeskripsi" name="inputedDeskripsi"
                            placeholder="Deskripsi kategori...">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
--}}
@endsection

@push('scripts')
@endpush