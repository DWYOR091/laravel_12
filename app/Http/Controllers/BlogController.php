<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $req)
    {
        $blogs = Blog::with('tags')->where('title', 'like', '%' . $req->title . '%')->orderBy('id', 'desc')->get();
        return view('blog.index', ['blogs' => $blogs]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tags = Tag::all();
        return view('blog.tambah', ['tags' => $tags]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // return $request->tags;
        $blog = Blog::create(
            [
                'title' => $request->title,
                'description' => $request->description
            ]
        );
        $blog->tags()->attach($request->tags); //attach menambahkan banyak
        return redirect()->route('blog.index')->with('success', "Data <strong>" . $request->title . "</strong> Sudah Tersimpan!");
    }

    /**
     * Display the specified resource.
     */
    public function show(Blog $blog)
    {
        $blog = $blog->with(['comments', 'tags'])->find($blog->id);
        // dd($blog);
        // return $blog;
        return view('blog.detail', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Blog $blog)
    {
        $blog->load('tags');
        $tags = Tag::all();
        // $blog = $blog->with('tags')->find($blog->id);
        //eager loading

        // return $blog
        return view('blog.update', ['blog' => $blog, 'tags' => $tags]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Blog $blog)
    {
        $validateData = $request->validate([
            'title' => 'required|max:30',
            'description' => 'required',
        ]);

        //detach artinya hapus, aattach artinya tambahin untuk relasi !!
        // $blog->tags()->detach($blog->tags);
        // $blog->tags()->attach($request->tags);

        //pake sync lebih fleksibel
        $blog->tags()->sync($request->tags);
        $blog->update($validateData);

        return redirect()->route('blog.index')->with('success', "Data <strong>" . $request->title . "</strong> Sudah Terupdate!");
    }

    /**
     * Remove the specified resource from storage.  
     */
    public function destroy(Blog $blog)
    {
        $blog->delete();
        return redirect()->route('blog.index');
    }
}
