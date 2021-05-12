<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Post;

class CreatePost extends Component
{

    public $open = false;
    public $title, $content;

    public function save(){
        Post::create([
            'title' => $this->title,
            'content' => $this->content,
        ]);

        $this->reset(['title','content','open']);

        //
        $this->emit('alert', 'El post se creo correctamente');
        $this->emitTo('show-posts','render');
    } //save


    public function render()
    {
        return view('livewire.create-post');     
    }


}
