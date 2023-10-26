<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\User;
use Illuminate\Http\Request;

class AlunoController extends Controller
{
    public function salvar(Request $req)
    {
        $dados = $req->all();
        // dd($dados);
        $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);
        if($req->hasFile('imagem_aluno')){
            $imagem = $req->file('imagem_aluno');
            $num = rand(1111,9999);
            $dir = "img/alunos/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem_aluno'] = $dir."/".$nomeImagem;
        }

        $user = [
            'name' => $dados['nome_aluno'],
            'email' => $dados['email_aluno'],
            //'nivel' como default já vai para usuario (Não descomentar)
            'password' => $dados['senha_aluno'],
        ];
        
        User::create($user);

        Aluno::create($dados);
        
        


        return redirect()->route('aluno.list')
        ->with('success', 'Post updated successfully.')
        ->with('error', 'Um puta de um erro');
    }

    public function edit($cpf_aluno)
    {
        $rows = Aluno::where('cpf_aluno',$cpf_aluno)->get(); 
        return view('admin.editar.editar_aluno', compact('rows'));
    }

    public function update(Request $request, $email_aluno ,$cpf_aluno)
    {
        $row = $request->only(['nome_aluno', 'rg_aluno', 'cpf_aluno', 'email_aluno', 'celular_aluno', 'escola_aluno', 'serie_aluno']);
        $user = [
            'name'=> $row['nome_aluno'],
            'email' => $row['email_aluno'],
        ];

        // $row->nome_aluno = $request->input('nome_aluno');
        // $row->rg_aluno = $request->input('rg_aluno');
        // $row->cpf_aluno = $request->input('cpf_aluno');
        // $row->email_aluno = $request->input('email_aluno');
        // $row->celular_aluno = $request->input('celular_aluno');
        // $row->escola_aluno = $request->input('escola_aluno');
        // $row->serie_aluno = $request->input('serie_aluno');
        // $row->imagem_aluno = $request->input('imagem_aluno');

        if($request->hasFile('imagem_aluno')){
            $imagem = $request->file('imagem_aluno');
            $num = rand(1111,9999);
            $dir = "img/alunos/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem_aluno'] = $dir."/".$nomeImagem;
        }

        Aluno::where('cpf_aluno', $cpf_aluno)->update($row);

        User::where('email', $email_aluno)->update($user);
    
        return redirect()->route('aluno.list')
        ->with('success', 'Post updated successfully.')
        ->with('error', 'Um puta de um erro');
    }

    public function destroy($email_aluno, $cpf_aluno)
    {
        // dd($email_aluno);
        // $dados = $req->all();
        // dd($dados);
        // $user = [
        //     'email' => $dados['email_aluno'],

        // ];

        User::where('email', $email_aluno)->delete();
        Aluno::where('cpf_aluno', $cpf_aluno)->delete(); 
            return redirect()->route('aluno.list');
            // ->with('sualuno.list sucesso!')
    }
    
    public function listar()
    {
        try {
            $rows = Aluno::all();
            return view('admin.tabelas.tabela_alunos', compact('rows'));
            } catch (\Exception $e) {
            // Em caso de erro na consulta ou outra exceção, você pode lidar com isso aqui,
            // por exemplo, exibindo uma mensagem de erro ou redirecionando para outra página.
            // Por exemplo:
            // return redirect()->route('rota.de.falha')->with('error', 'Ocorreu um erro ao listar os alunos.');
            }
    }

}
