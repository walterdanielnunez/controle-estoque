@include('header')

<h4 class="center">Movimentação</h4>

<form action="" method="post">
    @csrf

    <div class="field">
        <label for="tipo">Produto:</label>
        <input type="text" value="{{$nome}}" readonly>
    </div>
    
    <div class="field">
        <label for="tipo">Tipo:</label>
        <select name="tipo">
            <option value="e">Entrada</option>
            <option value="s">Saída (max {{$estoque}})</option>
        </select>
    </div>

    <div class="field">
        <label for="quantidade">Quantidade:</label>
        <input id="quantidade" type="number" name="quantidade" min="0" class="@error('quantidade') is-invalid @enderror">
        @error('quantidade')
            <div class="error-msg">{{ $message }}</div>
        @enderror
    </div>
    
    <button type="submit" class="bt">Salvar</button>
    
</form>


@include('footer')