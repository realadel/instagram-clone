<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userFollowingIds = auth()->user()->following()->wherePivot('accepted', true)->get()->pluck('id');
        $posts = Post::whereIn('user_id', $userFollowingIds)->latest()->get();
        $suggested_users = auth()->user()->suggested_users();
        return view('posts.index', compact(['posts', 'suggested_users']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'image' => ['required', 'image', 'mimes:png,jpg,gif,jpeg'],
            'description' => ['required', 'string']
        ]);

        $image = $request['image']->store('posts', 'public');
        $data['image'] = $image;
        $data['slug'] = Str::random(10);
        auth()->user()->posts()->create($data);
        return redirect()->route('post.show', $data['slug']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Post $post)
    {
        $data = $request->validate([
           'image' => ['nullable', 'image', 'mimes:png,jpg,gif,jpeg'],
            'description' => ['required', 'string']
        ]);

        if ($request->has('image')){
            $imageSrc = $request['image']->store('posts', 'public');
            $data['image'] = $imageSrc;
            Storage::delete('public/' . $post->image); // Delete old image
        }
        $post->update($data);
        return redirect()->route('post.show', $post->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        Storage::delete('public/' . $post->image);
        $post->delete();
        return redirect()->route('dashboard');
    }

    public function explore()
    {
        $posts = Post::whereRelation('owner', 'isPrivate', '=', 0)
            ->whereNot('user_id', auth()->id())->select('image')
            ->paginate(12);
        return view('posts.explore', compact('posts'));
    }
}
