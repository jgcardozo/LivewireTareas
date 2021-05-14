<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;


class ShowPosts extends Component
{
    use WithFileUploads;

    

    public $search;
    public $sort = 'id';
    public $direction = 'desc';
    protected $listeners = ['render'];
    //fin show variables
    public $open = false;
    public $title, $content, $photo, $resetFoto;
    public $post;
    //
    public $view = "create";


    protected $rules = [
        'title'   => 'required|max:20',
        'content' => 'required|min:10',
        'photo'   => 'required|image|max:2048|mimes:jpg,png',
    ];

    public function mount()
    {
        $this->resetFoto = rand();
        $this->post = new Post();
   
    } // livewire method


    public function render()
    {
        $posts = Post::where('title', 'like', '%'.$this->search.'%')
                       ->orWhere('content', 'like', '%'.$this->search.'%')
                       ->orderBy($this->sort, $this->direction)
                       ->get();
        return view('livewire.show-posts', compact('posts'));
    }//render


    public function order($sort)
    {

        if($this->sort==$sort){

            if($this->direction=='desc'){
                $this->direction='asc';
            }else{
                $this->direction='desc';
            }

        }else{

            $this->sort = $sort;
            $this->direction = 'asc';
        }

    }//sort


    public function edit(Post $post)
    {
        //dd($post);
        $this->view = "update";
        $this->post = $post;
        $this->open = true;
        $this->title = $post->title;
        $this->content = $post->content; 
        
        
    }//edit


    public function update()
    {

        $this->validate();

        $this->post->title   = $this->title;
        $this->post->content = $this->content;
    
        if($this->photo){
            Storage::delete([$this->post->photo]);
            $this->post->imagen = $this->photo->store('posts');
        }
        $this->post->save();

        $this->resetFoto = rand();
        $this->reset(['title','content','open', 'photo']);
        $this->emit('alert', 'El post se actualizo correctamente');
    }//update




} //class
