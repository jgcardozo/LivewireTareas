<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Post;
use Livewire\WithFileUploads;

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
        $this->post = $post;
        $this->open = true;
        $this->title = $post->title;
        $this->content = $post->content; 
        
        
    }




} //class
