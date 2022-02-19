<x-app-layout>
    <div class="container-menu py-8">
        <figure class="mb-4">
            <img class="w-full h-80 object-cover object-center" src="{{\Illuminate\Support\Facades\Storage::url($category->image)}}" alt="">
        </figure>

        @livewire('categories-filter', ['categories' => $category])
    </div>
</x-app-layout>
