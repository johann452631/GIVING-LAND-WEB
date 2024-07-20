@auth
    <div class="menu-opciones-lateral hidden md:block">
        <a class="inline-block boton-base verde-blanco text-lg" href="{{ route('posts.create') }}">Publicar artículo</a>
        <hr class="my-4">
        <a @owner($username) wire:navigate @endowner @class([
            'hover-gris-claro p-2 rounded flex items-center w-full',
            'border-l-4 border-green-700' => request('username') == $user->username,
        ]) href="{{ route('profile.show', $user->username) }}">
            <img class="size-8 redondo mr-2" src="{{ $user->profile->getProfileImageUrl() }}">
            <h4>{{ $user->name }}</h4>
        </a>
        @owner($username)
            <a wire:navigate @class([
                'hover-gris-claro p-2 rounded flex items-center w-full',
                'border-l-4 border-green-700' => request()->routeIs('favorites.index'),
            ]) href="{{ route('favorites.index') }}">
                Favoritos
            </a>

            <a wire:navigate @class([
                'hover-gris-claro p-2 rounded flex items-center w-full',
                'border-l-4 border-green-700' => request()->routeIs('settlements.index'),
            ]) href="{{ route('settlements.index') }}">
                Historial de movimientos
            </a>
        @endowner
    </div>
@endauth
