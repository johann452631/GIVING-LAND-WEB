<h1 class="text-center text-3xl texto-verde mb-6">Recuperación de contraseña</h1>

<x-forms.input autofocus type="email" name="email" label-text="Correo electrónico:" class="mb-10">
    <p class="texto-gris mt-2">Se enviará un código de verificación</p>
</x-forms.input>

<input type="hidden" name="token" value="{{$token}}">

<button class="w-full boton-base verde-blanco mb-4" type="submit">Enviar código</button>
