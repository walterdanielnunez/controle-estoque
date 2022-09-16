@include('header')

<h4 class="center">Movimentações</h4>

<table class="tabelas">

    <tr>
        <th>Data</th>
        <th>Tipo</th>
        <th>Produto</th>
        <th>Quantidade</th>
    </tr>

    @foreach ($movimentacoes as $mov)
        <tr>
            <td class="center"> {!! Datas::formatoBr($mov->data) !!} </td>
            <td class="center"> {{ ($mov->tipo == 's') ? 'Saída' : 'Entrada' }} </td>
            <td class="center">{{ $mov->nome_produto }} </td>
            <td class="center"> {{ $mov->quantidade}} </td>
        </tr>
    @endforeach

</table>


@include('footer')