<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Helpers\Formatador;
use App\Helpers\Datas;


class Produto extends Controller
{
    public function index(){
        $produtos = DB::select('SELECT * FROM produtos');
        $dados["produtos"] = $produtos;
        $dados["titulo"] = "Produtos";
        return view('produtos', $dados);
    }

    public function novo(){
        return view('novo-produto');
    }

    public function add(Request $request){
        $request->validate([
            'nome' => 'required|max:50',
            'valor' => 'required',
            'estoque' => 'required|max:20',
            'estoque_baixo' => 'required',
            'validade' => 'required'
        ],
        [
            'nome.required' => 'Campo nome é obrigatório',
            'nome.max' => 'Máximo 50 caracteres',
            'valor.required' => 'Digite o valor do produto',
            'estoque.required' => 'Informe a quantidade',
            'estoque_baixo.required' => 'Adicione o limíte de estoque baixo',
            'validade.required' => 'Data de validade obrigatório'
        ]);

        $dados = [
            'nome' => $request->input('nome'),
            'valor' =>  Formatador::floatToDb($request->input('valor')),
            'estoque' => $request->input('estoque'),
            'estoque_baixo' => $request->input('estoque_baixo'),
            'validade' => $request->input('validade')
        ];

        $novo = DB::table('produtos')->insert($dados);
        if($novo){
            return redirect('produtos');
        }
    }

    public function update(Request $request, $id){
        $request->validate([
            'nome' => 'required|max:50',
            'valor' => 'required',
            'estoque' => 'required|max:20',
            'estoque_baixo' => 'required',
            'validade' => 'required'
        ],
        [
            'nome.required' => 'Campo nome é obrigatório',
            'nome.max' => 'Máximo 50 caracteres',
            'valor.required' => 'Digite o valor do produto',
            'estoque.required' => 'Informe a quantidade',
            'estoque_baixo.required' => 'Adicione o limíte de estoque baixo',
            'validade.required' => 'Data de validade obrigatório'
        ]);

        $dados = [
            'nome' => $request->input('nome'),
            'valor' =>  Formatador::floatToDb($request->input('valor')),
            'estoque' => $request->input('estoque'),
            'estoque_baixo' => $request->input('estoque_baixo'),
            'validade' => $request->input('validade')
        ];

        DB::table('produtos')->where('id_produto', $id)->update($dados);
        return redirect('produtos');
    }

    public function editar($id){
        $produto = (array)DB::selectOne('SELECT * FROM produtos WHERE id_produto = '.$id);
        if(empty($produto)){
            $dados["erro"] = "Produto não localizado";
            return view('erro', $dados);
        }else{
            $produto["valor"] = Formatador::brCurrency($produto["valor"]);
            return view('editar-produto', $produto);
        }
    }

    public function estoqueBaixo(){
        $produtos = DB::select('SELECT * FROM produtos WHERE estoque <= estoque_baixo');
        $dados["produtos"] = $produtos;
        $dados["titulo"] = "Estoque Baixo";
        return view('produtos', $dados);
    }


    public function movimentacao($id){
        $dadosProduto = DB::selectOne('SELECT nome, estoque FROM produtos WHERE id_produto = '.$id);
        if(empty($dadosProduto)){
            $dados["erro"] = "Produto não localizado";
            return view('erro', $dados);
        }else{
            $dados["nome"] = $dadosProduto->nome;
            $dados["estoque"] = $dadosProduto->estoque;
            return view('movimentacao', $dados);
        }
    }


    public function setMovimentacao(Request $request, $idProduto){
        $set = false;
        $dadosNovaMov = [
            'tipo' => $request->input('tipo'),
            'produto' => $idProduto,
            'quantidade' => (int)$request->input('quantidade'),
            'data' => date("Y-m-d")
        ];

        DB::beginTransaction();
        
        $prod = DB::selectOne("SELECT estoque FROM produtos WHERE id_produto = ".$idProduto);
        $quantEstoque = (int)$prod->estoque;
        //Saída
        if($dadosNovaMov['tipo'] == 's'){ 
            $quantRequired = "required|numeric|min:1|max:".$quantEstoque;
            $dadosEstoque["estoque"] = $quantEstoque - $dadosNovaMov["quantidade"];
        }else{
            $quantRequired = "required|numeric|min:1";
            $dadosEstoque["estoque"] = $quantEstoque + $dadosNovaMov["quantidade"];
        }

        $request->validate(
        [
            'quantidade' => $quantRequired
        ],
        [
            'quantidade.required' => 'Verifique a quantidade',
            'quantidade.max' => 'Verifique a quantidade para saída e entrada.'
        ]);

        $set = DB::table('movimentacoes')->insert($dadosNovaMov);

        $set = DB::table('produtos')->where('id_produto', $idProduto)->update($dadosEstoque);

        if($set){
            DB::commit();
            return redirect('produtos');
        }else{
            DB::rollBack();
        }   
    }

    public function movimentacoes(){
        $movimentacoes = DB::select('SELECT tipo, produto, prod.nome as nome_produto, quantidade, data FROM movimentacoes mov LEFT JOIN produtos prod ON prod.id_produto = mov.produto ORDER BY data DESC');
        if(empty($movimentacoes)){
            return view('erro', ["erro" => "Não foi possível carregar as movimentações"]);
        }else{
            return view('movimentacoes', ["movimentacoes" => $movimentacoes]);
        }
    }






}
