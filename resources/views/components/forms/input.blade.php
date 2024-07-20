@props([
    'name' => null,
    'labelText' => '',
    'isRequired' => false,
    'divId' => null,
    'noTimeout' => false,
])
<div {{ $attributes->whereStartsWith('class')->class(['div-form-input']) }}
    @isset($divId)
    id="{{ $divId }}"
@endisset>
    <label class="texto-verde text-lg">
        <span @class(['text-red-600', 'hidden' => !$isRequired])>*</span> {{ $labelText }}
        {{-- <br> --}}
        <input class="w-full pt-2 pl-1 mb-1 text-base text-gray-900" {{ $attributes->whereDoesntStartWith('class') }}
            @isset($name)
                name="{{$name}}"
                value="{{old($name)}}"
            @endisset>
    </label>
    @isset ($name)
        @error($name)
            <span @class(['text-red-500', 'input-error' => !$noTimeout])>* {{ $message }}</span>
        @enderror
    @endisset
    @if ($slot->hasActualContent())
        {{ $slot }}
    @endif
</div>
