<div>
    <x-jet-danger-button wire:click="$set('open', true)">
        <i class="fas fa-plus-circle mr-2"></i>
        Crear Post
    </x-jet-danger-button>


    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">
            Nuevo Post
        </x-slot>

        <x-slot name="content">

            <div class="mb-4">
                @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}">
                @endif
               
           
                <div wire:loading wire:target="photo" class="w-full p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex" role="alert">
                    <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">Imagen cargando...</span>
                    <span class="font-semibold mr-2 text-left flex-auto">espere por favor, hasta que se muestre la imagen</span>
                  </div>
            </div>

            <div class="mb-4">
                <x-jet-label>Titulo del Post</x-jet-label>
                <x-jet-input type="text" class="w-full" wire:model="title" />
                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label>Contenido del Post</x-jet-label>
                <textarea class="form-control w-full" rows="6" wire:model.defer="content"></textarea>
                <x-jet-input-error for="content" />
            </div>

            <div class="mb-4">
                <x-jet-input type="file" class="w-full form-control" wire:model="photo" id="{{$resetFoto}}" />
                <x-jet-input-error for="photo"  />
            </div>

        </x-slot>


        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="save"  wire:target="save, photo" wire:loading.attr="disabled" class="disabled:opacity-25" >
                <i class="fas fa-plus-circle mr-2"></i>Crear
            </x-jet-danger-button>
            <span wire:loading wire:target="save">
                Procesando...
            </span>
        </x-slot>

    </x-jet-dialog-modal>


</div>
