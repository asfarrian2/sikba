<form action="/admin/program/{{Crypt::encrypt($program->id_program)}}/update" method="POST" id="frmEdit" enctype="multipart/form-data">
 @csrf
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Kode Rekening : </span>
            <input type="hidden" value="{{ $program->kode_program }}" name="kode" id="kode" class="form-control" required>
            <input type="text" value="{{ $program->kode_program }}" name="kode_baru" id="kode_baru" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Nama Rekening : </span>
            <input type="text" value="{{ $program->nama_program }}" name="nama" id="nama" class="form-control" required>
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
