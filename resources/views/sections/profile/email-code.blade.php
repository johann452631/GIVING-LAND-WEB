<div>
    <x-form ruta-siguiente="codeValidation.verifyCode" class="py-10 px-32 rounded-lg">
        <h2 class="text-2xl texto-verde text-center mb-5">Verificación de código</h2>
        <p class="mb-5">Si el código concide, el correo electrónico se actualizará a <b>{{ session('email') }}</b>
        </p>
        <x-forms.input-code />
        <div class="mt-10">
            <button type="submit" class="boton-base verde-blanco mr-3">Enviar código</button>
            <a href="{{ route('users.edit', $user->username) }}"
                class="d-inline-block boton-base gris-blanco">Cancelar</a>
        </div>
    </x-form>
</div>