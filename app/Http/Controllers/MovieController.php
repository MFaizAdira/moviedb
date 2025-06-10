<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class MovieController extends Controller
{
    // Tampilkan daftar movie dan pencarian
    public function homePage(Request $request)
    {
        $keyword = $request->input('keyword');

        $query = Movie::query();

        if ($keyword) {
            $query->where('title', 'like', "%{$keyword}%")
                  ->orWhere('actors', 'like', "%{$keyword}%")
                  ->orWhere('synopsis', 'like', "%{$keyword}%");
        }

        $movies = $query->latest()->paginate(6);

        return view('homepage', compact('movies', 'keyword'));
    }

    public function detail($id, $slug)
    {
        $movie = Movie::findOrFail($id);
        return view('movie.detailmovie', compact('movie'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('create_movie', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'synopsis' => 'nullable|string',
            'category_id' => 'required|integer|exists:categories,id',
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $slug = Str::slug($request->title);

        $cover = null;
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image')->store('covers', 'public');
        }

        Movie::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'synopsis' => $validated['synopsis'],
            'category_id' => $validated['category_id'],
            'year' => $validated['year'],
            'actors' => $validated['actors'],
            'cover_image' => $cover,
        ]);

        return redirect('/')->with('success', 'Movie saved successfully');
    }

public function show($id)
{
    $movie = Movie::findOrFail($id);
    return view('movie.detailmovie', compact('movie'));
}

public function edit($id)
{
    $movie = Movie::findOrFail($id);
    $categories = \App\Models\Category::all();
    return view('edit_movie', compact('movie', 'categories'));
}

public function update(Request $request, $id)
{
    $movie = Movie::findOrFail($id);
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'synopsis' => 'nullable|string',
        'category_id' => 'required|integer|exists:categories,id',
        'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
        'actors' => 'required|string',
        'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);
    $movie->update($validated);
    return redirect()->route('movies.show', $movie->id)->with('success', 'Movie updated!');
}
public function datamovie()
{
    $movies = Movie::with('category')->latest()->paginate(10);
    return view('layouts.datamovie', compact('movies'));
}

public function destroy($id)
{
    $movie = Movie::findOrFail($id);
    $movie->delete();
    return redirect()->route('movies.index')->with('success', 'Movie deleted!');
}
}
