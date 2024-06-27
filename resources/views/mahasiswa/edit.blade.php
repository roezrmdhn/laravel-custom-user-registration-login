@extends('auth.layouts')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit Mahasiswa</div>
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('mahasiswa.update', $mahasiswa->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group mb-3">
                                <label for="nim">NIM</label>
                                <input type="text" name="nim" class="form-control" value="{{ $mahasiswa->nim }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="nama">Nama</label>
                                <input type="text" name="nama" class="form-control" value="{{ $mahasiswa->nama }}"
                                    required>
                            </div>

                            <div class="form-group mb-3">
                                <label for="foto">Foto</label>
                                <input type="file" name="foto" class="form-control">
                                @if ($mahasiswa->foto)
                                    <img src="{{ asset('storage/' . $mahasiswa->foto) }}" alt="{{ $mahasiswa->nama }}"
                                        width="100" class="mt-2">
                                @endif
                            </div>

                            <button type="submit" class="btn btn-primary">Update</button>
                            <a href="{{ route('mahasiswa.index') }}" class="btn btn-secondary">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
