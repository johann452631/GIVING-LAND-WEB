<h1 class="text-center text-3xl texto-verde mb-6">Registro</h1>
<x-forms.input autofocus type="email" name="email" label-text="Correo electrónico:" class="mb-8">
    <p class="texto-gris mt-3">Se enviará un código de verificación</p> 
</x-forms.input>
<input type="hidden" name="token" value="{{$token}}">
<div class="flex flex-col">
    <button class="boton-base verde-blanco mb-4" type="submit">Enviar código</button>
    <a href="/google-auth/redirect" class="boton-base blanco-gris w-full flex justify-center items-center shadow-sm">
        <img class="size-7" src="{{ asset('appicons/icon-google.svg') }}" alt="">
        <p class="text-base ml-2">Registrarse con Google</p>
    </a>
</div>
