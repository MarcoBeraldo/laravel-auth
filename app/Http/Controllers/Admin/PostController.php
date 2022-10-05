<?php

namespace App\Http\Controllers\Admin;

use App\Models\Post;
use App\Models\Tag;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $posts = Post::orderBy('updated_at', 'DESC')
      ->orderBy('created_at', 'DESC')
      ->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $post = new Post();
        $categories = Category::select('id', 'label')->get();
        $tags = Tag::select('id', 'label')->get();
        
        return view('admin.posts.create', compact('post', 'categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|min:5|max:50|unique:posts',
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',
        ],[
            'title.required'=> 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve avre almeno :min caratteri',
            'title.max' => 'Il titolo deve avre almeno :max caratteri',
            'title.unique' => "Esiste già un post dal titolo $request->title",
            'content.required' => 'Devi inserire il contentuto del post',
            'image.url' => 'Url dell\'immagine non valido',
            'category_id'=>'nullable|exists:categories,id',
            'tags.exists'=> 'Uno dei tag non è valido',
        ]); 


        $data = $request->all();

        $post = new Post();        

        $post->fill($data);

        $post->slug = Str::slug($post->title, '-');

        $post->user_id = Auth::id();

        $post->save();

        if(array_key_exists('tags', $data)){
            $post->tags()->attach($data['tags']);
        }

        return redirect()->route('admin.posts.show', $post)
        ->with('message', "Post creato con successo")
        ->with('type', 'success');
    }

    /**
     * Display the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        return view('admin.posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //controllo che sia l'autore, se non lo è ridirigo sulla index
        if($post->user_id !== Auth::id()){
            return redirect()->route('admin.posts.index')
            ->with('message', 'Non sei Autorizzato a modificare questo post')
            ->with('type', 'warning');
        }
        $tags = Tag::select('id', 'label')->get();
        $categories = Category::select('id', 'label')->get();
        $prev_tags = $post->tags->pluck('id')->toArray();
        return view('admin.posts.edit', compact('post','categories','tags', 'prev_tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {

        $request->validate([
            'title' => ['required','string','min:5','max:50', Rule::unique('posts')->ignore($post->id)],
            'content' => 'required|string',
            'image' => 'nullable|url',
            'category_id'=>'nullable|exists:categories,id',
            'tags'=>'nullable|exists:tags,id',

        ],[
            'title.required'=> 'Il titolo è obbligatorio',
            'title.min' => 'Il titolo deve avre almeno :min caratteri',
            'title.max' => 'Il titolo deve avre almeno :max caratteri',
            'title.unique' => "Esiste già un post dal titolo $request->title",
            'content.required' => 'Devi inserire il contentuto del post',
            'image.url' => 'Url dell\'immagine non valido',
            'category_id.exists'=> 'Categoria inesistente',
            'tags.exists'=> 'Uno dei tag non è valido',

        ]); 


        $data = $request->all();

        $data['slug'] = Str::slug($data['title'], '-');
              
        
        $post->update($data);  
        
        if(array_key_exists('tags', $data)) $post->tags()->sync($data['tags']);
        else $post->tags()->sync([]);

        return redirect()->route('admin.posts.show', $post)
        ->with('message', "Post modificato con successo")
        ->with('type', 'success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Post $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        
        return redirect()->route('admin.posts.index')
        ->with('message', 'Il post è stato eliminato con successo')
        ->with('type', 'success');
    }
}
