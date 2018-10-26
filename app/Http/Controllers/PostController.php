<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('photo')){
            $request->validate([
                'photo' => 'mimes:jpeg,png'
            ]);
            $path = request()->file('photo')->store('public/Gallery');
            $paths = explode('/', $path);
            $realPath=$paths[1] . '/' . $paths[2];
            $post = new Post();
            $post->photo=$realPath;
            $post->id_user = auth('api')->user()->id;
            $post->id_Family = auth('api')->user()->id_family;
            $post->legend = $request->legend;
            if($post->save()){
                return json_encode(['success'=>'Photo updated']);
            };
        }
        else return json_encode(['error'=>'Not updateddd']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $post=Post::find($request->post);
        return json_encode($post);
    }

}
