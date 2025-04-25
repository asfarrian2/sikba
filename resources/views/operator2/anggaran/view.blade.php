@extends('layouts.operator2')

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
            <h2>TAHUN ANGGARAN {{ Auth::guard('operator2')->user()->ta }}</h2>
            <div class="clearfix"></div>
        </div>
        <div class="col-md-12">
          <div id="" class="pull-left" style="background: #fff;    padding: 5px 10px; border: 1px solid #ccc">
            <i class="fa fa-home"></i>
            <span><a href="/dashboard" style="color: #0a803f">Home</a> /
                <i class="fa fa-database"></i> Anggaran </span> <b class="caret"></b>
          </div>
          @if(Request::has('SelectSubkegiatan'))
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
          @else
          @endif
        </div>
        <br>
        <br>
<!-- End Judul Halaman -->

<!-- Begin Tabel -->
    <div class="x_content">
            <div class="col-md-12">
            <br>
            <form action="/opt2/anggaran" method="GET" id="frmCabang">
                <div class="form-group row">
                    <label class="col-form-label col-md-1 col-sm-1">Program :</label>
                    <div class="col-md-4 col-sm-4 ">
                        <select name="selectProgram" id="selectProgram" class="form-control" required="required">
                                @if(Request::has('selectProgram'))
                                <option value="">Pilih Program</option>
                                @foreach ($program as $d)
                                    <option {{ Crypt::decrypt(Request('selectProgram')) == $d->id_program ? 'selected' : '' }} value="{{ Crypt::encrypt($d->id_program) }}">{{ $d->kode_program }} - {{ $d->nama_program }}</option>
                                @endforeach
                                 @else
                                <option value="">Pilih Program</option>
                                @foreach ($program as $d)
                                    <option value="{{ Crypt::encrypt($d->id_program) }}">{{ $d->kode_program }} - {{ $d->nama_program }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label class="col-form-label col-md-1 col-sm-1">Kegiatan :</label>
                    <div class="col-md-4 col-sm-4 ">
                        <select name="SelectKegiatan" id="SelectKegiatan" class="form-control" required="required">
                            <option value="">Pilih Kegiatan</option>
                            @foreach ($kegiatan as $d)
                            <option
                            {{ Request('SelectKegiatan') == $d->id_keg ? 'selected' : '' }}
                            value="{{ $d->id_keg }}">{{ $d->kode_keg }} {{ $d->nama_keg}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <br>
                <div class="form-group row">
                    <label class="col-form-label col-md-1 col-sm-1">Sub Kegiatan :</label>
                    <div class="col-md-4 col-sm-4 ">
                        <select name="SelectSubkegiatan" id="SelectSubkegiatan" class="form-control" required="required">
                            <option value="">Pilih Sub Kegiatan</option>
                            @foreach ($subkeg as $d)
                            <option
                            {{ Request('SelectSubkegiatan') == $d->id_subkeg ? 'selected' : '' }}
                            value="{{ $d->id_subkeg }}">{{ $d->kode_subkeg }} {{ $d->nama_subkeg}}</option>
                          @endforeach
                        </select>
                    </div>
                </div>
                <br>
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
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                            <th style="background-color: #a1a1a1;" class="text-center">NO.</th>
                            <th style="background-color: #a1a1a1;" class="text-center">KODE REKENING</th>
                            <th style="background-color: #a1a1a1;" class="text-center">NAMA / URAIAN</th>
                            <th style="background-color: #a1a1a1;" class="text-center">HARGA SATUAN</th>
                            <th style="background-color: #a1a1a1;" class="text-center">KOEFESIEN</th>
                            <th style="background-color: #a1a1a1;" class="text-center">PAGU ANGGARAN</th>
                            <th style="background-color: #a1a1a1;" class="text-center">AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($view as $d)
                            <tr>
                            <td style="background-color: #cccccc;" class="text-center"><b>{{ $loop->iteration }}</b></td>
                            <td style="background-color: #cccccc;"><b>{{ $d->kode_rekening}}</b></td>
                            <td style="background-color: #cccccc;"><b>{{ $d->nama_rekening}}</b></td>
                            <td style="background-color: #cccccc;"></td>
                            <td style="background-color: #cccccc;"></td>
                            <td style="background-color: #cccccc;"><b>Rp <?php echo number_format($d->total_ranggaran ,0,',','.')?></b></td>
                            @csrf
                            <td style="background-color: #cccccc;" class="text-center">
                            <a class="rincian" href="#" data-id="{{ Crypt::encrypt($d->id_anggaran) }}" title="Tambah Rincian"><i class="rincian fa fa-plus text-succsess btn btn-primary btn-sm" ></i></a>
                             <a class="hapus" href="#" data-id="{{ Crypt::encrypt($d->id_anggaran) }}" title="Hapus Data"><i class="hapus fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                            </td>
                            </tr>
                            @foreach ($rincian as $r)
                            @if ($d->id_anggaran == $r->id_anggaran)
                            <tr>
                                <td colspan="2" class="text-right">-</td>
                                <td>{{ $r->nama_ranggaran}} <br> Spesifikasi: <b>{{ $r->spesifikasi_ranggaran}}</b></td>
                                <td>Rp <?php echo number_format($r->harga_ranggaran ,0,',','.')?></td>
                                <td>{{ $r->koefesien_ranggaran}} {{ $r->satuan_ranggaran}}</td>
                                <td><b>Rp <?php echo number_format($r->pagu_ranggaran ,0,',','.')?></b></td>
                                <td class="text-center">
                                    <a class="editr" href="#" data-id="{{ Crypt::encrypt($r->id_ranggaran) }}" title="Edit Rincian"><i class="fa fa-pencil text-succsess btn btn-warning btn-sm" ></i></a>
                                     <a class="hapusr" href="#" data-id="{{ Crypt::encrypt($r->id_ranggaran) }}" title="Hapus Data"><i class="fa fa-trash text-succsess btn btn-danger btn-sm" ></i></a>
                                </td>
                            @endif
                            </tr>
                      </tbody>
                      @endforeach
                      @endforeach
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
                            <h5 class="modal-title">Tambah Kode Rekening</h5>
                            <div class="clearfix"></div>
                            <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body">
                            <form action="/opt2/koderekening/store" method="POST" id="frmCabang">
                            @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <div class="input-icon mb-12 col-md-12 col-sm-12">
                                            <span>Kode Rekening :</span>
                                            <input type="hidden" value="{{Request('SelectSubkegiatan')}}" name="subkeg" class="form-control" placeholder="" required>
                                            <select name="koderekening" id="koderekening" class="form-control" required="required">
                                                <option value="">Pilih Kode Rekening</option>
                                                @foreach ($koderekening as $d)
                                                <option value="{{ $d->id_koderekening }}">{{ $d->kode_rekening }} - {{ $d->nama_rekening  }}</option>
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

            <!-- begin modal tambah rincian -->
            <div class="modal modal-blur fade" id="modal-tambahrincian" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Tambah Kegiatan</h5>
                            <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="loadtambahrincian">
                            {{-- ***Form tambah*** --}}
                        </div>
                    </div>
                </div>
            </div>
            <!-- end modal tambah rincian  -->

            <!-- begin modal updte -->
            <div class="modal modal-blur fade" id="modal-editr" tabindex="-1" role="dialog" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Edit Rincian Pagu Anggaran</h5>
                            <button type="button" class="fa fa-close close" data-bs-dismiss="modal"></button>
                        </div>
                        <div class="modal-body" id="loadeditr">
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
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $(document).ready(function(){
        $("#selectProgram").on('change', function(){
            var id_program = $(this).val();
           //console.log(id_wajibpajak);
           if (id_program) {
            $.ajax({
                url: '/opt2/filterkeg/'+id_program,
                type: 'GET',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data){
                    //console.log(data);
                     if (data) {
                        $("#SelectKegiatan").empty();
                        $('#SelectKegiatan').append('<option value=""> Pilih Kegiatan</option>');
                        $.each(data, function(key, keg){
                            $('select[name="SelectKegiatan"]').append(
                                '<Option value="'+keg.id_keg+'">'+keg.kode_keg+' '+keg.nama_keg+'</Option>'
                            )
                        });
                     }else{
                        $("#SelectKegiatan").empty();
                     }
                }
            });
           } else {
            $("#SelectKegiatan").empty();
           }
        });
    });

</script>

<script>
    $(document).ready(function(){
        $("#SelectKegiatan").on('change', function(){
            var id_keg = $(this).val();
           //console.log(id_wajibpajak);
           if (id_keg) {
            $.ajax({
                url: '/opt2/filtersub/'+id_keg,
                type: 'GET',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function (data){
                    //console.log(data);
                     if (data) {
                        $("#SelectSubkegiatan").empty();
                        $('#SelectSubkegiatan').append('<option value=""> Pilih Kegiatan</option>');
                        $.each(data, function(key, subkeg){
                            $('select[name="SelectSubkegiatan"]').append(
                                '<Option value="'+subkeg.id_subkeg+'">'+subkeg.kode_subkeg+' '+subkeg.nama_subkeg+'</Option>'
                            )
                        });
                     }else{
                        $("#SelectSubkegiatan").empty();
                     }
                }
            });
           } else {
            $("#SelectSubkegiatan").empty();
           }
        });
    });

</script>

<script>
    $('.hapus').click(function(){
        var id_anggaran = $(this).attr('data-id');
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
        window.location = "/opt2/anggaran/"+id_anggaran+"/hapus"
      }
    });
    });
