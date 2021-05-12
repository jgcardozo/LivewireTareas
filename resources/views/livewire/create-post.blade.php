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
                <x-jet-label>Titulo del Post</x-jet-label>
                <x-jet-input type="text" class="w-full" wire:model="title" />
                <x-jet-input-error for="title" />
            </div>

            <div class="mb-4">
                <x-jet-label>Contenido del Post</x-jet-label>
                <textarea class="form-control w-full" rows="6" wire:model.defer="content"></textarea>
                <x-jet-input-error for="content" />
            </div>

        </x-slot>


        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="save">
                <i class="fas fa-plus-circle mr-2"></i>Crear
            </x-jet-danger-button>
            <span wire:loading wire:target="save">
                Procesando...
            </span>
        </x-slot>

    </x-jet-dialog-modal>


</div>
