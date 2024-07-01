<x-app-layout>
    <form method="POST" action="{{ isset($product) ? route('product.update', $product->id) : route('product.store') }}">
        @csrf

        <!-- If editing, add method spoofing -->
        @if(isset($product))
        @method('PUT')
        @endif

        <!-- Title -->
        <div>
            <x-input-label for="product-title" :value="__('title')" />
            <x-text-input id="product-title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($product) ? $product->title : '')" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="product-description" :value="__('description')" />
            <x-text-input id="product-description" class="block mt-1 w-full" type="text" name="description" :value="old('description', isset($product) ? $product->description : '')" required autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Price -->
        <div>
            <x-input-label for="product-price" :value="__('price')" />
            <x-text-input id="product-price" class="block mt-1 w-full" type="text" name="price" :value="old('price', isset($product) ? $product->price : '')" required autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <!-- image -->
        <div>
            <x-input-label for="product-image" :value="__('image')" />
            <x-text-input id="product-image" class="block mt-1 w-full" type="text" name="image" :value="old('image', isset($product) ? $product->image : '')" required autocomplete="image" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ isset($product) ? __('Update') : __('Create') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Delete Button -->
    @if(isset($product))
    <form method="POST" action="{{ route('product.destroy', $product->id) }}">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this product?');">
            {{ __('Delete') }}
        </x-danger-button>
    </form>
    @endif
</x-app-layout>