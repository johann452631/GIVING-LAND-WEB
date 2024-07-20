<x-html>
    <x-simple-header />

    <div class="h-screen pt-16 grid place-items-center px-4">
        <x-form ruta-siguiente="users.store" class="auth-form shadow shadow-gray-400 bg-gris-claro">
            <h2 class="text-center texto-verde text-3xl mb-6">Registro de datos</h2>
            <p class="text-gray-800 mb-5">
                <font class="text-red-600">*</font> Indica que es obligatorio.
            </p>
            <x-forms.input autofocus type="text" name="name" label-text="Nombre:" is-required class="mb-10" />

            <x-forms.input type="text" name="email" label-text="Correo electrónico:" value="{{ $email }}"
                readonly class="mb-10 input-read" />

            <x-forms.input type="password" name="password" label-text="Contraseña:" value="" is-required
            class="mb-10"/>

            <input type="hidden" name="email_verified_at" value="{{ $email_verified_at }}">

            <button class="boton-base verde-blanco w-full" type="submit">Registrarse</button>
        </x-form>
    </div>
</x-html>
