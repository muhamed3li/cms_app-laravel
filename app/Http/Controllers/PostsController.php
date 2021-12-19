<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Categorie;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;


class PostsController extends Controller
{
  public function __construct()
  {
      $this->middleware('checkCategory')->only('create');
  }


  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  
  public function index()
  {
    return view('posts.index',['posts'=>Post::all()]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    
    return view('posts.create',['categories'=>Categorie::all(),'tags'=> Tag::all()]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(PostRequest $request)
  {

    // dd($request->all());
    $post = Post::create([
      'title' => $request->title,
      'description' => $request->description,
      'content' => $request->content,
      'image' => $request->image->store('images', 'public'),
      'category_id'=>$request->categoryId,
    ]);
    if ($request->tags) {
      $post->tags()->attach($request->tags);
    }
    session()->flash('success', 'Post created successfuly');
    return redirect(route('posts.index'));
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
    return view('posts.create',['post' => $post , 'categories' => Categorie::all(),'tags'=>Tag::all()]);
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
    $data = $request->only(['title','description','content']);
    if($request->hasFile('image')){
      $image = $request->image->store('images','public');
      Storage::disk('public')->delete($post->image);
      $data['image'] = $image;
    }
    if($request->tags){
      $post->tags()->sync($request->tags);
    }
    $post->update($data);
    session()->flash('success','Post Updated successfuly');
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
    // $post->delete();
    // session()->flash('success','Post Deleted successfuly');
    // return redirect(route('posts.index'));
    $post = Post::withTrashed()->where('id', $id)->first();
    
    if ($post->trashed()) 
    {
      Storage::disk('public')->delete($post->image);
      $post->forceDelete();
      session()->flash('success','Post Deleted successfuly');
      return redirect(route('posts.index'));
    } 
    else 
    {
      $post->delete();
      session()->flash('success','Post Trashed successfuly');
      return redirect(route('posts.index'));
    }
  }

  public function trashed()
  {
    $trashed = Post::onlyTrashed()->get();
    return view('posts.index')->with('posts',$trashed); //===> mean: with->('trashed',$trashed)
  }
  
    public function restore($id) {
      Post::onlyTrashed()->where('id', $id)->restore();
      session()->flash('success', 'post restored successfully');
      return redirect(route('posts.index'));
    }
  }
