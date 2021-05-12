<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Post;


class CreatePost extends Component
{

    public $open = false;
    public $title, $content;

    protected $rules = [
        'title'   => 'required|max:20',
        'content' => 'required|min:30',
    ];

    protected $messages = [
        'title.required' => 'Titulo requerido.',
        'title.max'       => 'Titulo debe ser maximo de 20 caracteres.',
    ];


    public function updated($propiedad)
    {
        $this->validateOnly($propiedad);
    }// updated



    public function save(){

        $this->validate();
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
