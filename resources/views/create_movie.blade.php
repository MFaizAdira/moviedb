@extends('layouts.template')

@section('content')
<div class="container">
    <h2>Tambah Movie</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('movies.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Judul</label>
            <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label for="synopsis" class="form-label">Sinopsis</label>
            <textarea name="synopsis" class="form-control">{{ old('synopsis') }}</textarea>
        </div>

        <div class="mb-3">
    <label for="category_id" class="form-label">Kategori</label>
    <select name="category_id" class="form-control" required>
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $category)
            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                {{ $category->category_name }}
            </option>
        @endforeach
    </select>
</div>


        <div class="mb-3">
            <label for="year" class="form-label">Tahun</label>
            <input type="number" name="year" class="form-control" required value="{{ old('year') }}">
        </div>

        <div class="mb-3">
            <label for="actors" class="form-label">Aktor</label>
            <input type="text" name="actors" class="form-control" value="{{ old('actors') }}">
        </div>

        <div class="mb-3">
            <label for="cover_image" class="form-label">Gambar Poster</label>
            <input type="file" name="cover_image" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection
