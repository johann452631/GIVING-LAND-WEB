<div class="posts w-full px-4">
    @foreach ($posts as $post)
        <div class="rounded bg-gris-claro shadow-md w-64 mx-auto">
            <div class="relative w-full h-52 overflow-y-hidden" data-carousel="static">

                <!-- Carousel wrapper -->
                <div class="relative overflow-hidden rounded-lg h-56">
                    @foreach ($post->images as $image)
                        <div class="hidden duration-700 ease-in-out" data-carousel-item>
                            <img src="{{ asset('storage/posts_images/' . $post->user->username . '/' . $image->url) }}"
                                class="absolute block w-full md:top-1/2 md:-translate-y-1/2 -translate-x-1/2  left-1/2"
                                alt="...">
                        </div>
                    @endforeach
                </div>
                @auth
                    <div class="absolute top-0 left-0 z-30 m-2">
                        <livewire:favorites.favorite-button :post-id='$post->id' />
                    </div>
                @endauth
                @if (count($post->images) > 1)
                    <!-- Slider controls -->
                    <button type="button"
                        class="absolute top-1/2 start-0 z-30 flex items-center justify-center p-4 cursor-pointer group focus:outline-none"
                        data-carousel-prev>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M5 1 1 5l4 4" />
                            </svg>
                            <span class="sr-only">Previous</span>
                        </span>
                    </button>
                    <button type="button"
                        class="absolute top-1/2 z-30 end-0 flex items-center justify-center p-4 cursor-pointer group focus:outline-none"
                        data-carousel-next>
                        <span
                            class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                            <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <span class="sr-only">Next</span>
                        </span>
                    </button>
                @endif
            </div>
            @auth
                <div class="dropdown relative z-30">
                    <i
                        class="fa-solid fa-ellipsis absolute right-0 top-1 text-lg leading-none bg-gray-300 rounded-md px-2 cursor-pointer dropdown-button"></i>
                    <div
                        class="dropdown-menu absolute right-0 my-2 w-56 top-full z-30 rounded-md bg-white shadow-lg hidden">
                        <div class="py-1">
                            <a href="#" class="text-gray-700 block px-4 py-2 text-sm hover:bg-gray-100">Reportar</a>
                            <hr>
                        </div>
                    </div>
                </div>
            @endauth
            <div class="px-3 py-4 relative z-20">
                <a href="{{route('user.posts.show',[$post->user->username,$post->user_post_index])}}" class="text-gray-800 text-xl font-semibold mb-2 w-full block">{{ $post->name }}</a>
                <span class="texto-verde font-semibold text-lg capitalize">{{ $post->getPurpose() }}</span>
                <p class="mt-3"><i class="fa-solid fa-location-dot text-gray-700 mr-1"></i>
                    {{ $post->location->municipio . ' (' . $post->location->departamento . ')' }}</p>

            </div>
        </div>
    @endforeach
</div>
