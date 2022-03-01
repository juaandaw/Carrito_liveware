<div x-data="{open:false}">
    <x-jet-button @click="open = true">Mostrar Filtros</x-jet-button>
    <div x-show="open">
        Categorias
        <select wire:model="selCategoria">
            <option>Elige una categoria</option>
            @foreach($categorias as $categoria)
                <option value="{{$categoria->id}}">{{$categoria->name}}</option>
            @endforeach
        </select>
    </div>
    @if($selCategoria)
        <div class="grid py-6">
            Subcategoria
            @foreach($subcategoria as $sub)
                <div class="form-check">
                    <input wire:model="subcategory_id" class="form-check-input appearance-none h-4 w-4 border border-gray-300 rounded-sm bg-white checked:bg-blue-600 checked:border-blue-600 focus:outline-none transition duration-200 mt-1 align-top bg-no-repeat bg-center bg-contain float-left mr-2 cursor-pointer" type="checkbox" value="{{$sub->id}}" id="flexCheckChecked">
                    <label class="form-check-label inline-block text-gray-800" for="flexCheckChecked">
                        {{$sub->name}}
                    </label>
                </div>
            @endforeach
            @endif
        </div>
</div>
