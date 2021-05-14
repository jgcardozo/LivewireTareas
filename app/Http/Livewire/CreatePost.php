<?php

namespace App\Http\Livewire;

use Livewire\Component;
use \App\Models\Post;
use Livewire\WithFileUploads;


class CreatePost extends Component
{
    use WithFileUploads;
    
    public $open = false;
    public $title, $content, $photo, $resetFoto;

    public function mount()
    {
        $this->resetFoto = rand();
    } // livewire method

    protected $rules = [
        'title'   => 'required|max:20',
        'content' => 'required|min:10',
        'photo'   => 'required|image|max:2048|mimes:jpg,png',
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


        $imagenRuta = $this->photo->store('posts');

        Post::create([
            'title' => $this->title,
            'content' => $this->content,
            'imagen' => $imagenRuta,
        ]);

        $this->resetFoto = rand();
        $this->reset(['title','content','open', 'photo']);
        //
        $this->emit('alert', 'El post se creo correctamente');
        $this->emitTo('show-posts','render');
    } //save



    public function render()
    {
        return view('livewire.create-post');     
    }


}
