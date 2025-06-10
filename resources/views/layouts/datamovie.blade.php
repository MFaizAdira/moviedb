@extends('layouts.template')

@section('content')
    <h2>Data Movie</h2>
    <a href="{{ route('create_movie') }}" class="btn btn-success mb-3">+ Input Movie</a>
    <table class="table table-bordered">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Tahun</th>
                <th>Aktor</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($movies as $movie)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $movie->title }}</td>
                    <td>{{ $movie->category->category_name ?? '-' }}</td>
                    <td>{{ $movie->year }}</td>
                    <td>{{ $movie->actors }}</td>
                    <td>
                        <a href="{{ route('movies.show', $movie->id) }}" class="btn btn-info btn-sm">Show</a>
                        <a href="{{ route('movies.edit', $movie->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus film ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Belum ada data movie.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <div>
        {{ $movies->links() }}
    </div>
@endsection
