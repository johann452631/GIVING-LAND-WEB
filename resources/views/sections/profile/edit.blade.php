<x-html>
    {{-- Header --}}
    <x-header />

    {{-- Main --}}
    <div class="pt-24 pb-6">
        <div class="bg-gris-claro rounded p-10 max-w-2xl my-0 mx-auto">
            <livewire:profile.edit.profile-img />
            <hr>
            <livewire:profile.edit.social-media />
            <hr>
            <livewire:profile.edit.contact-information />
            <hr class="mb-4">
            <a class="boton-base verde-blanco" href="{{route('profile.show',$username)}}">Regresar al perfil</a>
        </div>
    </div>

    {{-- footer --}}
    <x-footer/>
</x-html>
