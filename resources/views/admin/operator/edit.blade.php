<form action="/admin/operator/{{Crypt::encrypt($operator->id_opt)}}/update" method="POST" id="frmEdit" enctype="multipart/form-data">
 @csrf
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Nama Lengkap : </span>
            <input type="text" value="{{ $operator->nama_opt }}" name="nama" id="nama" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Username : </span>
            <input type="text" value="{{ $operator->username }}" name="username" id="username" class="form-control" required>
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
