<form action="/admin/koderekening/{{Crypt::encrypt($koderekening->id_koderekening)}}/update" method="POST" id="frmEdit" enctype="multipart/form-data">
 @csrf
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Kode Rekening : </span>
            <input type="text" value="{{ $koderekening->kode_rekening }}" name="kode" id="kode" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Nama Rekening : </span>
            <input type="text" value="{{ $koderekening->nama_rekening }}" name="nama" id="nama" class="form-control" required>
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
