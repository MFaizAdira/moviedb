<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function homePage()
    {
        $movies = Movie::latest()->paginate(6);
        return view('homepage', compact('movies'));
    }

    public function detail($id, $slug)
    {
        $movie = Movie::find($id);
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
            'category_id' => 'required|integer|exists:categories,id', // ✅ integer & harus ada di tabel categories
            'year' => 'required|digits:4|integer|min:1900|max:' . date('Y'),
            'actors' => 'required|string',
            'cover_image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // ✅ typo: cover_image bukan coverimage
        ]);

        $slug = Str::slug($request->title); // ✅ typo: $sluq → $slug

        $cover = null;
        if ($request->hasFile('cover_image')) {
            $cover = $request->file('cover_image')->store('covers', 'public'); // ✅ typo: cover_imave → cover_image, publik → public
        }

        Movie::create([
            'title' => $validated['title'],
            'slug' => $slug, // ✅ typo: sluq → slug
            'synopsis' => $validated['synopsis'],
            'category_id' => $validated['category_id'],
            'year' => $validated['year'],
            'actors' => $validated['actors'],
            'cover_image' => $cover,
        ]);

        return redirect('/')->with('success', 'Movie Saved Successfully'); // ✅ typo: succes → success
    }
}
