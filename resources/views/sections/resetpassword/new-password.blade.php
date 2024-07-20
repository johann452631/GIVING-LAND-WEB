<x-html>
    <x-simple-header />
    <div class="h-screen pt-16 grid place-items-center px-4">
        <x-form :ruta-siguiente="$rutaSiguiente" class="auth-form shadow shadow-gray-400 bg-gris-claro">
            <h2 class="text-center texto-verde text-3xl mb-6">Restablecimiento de contraseña</h2>

            <x-forms.input type="email" name="email" label-text="Correo electrónico:" class="mb-10"
                value="{{ $request->email }}" readonly />

            <input name="token" type="hidden" value={{ $request->route('token') }} />

            <x-forms.input type="password" name="password" label-text="Nueva contraseña:" class="mb-10" value=""
                is-required autofocus/>

            <x-forms.input type="password" name="password_confirmation" label-text="Confirmación de contraseña:"
                is-required class="mb-10" value="" />

            <button class="w-full boton-base verde-blanco" type="submit">Guardar</button>
        </x-form>
    </div>
</x-html>
