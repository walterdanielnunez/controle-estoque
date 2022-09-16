@include('header')

<h4 class="center">Novo Produto</h4>

<form action="" method="post">
    @csrf
    
    <div class="field">
        <label for="nome">Nome:</label>
        <input id="nome" type="text" name="nome" class="@error('title') is-invalid @enderror">
        @error('nome')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>


    <div class="field">
        <label for="valor">Valor:</label>
        <input id="valor" type="text" name="valor" class="@error('valor') is-invalid @enderror">
        @error('valor')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>


    <div class="field">
        <label for="estoque">Estoque:</label>
        <input id="estoque" type="number" name="estoque" class="@error('estoque') is-invalid @enderror">
        @error('estoque')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>


    <div class="field">
        <label for="estoque_baixo">Estoque baixo:</label>
        <input id="estoque_baixo" type="number" name="estoque_baixo" class="@error('estoque_baixo') is-invalid @enderror">
        @error('estoque_baixo')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>


    <div class="field">
        <label for="validade">Validade:</label>
        <input id="validade" type="date" name="validade" class="@error('validade') is-invalid @enderror">
        @error('validade')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="bt">Salvar</button>
    
</form>


@include('footer')