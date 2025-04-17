@extends('layouts.admin')

@section('content')

<!-- Begin Pesan Peringatan -->
<div class="">
    @csrf
    @php
    $messagewarning = Session::get('warning');
    $messagesuccess = Session::get('success');
@endphp
@if (Session::get('warning'))
<div class="x_content bs-example-popovers">
    <div class="alert alert-danger alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-warning"></i> &nbsp;
      {{ $messagewarning }}
      </div>
</div>
<br>
@endif

@if (Session::get('success'))
<div class="x_content bs-example-popovers">
    <div class="alert alert-success alert-dismissible " role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <i class="fa fa-check-circle"></i> &nbsp;
      {{ $messagesuccess }}
      </div>
</div>
<br>
@endif

<!-- End Pesan Peringatan -->

<!-- Begin Judul Halaman -->
<div class="row">
<div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
        <div class="x_title">
            <h2>KEGIATAN</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12">
          <div id="" class="pull-left" style="background: #fff;    padding: 5px 10px; border: 1px solid #ccc">
            <i class="fa fa-home"></i>
            <span><a href="/dashboard" style="color: #0a803f">Home</a> /
                <i class="fa fa-list"></i> Kegiatan </span> <b class="caret"></b>
          </div>
          <a href="#" class="btn btn-primary btn-md pull-right" id="tambah">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-plus"
                width="24" height="24" viewBox="0 0 24 24" stroke-width="2"
                stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 5l0 14"></path>
                <path d="M5 12l14 0"></path>
            </svg>
            Tambah
          </a>
        </div>
        <br>
        <br>
<!-- End Judul Halaman -->

<!-- Begin Tabel -->
    <div class="x_content">
            <div class="col-md-12">
            <br>
            <form action="/admin/kegiatan" method="GET" id="frmCabang">
                <div class="form-group row">
                    <label class="col-form-label ">Program :</label>
                    <div class="col-md-4 col-sm-4 ">
                        <select name="filter" id="unit" class="form-control" required="required">
                            @if(Request::has('filter'))
                                <option value="">Pilih Program</option>
                                @foreach ($program as $d)
                                    <option {{ Crypt::decrypt(Request('filter')) == $d->id_program ? 'selected' : '' }} value="{{ Crypt::encrypt($d->id_program) }}">{{ $d->kode_program }} - {{ $d->nama_program }}</option>
                                @endforeach
                            @else
                                <option value="">Pilih Program</option>
                                @foreach ($program as $d)
                                    <option value="{{ Crypt::encrypt($d->id_program) }}">{{ $d->kode_program }} - {{ $d->nama_program }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div> <br>
				<div class="form-group row">
					<div class="col-md-4 col-sm-4">
						<button type="submit" class="btn btn-secondary col-md-4 col-sm-4">Terapkan Filter | <i class="fa fa-search text-succsess" > </i></button>
					</div>
				</div>
            </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
            <br>
            <div class="row">
                <div class="col-sm-12">
                  <div class="card-box table-responsive">
                      <table id="datatable" class="table table-striped table-bordered" width="100%">
                        <thead>
                            <tr>
                            <th class="text-center">No.</th>
                            <th class="text-center">Kode Kegiatan</th>
                            <th class="text-center">Nama Kegiatan</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($view as $d)
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $d->kode_keg}}</td>
                            <td>{{ $d->nama_keg}}</td>
                            @if ($d->status_keg == '0')
                            <td class="text-center"> <span class="badge badge-warning" style="font-size: 12px;">Nonaktif</span></td>
                            @else
                            <td class="text-center"> <span class="badge badge-success" style="font-size: 12px;">Aktif</span></td>
                            @endif
                            <td class="text-center">
                            @csrf
                            <a class="rincian" href="/admin/kegiatan/sub{{ Crypt::encrypt($d->id_keg) }}" title="Sub Kegiatan"><i class="rincian fa fa-navicon text-succsess btn btn-success btn-sm" ></i></a>
                             @if ($d->status_keg == '1')
                             <a class="status" href="#" data-id="{{ Crypt::encrypt($d->id_keg) }}" title="Nonaktifkan"><i class="hapus fa fa-ban text-succsess btn btn-secondary btn-sm" ></i></a>
                             @else
                             <a class="status" href="#" data-id="{{ Crypt::encrypt($d->id_keg) }}" title="Aktifkan"><i class="hapus fa fa-check text-succsess btn btn-primary btn-sm" ></i></a>
                             @endif
                             <a href="#" data-id="{{ Crypt::encrypt($d->id_keg) }}" title="Edit Data" class="edit"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                             <a class="hapus" href="#" data-id="{{ Crypt::encrypt($d->id_keg) }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            </td>
                            </tr>
                      </tbody>
                      @empty
                      <td class="text-center" colspan="5"> Data Tidak Ditemukan </td>
                      @endforelse
                    </table>
                  </div>
                </div>
              </div>
            </div>
        </div>
            <!-- End Tabel -->

            <!-- Begin Modal Tambah -->
            <div class="modal modal-blur fade" id="modal-inputobjek" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Kegiatan</h5>
                            <div class="clearfix"></div>
                            <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/admin/kegiatan/store" method="POST" id="frmCabang">
                            @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-icon mb-12 col-md-12 col-sm-12">
                                            <span>Kode Kegiatan :</span>
                                            <input type="text" pattern="[0-9\.]+" maxlength="17" name="kode" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-icon mb-12 col-md-12 col-sm-12">
                                            <span>Nama Kegiatan :</span>
                                            <input type="text"  name="nama" class="form-control" placeholder="" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-icon mb-12 col-md-12 col-sm-12">
                                            <span>Program :</span>
                                            <select name="id_program" id="unit" class="form-control" required="required">
                                                <option value="">Pilih Program</option>
                                                @foreach ($program as $d)
                                                <option value="{{ $d->id_program }}">{{ $d->kode_program }} - {{ $d->nama_program  }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="clearfix"><br></div>
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
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Modal Tambah -->

            <!-- begin modal updte -->
            <div class="modal modal-blur fade" id="modal-editobjek" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Kegiatan</h5>
                            <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="loadeditform">
                            {{-- ***Form Edit*** --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal updte  -->
        </div>
    </div>
</div>


@endsection

@push('myscript')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    $('.hapus').click(function(){
        var id_keg = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Data Ini Ingin Di Hapus ?",
      text: "Jika Ya Maka Data Akan Terhapus Permanen",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus Saja!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/admin/kegiatan/"+id_keg+"/hapus"
      }
    });
    });
</script>


<!-- Button Edit Status -->
<script>
    $('.status').click(function(){
        var id_keg = $(this).attr('data-id');
    Swal.fire({
      title: "Apakah Anda Yakin Ingin Mengubah Status Data Ini ?",
      text: "Jika Ya Maka Status Data Akan Berubah",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Ubah Saja!"
    }).then((result) => {
      if (result.isConfirmed) {
        window.location = "/admin/kegiatan/"+id_keg+"/status"
      }
    });
    });
</script>
<!-- Button Edit Status -->

<!-- Start Button Tambah -->
<script>

  $("#tambah").click(function() {
     $("#modal-inputobjek").modal("show");
 });
 var span = document.getElementsByClassName("close")[0];
</script>
<!-- End Button Tambah -->


<!-- Button Edit SPJ -->
<script>
$('.edit').click(function(){
    var id_keg = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/admin/kegiatan/edit',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_keg: id_keg
             },
             success: function(respond) {
                 $("#loadeditform").html(respond);
             }
         });
     $("#modal-editobjek").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Edit SPJ -->

@endpush
