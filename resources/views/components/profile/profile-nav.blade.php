@auth
    @props([
        'user' => auth()->user(),
        'username' => request('username') ? request('username') : auth()->user()->username,
    ])
    <div class="menu-opciones-lateral hidden md:block">
        <a class="inline-block boton-base verde-blanco text-lg" href="{{ route('posts.create') }}">Publicar artículo</a>
        <hr class="my-4">
        <a @owner($username) @endowner @class([
            'hover-gris-claro p-2 rounded flex items-center w-full',
            'border-l-4 border-green-700' => request('username') == $user->username,
        ])
            href="{{ route('profile.show', $user->username) }}">
            <img class="size-8 redondo mr-2" src="{{ $user->profile->getImageUrl() }}">
            <h4>{{ $user->name }}</h4>
        </a>
        @owner($username)
            <a @class([
                'hover-gris-claro p-2 rounded flex items-center w-full',
                'border-l-4 border-green-700' => request()->routeIs('favorites.index'),
            ]) href="{{ route('favorites.index') }}">
                Favoritos
            </a>

            <a @class([
                'hover-gris-claro p-2 rounded flex items-center w-full',
                'border-l-4 border-green-700' => request()->routeIs('security-privacy.index'),
            ]) href="{{ route('security-privacy.index') }}">
                Seguridad y privacidad
            </a>
        @endowner
    </div>
@endauth
