<h2 class="text-center texto-verde text-3xl mb-6">Verificación de código</h2>
<div class="mb-6">
    <p>
        Ingrese el código que se le envió a:
        <b>{{$request->email}}</b>
    </p>
</div>
<x-forms.input-code class="mb-10"/>
<input type="hidden" name="email" value="{{ $request->email }}">

<input type="hidden" name="token" value={{ $request->route('token') }} />

<button class="w-full boton-base verde-blanco" type="submit">Verificar</button>

<script src="{{ asset('js/codevalidation/code.js') }}"></script>