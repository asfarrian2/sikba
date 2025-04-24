<form action="/opt2/ranggaran/update" method="POST" id="frmTambah" enctype="multipart/form-data">
    @csrf
   <div class="row">
       <div class="col-12">
           <div class="input-icon mb-3 col-md-12 col-sm-6">
               <span>Uraian : </span>
               <input type="text" value="{{ $ranggaran->nama_ranggaran}}" name="nama" id="nama" class="form-control" required>
           </div>
       </div>
   </div>
   <div class="row">
       <div class="col-12">
           <div class="input-icon mb-3 col-md-12 col-sm-6">
               <span>Spesifikasi : </span>
               <input type="text" value="{{ $ranggaran->spesifikasi_ranggaran}}" name="spesifikasi" id="spesifikasi" class="form-control" required>
           </div>
       </div>
   </div>
   <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3 col-md-12 col-sm-6">
                <span>Pagu Anggaran (Rp) : </span>
                <input type="text" value="{{ $ranggaran->pagu_ranggaran}}" name="pagu" id="pagu" class="pagu form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3 col-md-12 col-sm-6">
                <span>Jumlah Koefesien : </span>
                <input type="text" value="{{ $ranggaran->koefesien_ranggaran}}" name="koefesien" id="koefesien" class="form-control" required>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="input-icon mb-3 col-md-12 col-sm-6">
                <span>Satuan / Nilai Koefesien : </span>
                <input type="text" value="{{ $ranggaran->satuan_ranggaran}}" name="satuan" id="satuan" class="form-control" maxlength="30" required>
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
