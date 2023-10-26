<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Alternativa;
use App\Models\Exercicio;
use Exception; 


class AlternativaController extends Controller
{
    public function salvar(Request $req)
    {
        try{
        $dados = $req->all();
        //     $alternativa = Alternativa::where('id_exercicio', $dados['fk_id_exercicio'])
        //     ->whereNotNull('alternativa_correta')
        //     ->first();

        // if ($exercicioExistente) {
        //     return view('tela_erro.tela_erro', ['erro' => 'Já existe um exercício com a mesma ID e alternativa correta.']);
        // }
        // dd($dados);
        // $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);
        if($req->hasFile('imagem_alternativa')){
            $imagem = $req->file('imagem_alternativa');
            $num = rand(1111,9999);
            $dir = "img/alternativas/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem_alternativa'] = $dir."/".$nomeImagem;
        }

        Alternativa::create($dados);
        return redirect()->route('admin.cadastro_alternativa');
    }catch(Exception $e){
        dd($e);
        return view('tela_erro.tela_erro', ['erro' => 'Alternativa já cadastrada ou Id de exercício inexistente. Verifique as informações da questão.']);
    }
    }

    public function ListarIDExercicios()
    {
        $exercicios = Exercicio::all();
        return view('admin.cadastros.cadAlternativa', compact('exercicios'));
    }

    public function listar(){ 
        $rows = Alternativa::paginate(10); 
        return view('admin.tabelas.tabela_alternativas', compact('rows'));
    }

    public function edit($id_alternativa)
    {
        try {
            $rows = Alternativa::where('id_alternativa',$id_alternativa)->get();
            $idExercicios = Exercicio::all(); 
            return view('admin.editar.editar_alternativa', compact('rows', 'idExercicios'));
        } 
        
        catch (Exception $e) {
            return redirect()->route('assunto.list')
            ->with('error', 'Erro ao pegar infos de assuntos.');
        }
    }



    public function update(Request $req, $id_alternativa)
    {
        // try{
        $dados=$req->all();
        $alternativaAntigo = Alternativa::find($id_alternativa);
        if($req->hasFile('imagem_alternativa')){
            $imagem = $req->file('imagem_alternativa');
            $num = rand(1111,9999);
            $dir = "img/alternativas/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem_alternativa'] = $dir."/".$nomeImagem;
        }
        $alternativaAntigo->update($dados);
        return redirect()->route('alternativa.list');
    // }catch(Exception $e){
    //     return view('tela_erro.tela_erro', ['erro' => 'Alternativa já cadastrada ou Id de exercício inexistente. Verifique as informações da questão.']);
    // }
    }


    public function destroy($id_alternativa)
    {
        try{
        $alternativa = Alternativa::find($id_alternativa);

        // $alternativas = Alternativa::where('fk_id_alternativa', $id_alternativa)->get();

        // foreach ($alternativas as $alternativa) {
        //     $alternativa->delete();
        // }
    
        $alternativa->delete();
        return redirect()->route('alternativa.list');
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => ' ']);
    }
    }

    public function buscar(Request $req)
    {
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = Alternativa::whereRaw('LOWER(descricao_alternativa) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10)
            ->appends(['busca' => $busca]);

            return view('admin.tabelas.tabela_alternativas', compact('rows'));
        }catch (Exception $e){
            dd($e);
        }
    }
}
