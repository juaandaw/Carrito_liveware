<div x-data="{open:false}">
    <x-jet-button @click="open = true">Mostrar Filtros</x-jet-button>
    <div class="justify-center" x-show="open">
        Categorias
        <div>
            <select wire:model="selCategoria">
                <option>Elige una categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                @endforeach
            </select>
            <select wire:model="brand_id">
                <option>Elige una marca</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
            <select wire:model="color_id">
                <option>Elige un color</option>
                @foreach($colors as $color)
                    <option value="{{$color->id}}">{{__(ucfirst($color->name))}}</option>
                @endforeach
            </select>
        </div>
        <label for="desde">Precio Desde €</label>
        <input class="w-32" type="text" value="">
        <label for="hasta">Precio Hasta €</label>
        <input class="w-32" type="text" value="">
        <label for="desde">Desde</label>
        <input  class="w-32" type="text" id="datepicker" placeholder="D-M-YYYY">
        <label for="hasta">Hasta</label>
        <input  class="w-32" type="text" id="datepicker2" placeholder="D-M-YYYY">
        <x-jet-button wire:click="filters">Filtrar</x-jet-button>

    </div>
    @if($selCategoria)
        Subcategoria
        <div class="grid grid-cols-1 py-6">
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
<script>
    document.addEventListener("DOMContentLoaded", (event) => {
        var picker = new Pikaday({field: $('#datepicker')[0],
                                    format:'D-M-YYYY'});
        var picker2 = new Pikaday({field: $('#datepicker2')[0],
                                    format:'D-M-YYYY'});
    })
</script>
