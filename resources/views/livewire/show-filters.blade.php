<div x-data="{open:false}">
    <x-jet-button @click="open = true">Mostrar Filtros</x-jet-button>
    <div class="justify-center" x-show="open">
        Categorias
        <div>
            <select wire:model="selCategoria">
                <option value="all" selected>Elige una categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->name}}</option>
                @endforeach
            </select>
            <select wire:model="brand_id">
                <option value="all" selected>Elige una marca</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}">{{$brand->name}}</option>
                @endforeach
            </select>
            <select wire:model="color_id">
                <option value="all" selected>Elige un color</option>
                @foreach($colors as $color)
                    <option value="{{$color->id}}">{{__(ucfirst($color->name))}}</option>
                @endforeach
            </select>
        </div>
        <label  for="desde">Precio Desde €</label>
        <input  class="w-32" type="text" value="">
        <label wire:model="priceFrom" for="hasta">Precio Hasta €</label>
        <input wire:model="priceTo" class="w-32" type="text" value="">
        <div wire:ignore>
            <label for="desde">Desde</label>
            <input   wire:model="from" class="w-32 datepicker" type="text" placeholder="YYYY-M-D">
            <label for="hasta">Hasta</label>
            <input id="date" wire:model="to"  class="w-32 datepicker" type="text" placeholder="YYYY-M-D">
        </div>
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
    document.addEventListener("DOMContentLoaded", () => {
        flatpickr('.datepicker', {
            enableTime: false,
            dateFormat: 'Y-m-d',
            altInput: true,
            altFormat: 'Y-m-d',
            time_24hr: true,
            allowInput: true,
        });
    });
</script>
