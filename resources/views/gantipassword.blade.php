@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        Ganti Password
                    </div>
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('sukses'))
                            <div class="alert alert-success">
                                {{ session('sukses') }}
                            </div>
                        @endif
                        <form action="{{ url('/ganti_password/aksi') }}" method="post">
                        @csrf
                            <div class="form-group">
                                <label for="">Masukkan Password Sekarang</label>
                                <input type="password" placeholder="*********************" name="current-password" class="form-control" required>
                                @if ($errors->has('current-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current-password') }}</strong>
                                </span>
                                    
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="">Masukkan Password Baru</label>
                                <input type="password" placeholder="*********************" name="new-password" class="form-control" required>
                                @if ($errors->has('new-password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new-password') }}</strong>
                                </span>
                                    
                                @endif
                            </div>

                            <div class="form-group">
                                <label for="">Konfirmasi Password Baru</label>
                                <input type="password" placeholder="*********************" name="new-password_confirmation" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Ganti Password</button>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection