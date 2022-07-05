<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Post;
use Orchid\Attachment\File;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return response(view('pages.dashboard.posts.create'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        $data = $request->all(['title', 'slug', 'content']);

        $post = Post::create($data);

        // assign post to user
        $post->author()->associate(auth()->user());
        $post->save();

        if ($request->has('categories')) {
            $post->categories()->sync($request->input('categories'));
        }

        if ($request->hasFile('thumbnail')) {
            $file       = new File($request->file('thumbnail'));
            $attachment = $file->load();

            $post->thumbnail = $attachment->id;
        }

        $post->save();

        return redirect()->route('dashboard');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function show(string $slug)
    {
        $post = Post::where('slug', $slug)->first();

        abort_if(is_null($post), 404);

        return response(view('blog.post', ['post' => $post]));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return response(view('pages.dashboard.posts.edit', ['post' => $post]));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $post->update($request->all(['title', 'slug', 'content']));

        if ($request->has('categories')) {
            $post->categories()->sync($request->input('categories'));
        }

        if ($request->hasFile('thumbnail')) {
            $file       = new File($request->file('thumbnail'));
            $attachment = $file->load();

            $post->thumbnail = $attachment->id;
        }

        $post->save();

        return back()->with('message', "The post '{$post->title}' has been successfully updated.");;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Post $post
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
    }
}
