@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3 my-3">
            <div class="card py-2 alert-success">
                {{-- <div class="card-header">{{ __('Dashboard') }}</div> --}}

                <div class="card-body">
                    <h4>{{ "Rp.".number_format($pemasukan_hari_ini).",-" }}</h4>
                    {{-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }} --}}
                    <b>Pemasukan Hari ini</b>

                </div>
            </div>
        </div>
        <div class="col-md-3 my-3">
            <div class="card py-2 alert-success">
                <div class="card-body">
                    <h4>{{ "Rp.".number_format($pemasukan_bulan_ini).",-" }}</h4>
                    <b>Pemasukan Bulan Ini</b>
                </div>
            </div>

        </div>
        <div class="col-md-3 my-3">
            <div class="card py-2 alert-success">
                <div class="card-body">
                    <h4>{{ "Rp.".number_format($pemasukan_tahun_ini).",-" }}</h4>
                    <b>Pemasukan Tahun Ini</b>
                </div>
            </div>
        </div>
        <div class="col-md-3 my-3">
            <div class="card py-2 text-white bg-success">
                <div class="card-body">
                    <h4>{{ "Rp.".number_format($seluruh_pemasukan).",-" }}</h4>
                    <b>Seluruh Pemasukan</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-danger">
                <div class="card-body">
                    <h4>{{ "Rp.".number_format($pengeluaran_hari_ini).",-" }}</h4>
                    <b>Pengeluaran Hari Ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-danger">
                <div class="card-body">
                    <h4>{{ "Rp.".number_format($pengeluaran_bulan_ini).",-" }}</h4>
                    <b>Pengeluaran Bulan Ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 alert-danger">
                <div class="card-body">
                    <h4>{{ "Rp.".number_format($pengeluaran_tahun_ini).",-" }}</h4>
                    <b>Pengeluaran Tahun Ini</b>
                </div>
            </div>
        </div>

        <div class="col-md-3 my-3">
            <div class="card py-2 bg-danger text-white">
                <div class="card-body">
                    <h4>{{ "Rp.".number_format($seluruh_pengeluaran).",-" }}</h4>
                    <b>Seluruh Pengeluaran</b>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
