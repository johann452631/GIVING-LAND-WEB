<x-html>

    @pushOnce('links')
        <link rel="stylesheet" href="{{ asset('css/posts/create.css') }}">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
        {{-- <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> --}}
        {{-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> --}}
    @endPushOnce

    {{-- header --}}
    <x-header />


    {{-- main --}}
    <main class="pt-24 pb-6 px-2 screen-size">
        <div class="bg-gris-claro rounded px-6 py-10 max-w-3xl my-0 mx-auto">
            <h1 class="texto-verde text-3xl text-center mb-8">
                @if ($post !== null)
                    Edición de publicación
                @else
                    Publicación de artículo
                @endif
            </h1>
            <livewire:posts.create-edit :$post/>
        </div>
    </main>

    {{-- footer --}}
    <x-footer />
    {{-- <script src="{{ asset('js/posts/create.js') }}"></script> --}}

</x-html>
