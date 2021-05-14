<div>

    <a class="bg-indigo-600 hover:bg-indigo-900 text-white p-2 cursor-pointer  rounded shadow-md m-6"
       wire:click="$set(open, true)">
        <i class="fas fa-pencil-alt "></i>
    </a>

    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">Editar</x-slot>

        <x-slot name="content">
            <div class="mb-4">
                <X-label value="Titulo del post"/>
                <x-jet-input  type="text" class="w-full" wire:model="post.title" />
            </div>


            <div class="mb-4">
                <X-label value="Contenido"/>
                <textarea  rows="6" class="form-control w-full" wire:model="post.content"></textarea>
               
            </div>
        </x-slot>

        <x-slot name="footer">

        </x-slot>

    </x-jet-dialog-modal>


</div>
