@include('header')

<h4 class="center">{{$titulo}}</h4>

<table class="tabelas">

    @if(count($produtos) > 0)
        <tr>
            <th>Nome</th>
            <th>Valor</th>
            <th>Validade</th>
            <th>Estoque</th>
        </tr>
    @else
        <tr>
            <td colspan="4">Sem registros</td>
        </tr>
    @endif

    @foreach ($produtos as $produto)
        <tr>
            <td><a href="{{ url('produtos/editar/'.$produto->id_produto)}}">{{ $produto->nome }}</a></td>
            <td class="right">{!! Formatador::brCurrency($produto->valor) !!} </td>
            <td class="center">{!! Datas::formatoBr($produto->validade) !!} </td>
            <td class="center"><a href="{{url('produtos/movimentacao/'.$produto->id_produto)}}" class="{{($produto->estoque <= $produto->estoque_baixo) ? 'estoque_baixo' : ''}}">{{ $produto->estoque }}</a></td>
        </tr>
    @endforeach

</table>


@include('footer')