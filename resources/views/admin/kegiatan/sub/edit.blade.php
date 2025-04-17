<form action="/admin/subkeg/{{Crypt::encrypt($subkeg->id_subkeg)}}/update" method="POST" id="frmEdit" enctype="multipart/form-data">
 @csrf
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Kode Sub Kegiatan : </span>
            <input type="hidden" value="{{ $subkeg->kode_subkeg }}" name="kode" id="kode" class="form-control" required>
            <input type="text" value="{{ $subkeg->kode_subkeg }}" name="kode_baru" id="kode_baru" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Nama Sub Kegiatan : </span>
            <input type="text" value="{{ $subkeg->nama_subkeg }}" name="nama" id="nama" class="form-control" required>
        </div>
    </div>
</div>
<div class="row mt-2">
    <div class="col-12">
        <div class="form-group">
            <button class="btn btn-success w-100">
            <i class="fa fa-save"></i> Simpan
            </button>
        </div>
    </div>
</div>
</form>
