<div {{ $attributes->merge(['class' => 'div-form-input w-full']) }}>
    <p class="texto-verde mb-3" for="">Código de verificación:</p>
    <div class="div-codigo grid grid-cols-6 gap-x-3 mb-3">
        <input autofocus type="text" maxlength="1" name="char1">
        <input type="text" maxlength="1" name="char2">
        <input type="text" maxlength="1" name="char3">
        <input type="text" maxlength="1" name="char4">
        <input type="text" maxlength="1" name="char5">
        <input type="text" maxlength="1" name="char6">
    </div>
    @session('errorVerificacion')
        <p class="input-error text-red-500">* {{ $value }}</p>
    @endsession
</div>