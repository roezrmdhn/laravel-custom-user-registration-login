@extends('auth.layouts')

@section('content')
    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tambah Mahasiswa</div>
                <div class="card-body">
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            {{ $message }}
                        </div>
                    @endif

                    <form action="{{ route('mahasiswa.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="nim">NIM:</label>
                            <input type="text" name="nim" class="form-control" id="nim"
                                value="{{ old('nim') }}">
                            @if ($errors->has('nim'))
                                <div class="text-danger">
                                    {{ $errors->first('nim') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group">
                            <label for="nama">Nama:</label>
                            <input type="text" name="nama" class="form-control" id="nama"
                                value="{{ old('nama') }}">
                            @if ($errors->has('nama'))
                                <div class="text-danger">
                                    {{ $errors->first('nama') }}
                                </div>
                            @endif
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto">Foto:</label>
                            <input type="file" name="foto" class="form-control" id="foto">
                            @if ($errors->has('foto'))
                                <div class="text-danger">
                                    {{ $errors->first('foto') }}
                                </div>
                            @endif
                        </div>
                        <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