</script>

<script>
    $('.hapusr').click(function(){
        var id_ranggaran = $(this).attr('data-id');
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
        window.location = "/opt2/ranggaran/"+id_ranggaran+"/hapus"
      }
    });
    });
</script>

<!-- Start Button Tambah -->
<script>

  $("#tambah").click(function() {
     $("#modal-inputobjek").modal("show");
 });
 var span = document.getElementsByClassName("close")[0];
</script>
<!-- End Button Tambah -->

<!-- Button Tambah Rincian -->
<script src="/gentella/vendors/uang/jquery.mask.min.js"></script>
<script>
    $('.rincian').click(function(){
        var id_anggaran = $(this).attr('data-id');
        $.ajax({
                 type: 'POST',
                 url: '/opt2/ranggaran/tambah',
                 cache: false,
                 data: {
                     _token: "{{ csrf_token() }}",
                     id_anggaran: id_anggaran
                 },
                 success: function(respond) {
                     $("#loadtambahrincian").html(respond);
                     $('.pagu').mask("#.##0", {
                            reverse:true
                        });
                 }
             });
         $("#modal-tambahrincian").modal("show");

    });
    var span = document.getElementsByClassName("close")[0];
    </script>
    <!-- END Button Edit Rincian -->

<!-- Button Edit Anggaran -->
<script>
$('.editr').click(function(){
    var id_ranggaran = $(this).attr('data-id');
    $.ajax({
             type: 'POST',
             url: '/opt2/ranggaran/edit',
             cache: false,
             data: {
                 _token: "{{ csrf_token() }}",
                 id_ranggaran: id_ranggaran
             },
             success: function(respond) {
                 $("#loadeditr").html(respond);
                 $('.pagu').mask("#.##0", {
                            reverse:true
                        });
             }
         });
     $("#modal-editr").modal("show");

});
var span = document.getElementsByClassName("close")[0];
</script>
<!-- END Button Edit Anggaran -->

@endpush
