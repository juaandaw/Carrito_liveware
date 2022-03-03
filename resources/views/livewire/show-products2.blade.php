<div x-data="{open:false}">
    <x-slot name="header">
        <div class="flex items-center">
            <h2 class="font-semibold text-xl text-gray-600">
                Lista de productos
            </h2>

            <x-button-link class="ml-auto" href="{{route('admin.products.create')}}">
                Agregar producto
            </x-button-link>
        </div>
    </x-slot>
    <div>
        <div class="flex justify-center py-12" x-show="open" x-cloak>
            <div class="grid grid-cols-6">
                @foreach($columnas as $columna)
                    <label for="{{$columna}}">{{$columna}}</label>
                    <input type="checkbox" value="{{$columna}}" wire:model="columnaCheck">
                @endforeach
            </div>
        </div>
    </div>
    <x-table-responsive>
        <div class="px-6 py-4">
            <x-jet-input class="w-full" wire:model="search" type="text" placeholder="Introduzca el nombre del producto a buscar"/>
        </div>
<div>
    @include('compartido._filters')
</div>
        <x-jet-button @click="open = true">Mostrar/Ocultar</x-jet-button>
        <select wire:model="per_page">
            @foreach([10,20,30,50] as $per_page)
                <option value="{{$per_page}}">{{$per_page}}</option>
            @endforeach
        </select>

        @if($products->count())
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                <tr>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider {{in_array('Nombre',$columnaCheck) ? 'block' : 'hidden'}}">Nombre</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Categoria',$columnaCheck) ? 'block' : 'hidden'}}>Categoria</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Subcategoria',$columnaCheck) ? 'block' : 'hidden'}}>Subcategoria</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Marca',$columnaCheck) ? 'block' : 'hidden'}}>Marca</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Fecha de creacion',$columnaCheck) ? 'block' : 'hidden'}}>Fecha de creacion</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Color',$columnaCheck) ? 'block' : 'hidden'}}>Color</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Stock',$columnaCheck) ? 'block' : 'hidden'}}>Stock</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Estado',$columnaCheck) ? 'block' : 'hidden'}}>Estado</th>
                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider" {{in_array('Precio',$columnaCheck) ? 'block' : 'hidden'}}>Precio</th>
                    <th scope="col" class="relative px-6 py-3">
                        <span class="sr-only">Editar</span>
                    </th>
                </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                @foreach($products as $product)
                    <tr>
                        @if(in_array('Nombre',$columnaCheck))
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 object-cover">
                                        <img class="h-10 w-10 rounded-full" src="{{$product->images->count() ? Storage::url($product->images->first()->url) :
                                'img/default.jpg'}}" alt="">
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{$product->name}}
                                        </div>
                                    </div>
                                </div>
                            </td>
                        @endif
                        @if(in_array('Categoria',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->subcategory->category->name}}</div>
                                </td>
                        @endif
                            @if(in_array('Subcategoria',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->subcategory->name}}</div>
                                </td>
                            @endif
                            @if(in_array('Marca',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->brand->name}}</div>
                                </td>
                            @endif
                            @if(in_array('Fecha de creacion',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->created_at}}</div>
                                </td>
                            @endif
                        @if(in_array('Color',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($product->subcategory->size && $product->subcategory->color)
                                        @foreach($product->sizes as $size)
                                            <div class="font-bold">
                                            {{$size->name}}
                                            </div>
                                            @foreach($size->colors as $color)
                                                <div>
                                                    {{__(ucfirst($color->name))}}
                                                </div>
                                            @endforeach
                                        @endforeach
                                    @elseif($product->subcategory->color)
                                        @foreach($product->colors as $colors)
                                            {{__(ucfirst($colors->name))}}
                                        @endforeach
                                    @else
                                        No tiene color
                                    @endif
                                </td>
                        @endif
                            @if(in_array('Stock',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{$product->stock ?: "No tiene stock"}}</div>
                                </td>
                            @endif
                        @if(in_array('Estado',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap">
                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-{{$product->status == 1 ? 'red' : 'green'}}-100 text-{{$product->status == 1 ? 'red' : 'green'}}-800">
                    {{$product->status == 1 ? 'Borrador' : 'Publicado'}}
                    </span>
                                </td>
                        @endif
                            @if(in_array('Precio',$columnaCheck))
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{$product->price}} &euro;</td>
                            @endif
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{route('admin.products.edit',$product)}}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @else
            <div class="px-6 py-4">
                No existen productos coincidentes
            </div>
        @endif
        @if($products->hasPages())
            <div class="px-6 py-4">
                {{$products->links()}}
            </div>
        @endif
    </x-table-responsive>
</div>

