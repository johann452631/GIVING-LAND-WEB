<x-profile.index>
    <div @class(['w-full', 'max-w-2xl' => auth()->check()])>
        <div @class(['max-w-sm min-w-80 md:max-w-xl', 'mx-auto' => !auth()->check()])>
    
            <div class="border-b pb-4">
                <div class="flex py-4 items-center">
                    <img class="size-12 redondo mr-3" src="{{ $profile->getImageUrl() }}" alt="">
    
                    <h2 class="text-2xl">{{ $profile->user->name }}</h2>
                    {{-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ex aspernatur quisquam est omnis sit saepe excepturi temporibus aliquid maxime. Quaerat error nesciunt consectetur veritatis repudiandae hic doloribus autem fugiat consequuntur?</p> --}}
                </div>
                @if (count($profile->socialMedia))
                    <hr>
                    <div class="py-4">
                        <h2 class="text-xl texto-verde mb-2">Redes sociales</h2>
                        <ul class="flex flex-wrap gap-x-3">
                            @foreach ($profile->socialMedia as $item)
                                <a href="{{ $item->url . $item->pivot->username }}" target="_blank"><img class="size-8"
                                        src="{{ asset('socialmediaicons/' . $item->image->url) }}" alt=""></a>
                            @endforeach
                        </ul>
                    </div>
                @endif
                @if (count($profile->contactInformation))
                    <hr>
                    <div class="py-4">
                        <h2 class="text-xl texto-verde">Información de contacto</h2>
                        <ul class="flex flex-col gap-y-3">
                            @foreach ($profile->contactInformation as $item)
                                @if ($item->is_link)
                                    <label>
                                        {{ $item->name . ':' }}
                                        <a target="_blank" class="text-blue-600 cursor-pointer hover:text-blue-400"
                                            href="{{ $item->info }}">{{ $item->info }}</a>
                                    </label>
                                @else
                                    <p>{{ $item->name . ' : ' . $item->info }}</p>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                @endif
                @owner($profile->user->username)
                    <hr class="my-4">
                    <a class="boton-base bg-yellow-300" href="{{ route('profile.edit') }}">Editar perfil</a>
                @endowner
            </div>
    
            {{-- posts --}}
            <div class="mt-8 mb-4">
                @if (count($posts))
                    <h2 class="text-gray-900 text-4xl text-center">Publicaciones</h2>
                    @foreach ($posts as $post)
                        <x-post :$post :username="$profile->user->username" />
                        @push('modals')
                            <x-popup id="popup_post_{{ $post->user_post_index }}" max-width='md'>
                                <x-form ruta-siguiente='posts.destroy' :parametro="$post->user_post_index" metodo="DELETE"
                                    class="p-8 bg-gris-claro rounded-md">
                                    <p>¿Confirmas eliminar la publicación <b>{{ $post->name }}</b>?</p>
                                    <div>
                                        <button type="submit" class="bg-red-600 text-gray-200 boton-base">Confirmar</button>
                                        <button type="button"
                                            class="popup-closer bg-gray-500 text-gray-200 boton-base">Cancelar</button>
                                    </div>
                                </x-form>
                            </x-popup>
                        @endpush
                    @endforeach
                @else
                    <p class="text-2xl font-bold">No has hecho ninguna publicación aún</p>
                @endif
            </div>
        </div>
    </div>
    <script src="{{ asset('js/profile/show.js') }}"></script>
</x-profile.index>
