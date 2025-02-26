<form action="/admin/seksi/{{Crypt::encrypt($seksi->id_seksi)}}/update" method="POST" id="frmEdit" enctype="multipart/form-data">
 @csrf
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Nama Seksi / Bidang: </span>
            <input type="text" value="{{ $seksi->nama_seksi }}" name="nama_seksi" id="nama_seksi" class="form-control" required>
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
