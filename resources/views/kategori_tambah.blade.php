@extends('layouts.app')

@section('content')

<div class="container row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Tambah Kategori
            <a href="{{url('/kategori')}}" class="float-right btn btn-sm-primary">Kembali</a>
            </div>
            <div class="card-body">
            <form action="{{url('/kategori/aksi')}}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="kategoribaru">Nama Kategori Baru</label>
                    <input type="text" name="kategori" class="form-control">
                    @if($errors->has('kategori'))
                    <span class="text-danger">
                    <strong>{{$errors->first('kategori')}}</strong>
                    </span>
                    @endif
                </div>
                <input type="submit" class="btn btn-primary" value="Simpan">
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
