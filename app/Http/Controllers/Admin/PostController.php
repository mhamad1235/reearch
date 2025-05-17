<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index()
{
    $lang = app()->getLocale(); // e.g., 'en' or 'ku'

    $posts = Post::all()->map(function ($post) use ($lang) {
        return (object)[
            'id' => $post->id,
            'name' => $post->{'name_' . $lang} ?? '',
            'description' => $post->{'description_' . $lang} ?? '',
            'image' => $post->image,
        ];
    });

    return view('posts.index', compact('posts', 'lang'));
}


    public function create()
    {
       return view('posts.create', ['post' => null]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_en' => 'required|string|max:255',
            'description_en' => 'nullable|string',
            'name_ku' => 'required|string|max:255',
            'description_ku' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $imagePath = null;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('assets/images'), $imageName);
            $imagePath = 'assets/images/' . $imageName;
        }

        Post::create([
            'image' => $imagePath,
            'name_en' => $request->input('name_en'),
            'description_en' => $request->input('description_en'),
            'name_ku' => $request->input('name_ku'),
            'description_ku' => $request->input('description_ku'),
        ]);

        return redirect()->route('posts.index')->with('success', 'Post created successfully.');
    }



   public function edit($id)
{
    $post = Post::findOrFail($id);
    return view('posts.edit', compact('post'));
}

    public function update(Request $request, Post $post)
{
    $request->validate([
        'name_en' => 'required|string|max:255',
        'description_en' => 'nullable|string',
        'name_ku' => 'required|string|max:255',
        'description_ku' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('assets/images'), $imageName);
        $post->image = 'assets/images/' . $imageName;
    }

    $post->name_en = $request->input('name_en');
    $post->description_en = $request->input('description_en');
    $post->name_ku = $request->input('name_ku');
    $post->description_ku = $request->input('description_ku');

    $post->save();

    return redirect()->route('posts.index')->with('success', 'Post updated successfully.');
}

public function destroy($id)
{
    $post = Post::findOrFail($id);

    // Optionally delete image file
    if ($post->image && file_exists(public_path($post->image))) {
        unlink(public_path($post->image));
    }

    $post->delete();

    return redirect()->route('posts.index')->with('success', 'Post deleted successfully.');
}

}
