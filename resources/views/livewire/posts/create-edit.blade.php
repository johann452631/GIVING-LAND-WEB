<form wire:submit='storeOrUpdate'>
    {{-- @csrf --}}
    <div class="mb-7">
        @csrf
        <div class="w-full">
            <div id="carousel" class="relative overflow-hidden rounded-lg bg-gray-200 h-80">
                @if (!count($imagesUrls))
                    <label id="big_label_images" for="image_input"
                        class="absolute top-0 left-0 w-full h-full grid place-items-center cursor-pointer">
                        <div>
                            <i class="fa-solid fa-image text-6xl"></i>
                            <i class="fa-solid fa-plus text-2xl"></i>
                        </div>
                    </label>
                @endif
                <div id="images_container" class="h-full flex">
                    @foreach ($imagesUrls as $imageName)
                        @if ($loop->index == $currentShownImageIndex)
                            <div class="relative w-full">
                                <div class="flex justify-center items-center h-72">
                                    <img src="{{ asset('storage/' . $imageName) }}" class="max-w-fit"
                                        style="height: 120%;">
                                </div>
                                <i class="fa-solid fa-trash absolute top-2 right-2 bg-red-600 text-white p-2 redondo cursor-pointer"
                                    wire:click="removeImage({{ $loop->index }})"></i>
                            </div>
                        @endif
                    @endforeach
                </div>
                @if (count($this->imagesUrls) > 1 && $this->currentShownImageIndex != array_key_first($this->imagesUrls))
                    <button type="button" id="prevBtn"
                        class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-1 rounded-full"
                        wire:click='showPreviousImage()'>‹</button>
                @endif
                @if (count($this->imagesUrls) > 1 && $this->currentShownImageIndex != array_key_last($this->imagesUrls))
                    <button type="button" id="nextBtn"
                        class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-800 text-white px-3 py-1 rounded-full"
                        wire:click='showNextImage()'>›</button>
                @endif
            </div>
            @error('imagesUrls')
                <p class="text-red-500">*{{ $message }}</p>
            @enderror
            @if (count($this->imagesUrls) > 0 && count($this->imagesUrls) < 5)
                <label id="small_label_images" for="image_input"
                    class="boton-base bg-blue-700 text-white inline-block mt-3">Agregar</label>
            @endif
            <input type="file" accept="image/*" multiple id="image_input" wire:model='inputImages' hidden />
        </div>
        <div class="max-w-96">
            <x-forms.input label-text="Nombre del artículo" name='name' wire:model='name' maxlenght="100"
                wire:input='onInput()' class="mb-6" no-timeout />
            <div class="mb-6">
                <label class="texto-verde text-lg">
                    Propósito de la publicación
                    <select wire:model='purpose' wire:input='onPurposeSelected'
                        class="outline-none rounded border border-gray-400 w-full text-gray-900 cursor-pointer">
                        <option value="" class="text-gray-500">Seleccione el propósito</option>
                        <option value="d" class="text-gray-900">Donación
                        </option>
                        <option value="i" class="text-gray-900">
                            Intercambio</option>
                    </select>
                </label>
                @error('purpose')
                    <p class="text-red-500">*{{ $message }}</p>
                @enderror
            </div>
            @if ($purpose == 'i')
                <x-forms.input label-text="Artículo de interés a recibir" name="expected_item" class="mb-6"
                    wire:model='expected_item' wire:input='onInput()' no-timeout />
            @endif
            <div class="mb-6">
                <label class="texto-verde text-lg">
                    Descripción
                    <textarea class="text-gray-900 text-ellipsis" wire:model='description' wire:input='onInput()' rows="3"></textarea>
                </label>
                @error('description')
                    <p class="text-red-500">*{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-6">
                <label class="texto-verde text-lg">
                    Ubicación
                    <select wire:model='location_id' wire:input='onInput()'
                        class="outline-none rounded border border-gray-400 w-full text-gray-900 cursor-pointer">
                        <option class="text-gray-500" value="">Seleccione una ubicación</option>
                        @foreach ($locations as $location)
                            <option class="text-gray-900" value="{{ $location->id }}">
                                {{ $location->municipio . ' (' . $location->departamento . ')' }}</option>
                        @endforeach
                    </select>
                </label>
                @error('location_id')
                    <p class="text-red-500">*{{ $message }}</p>
                @enderror
            </div>
            <div>
                <label class="texto-verde text-lg">
                    Categoría
                    <select wire:model='category_id' wire:input='onInput()'
                        class="outline-none rounded border border-gray-400 w-full text-gray-900 cursor-pointer">
                        <option value="" class="text-gray-500">Seleccione una categoría</option>
                        @foreach ($categories as $category)
                            <option class="text-gray-900" value="{{ $category->id }}">
                                {{ $category->name }}</option>
                        @endforeach
                    </select>
                </label>
                @error('category_id')
                    <p class="text-red-500">*{{ $message }}</p>
                @enderror
            </div>
        </div>
    </div>
    <div class="flex justify-end">
        <a href="{{($isCreate) ? route('home') : route('profile.show',auth()->user()->username)}}" class="boton-base bg-gray-400 mr-6">Cancelar</a>
        <button type="submit" class="boton-base verde-blanco">
            @if ($isCreate)
                Publicar
            @else
                Guardar
            @endif
        </button>
    </div>
</form>
