<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Post
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 ">

        <x-table>

            <div class="px-6 py-4 flex items-center">
                <x-jet-input class="flex-1 mr-4" type="text" wire:model="search" placeholder="Buscar.." />
                @livewire('create-post')
            </div>

            @if ($posts->count())
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col"
                                class="w-24 cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('id')">
                                ID
                                @if ($sort == 'id')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('title')">
                                Title
                                @if ($sort == 'title')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif

                            </th>
                            <th scope="col"
                                class="cursor-pointer px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider"
                                wire:click="order('content')">
                                Content
                                @if ($sort == 'content')
                                    @if ($direction == 'asc')
                                        <i class="fas fa-sort-alpha-up-alt float-right"></i>
                                    @else
                                        <i class="fas fa-sort-alpha-down-alt float-right"></i>
                                    @endif

                                @else
                                    <i class="fas fa-sort float-right"></i>
                                @endif
                            </th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only">Edit</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach ($posts as $itemPost)
                            <tr>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $itemPost->id }}</div>

                                </td>
                                <td class="px-6 py-4 ">
                                    <div class="text-sm text-gray-900">{{ $itemPost->title }}</div>
                                </td>
                                <td class="px-6 py-4  text-sm text-gray-500">
                                    <div class="text-sm text-gray-900">{{ $itemPost->content }}</div>
                                </td>
                                <td class="px-6 py-4   text-sm font-medium">

                                    {{-- @livewire('edit-post', ['post' => $post], key($post->id) ) --}}
                                    <a class="bg-indigo-600 hover:bg-indigo-900 text-white p-2 cursor-pointer  rounded shadow-md m-6"
                                        wire:click="edit({{ $itemPost }})">
                                        <i class="fas fa-pencil-alt "></i>
                                    </a>

                                </td>
                            </tr>
                        @endforeach

                        <!-- More people... -->
                    </tbody>
                </table>
            @else
                <div class="px-6 py-4 ">
                    Ningun registro coincide con <b>{{ $search }}</b>
                </div>
            @endif

        </x-table>

    </div>




    <x-jet-dialog-modal wire:model="open">

        <x-slot name="title">Editar</x-slot>

        <x-slot name="content">

            <div class="mb-4">
                 @if ($photo)
                    <img src="{{ $photo->temporaryUrl() }}">
                @else
                    <img src="{{ Storage::url($post->imagen) }}">
                @endif
 

                <div wire:loading wire:target="photo"
                    class="w-full p-2 bg-indigo-800 items-center text-indigo-100 leading-none lg:rounded-full flex lg:inline-flex"
                    role="alert">
                    <span class="flex rounded-full bg-indigo-500 uppercase px-2 py-1 text-xs font-bold mr-3">Imagen
                        cargando...</span>
                    <span class="font-semibold mr-2 text-left flex-auto">espere por favor, hasta que se muestre la
                        imagen</span>
                </div>
            </div>

            <div class="mb-4">
                <X-label value="Titulo del post" />
                <x-jet-input type="text" class="w-full" wire:model="title" />
            </div>


            <div class="mb-4">
                <X-label value="Contenido" />
                <textarea rows="6" class="form-control w-full" wire:model="content"></textarea>

            </div>


            <div class="mb-4">
                <x-jet-input type="file" class="w-full form-control" wire:model="photo" id="{{ $resetFoto }}" />
                <x-jet-input-error for="photo" />
            </div>

        </x-slot>


        <x-slot name="footer">
            <x-jet-secondary-button wire:click="$set('open',false)">Cancelar</x-jet-secondary-button>
            <x-jet-danger-button wire:click="save" wire:target="save, photo" wire:loading.attr="disabled"
                class="disabled:opacity-25">
                <i class="fas fa-plus-circle mr-2"></i>view
            </x-jet-danger-button>
            <span wire:loading wire:target="save">
                Procesando...
            </span>
        </x-slot>


    </x-jet-dialog-modal>

</div>
