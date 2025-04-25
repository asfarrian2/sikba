@extends('layouts.operator2')

@section('content')
    <div class="">
        <div class="page-title">
            <div class="title_left">
                <h3>Dashboard Anggaran {{ $profil->nama_seksi }} TA. {{ Auth::guard('operator2')->user()->ta }}</h3>
            </div>
        </div>
        <div class="clearfix"></div>
            <div class="row">
                <div class="col-md-12">
                    <div class="">
                        <div class="x_content">
                            <div class="row">
                                <div class="animated flipInY col-lg-6 col-md-3 col-sm-6  ">
                                    <div class="tile-stats">
                                        <div class="icon"><i class="fa fa-money"></i></div>
                                    <div class="count">Rp <?php echo number_format($anggaran ,0,',','.')?></div>
                                        <h3>Total Anggaran</h3>
                                        <p>{{ $profil->nama_seksi }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('myscript')


@endpush
