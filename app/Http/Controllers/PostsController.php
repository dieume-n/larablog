<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use JD\Cloudder\Facades\Cloudder;
use App\Post;
use App\Http\Controllers\UploadFileController;
use App\Http\Requests\Posts\UpdatePostRequest;

class PostsController extends Controller
{

    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $validatationAttributes = $this->validatePost();

        if ($request->hasFile('image')) {
            $post = new Post;
            $post->title = $validatationAttributes['title'];
            $post->description = $validatationAttributes['description'];
            $post->content = $validatationAttributes['content'];
            list($post->image, $post->image_id, $post->thumbnail) = UploadFileController::upload($request->file('image'));
            if ($request->has('published_at')) {
                $post->published_at = $request->published_at;
            }

            $post->save();
            session()->flash('success', 'Post created successfully');
            return redirect(route('posts.index'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        $data  = $request->only(['title', 'description', 'content', 'published_at']);
        if ($request->hasFile('image')) {
            Cloudder::delete($post->image_id);
            list($post->image, $post->image_id, $post->thumbnail) = UploadFileController::upload($request->file('image'));
        }
        $post->title = $data['title'];
        $post->description = $data['description'];
        $post->content = $data['content'];
        $post->published_at = $data['published_at'];
        $post->update();
        session()->flash('success', 'Post updated successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id', $id)->first();
        if ($post->trashed()) {
            Cloudder::delete($post->image_id);
            $post->forceDelete();
            session()->flash('success', 'Post Deleted successfully');
        } else {
            $post->delete();
            session()->flash('success', 'Post Trashed successfully');
        }

        return redirect(route('posts.index'));
    }

    public function trash()
    {
        $posts = Post::onlyTrashed()->get();
        return view('posts.index', compact('posts'));
    }

    public function validatePost()
    {
        return request()->validate([
            'title' => 'required|unique:posts',
            'description' => 'required',
            'content' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,webp|max:1024'
        ]);
    }
}
