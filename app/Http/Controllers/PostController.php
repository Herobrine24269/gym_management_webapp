<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->latest()->get();
        return view('posts.index', compact('posts'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:150',
            'description' => 'required|string',
            'image' => 'nullable|image|max:2048',
        ]);

        $imageUrl = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('posts', 'public');
            $imageUrl = asset('storage/' . $path);
        }

        Post::create([
            'author_id' => auth()->id(),
            'title' => $validated['title'],
            'description' => $validated['description'],
            'image_url' => $imageUrl,
        ]);

        return back()->with('success', 'Announcement post published!');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        return back()->with('success', 'Post deleted.');
    }
}
