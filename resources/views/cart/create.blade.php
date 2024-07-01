<x-app-layout>
    <form method="POST" action="{{ isset($cart) ? route('cart.update', $cart->id) : route('cart.store') }}">
        @csrf

        <!-- If editing, add method spoofing -->
        @if(isset($cart))
        @method('PUT')
        @endif

        <!-- Title -->
        <div>
            <x-input-label for="cart-title" :value="__('title')" />
            <x-text-input id="cart-title" class="block mt-1 w-full" type="text" name="title" :value="old('title', isset($cart) ? $cart->title : '')" required autofocus autocomplete="title" />
            <x-input-error :messages="$errors->get('title')" class="mt-2" />
        </div>

        <!-- Description -->
        <div>
            <x-input-label for="cart-description" :value="__('description')" />
            <x-text-input id="cart-description" class="block mt-1 w-full" type="text" name="description" :value="old('description', isset($cart) ? $cart->description : '')" required autocomplete="description" />
            <x-input-error :messages="$errors->get('description')" class="mt-2" />
        </div>

        <!-- Price -->
        <div>
            <x-input-label for="cart-price" :value="__('price')" />
            <x-text-input id="cart-price" class="block mt-1 w-full" type="text" name="price" :value="old('price', isset($cart) ? $cart->price : '')" required autocomplete="price" />
            <x-input-error :messages="$errors->get('price')" class="mt-2" />
        </div>
        <!-- image -->
        <div>
            <x-input-label for="cart-image" :value="__('image')" />
            <x-text-input id="cart-image" class="block mt-1 w-full" type="text" name="image" :value="old('image', isset($cart) ? $cart->image : '')" required autocomplete="image" />
            <x-input-error :messages="$errors->get('image')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button class="ms-4">
                {{ isset($cart) ? __('Update') : __('Create') }}
            </x-primary-button>
        </div>
    </form>
    <!-- Delete Button -->
    @if(isset($cart))
    <form method="POST" action="{{ route('cart.destroy', $cart->id) }}">
        @csrf
        @method('DELETE')
        <x-danger-button class="mt-4" onclick="return confirm('Are you sure you want to delete this cart?');">
            {{ __('Delete') }}
        </x-danger-button>
    </form>
    @endif
</x-app-layout>