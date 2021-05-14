<?php

namespace App\Http\Livewire;

use App\Models\Post;
use Livewire\Component;

class EditPost extends Component
{

    public $open = false;
    public $post; 

    protected $rules = [
        'post.title' => 'required',
        'post.content' => 'required'

    ];


    public function mount(Post $post)
    {
        $this->post = $post;
    }// livewire mount



    public function actualizar()
    {
      

    }//actualizar

    public function render()
    {
        return view('livewire.edit-post');
    }//render



}//class
