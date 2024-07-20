<div>
    <x-form ruta-siguiente="changeEmail.sendCode" class="py-10 px-20 rounded-lg">
        <h2 class="text-2xl texto-verde text-center mb-5">Edición de correo electrónico</h2>
        <x-forms.input autofocus type="text" name="email" label-text="Correo electrónico nuevo:" class="mb-10">
            <p class="texto-gris mt-3">Se enviará un código de verificación</p>
        </x-forms.input>
        <div>
            <button type="submit" class="boton-base verde-blanco mr-3">Enviar código</button>
            <a href="{{ route('users.edit', $user->username) }}"
                class="d-inline-block boton-base gris-blanco">Cancelar</a>
        </div>
    </x-form>
</div>