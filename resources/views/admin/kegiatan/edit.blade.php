<form action="/admin/kegiatan/{{Crypt::encrypt($kegiatan->id_keg)}}/update" method="POST" id="frmEdit" enctype="multipart/form-data">
 @csrf
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Kode Kegiatan : </span>
            <input type="hidden" value="{{ $kegiatan->kode_keg }}" name="kode" id="kode" class="form-control" required>
            <input type="text" value="{{ $kegiatan->kode_keg }}" name="kode_baru" id="kode_baru" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Nama Kegiatan : </span>
            <input type="text" value="{{ $kegiatan->nama_keg }}" name="nama" id="nama" class="form-control" required>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="input-icon mb-3 col-md-12 col-sm-6">
            <span>Program : </span>
            <select name="id_program" id="unit" class="form-control" required="required">
                <option value="">Pilih Program</option>
                @foreach ($id_program as $d)
                <option {{ $kegiatan->id_program == $d->id_program ? 'selected' : '' }} value="{{ $d->id_program }}">{{ $d->kode_program }} - {{ $d->nama_program  }}</option>
                @endforeach
            </select>
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
