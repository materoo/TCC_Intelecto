<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\User;
use Illuminate\Http\Request;
use Exception; 

class AlunoController extends Controller
{
    public function salvar(Request $req)
    {
        try
        {
            $dados = $req->all();

            $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);

            if($req->hasFile('imagem_aluno')){
                $imagem = $req->file('imagem_aluno');
                $num = rand(1111,9999);
                $dir = "img/alunos/";
                $ex = $imagem->guessClientExtension();
                $nomeImagem = "imagem_".$num.".".$ex;
                $imagem->move($dir,$nomeImagem);
                $dados['imagem_aluno'] = $dir."/".$nomeImagem;
                $user = [
                    'name' => $dados['nome_aluno'],
                    'email' => $dados['email_aluno'],
                    'cpf' => $dados['cpf_aluno'],
                    'nivel'=>'usuario',
                    'imagem' => $dados['imagem_aluno'],
                    'password' => $dados['senha_aluno'],
                ];
            }
            
            User::create($user);

            Aluno::create($dados);

            return view("admin.menu_admin");
        

        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Aluno já existe. Email, cpf ou rg cadastrados anteriormente.']);
        }  
    }




    public function edit($cpf_aluno)
    {   
        try{
            $rows = Aluno::where('cpf_aluno',$cpf_aluno)->get(); 
            return view('admin.editar.editar_aluno', compact('rows'));
        }

        catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações.']);
        }  
    }




    public function update(Request $request, $email_aluno ,$cpf_aluno)
    {
        
        try{
            $row = $request->only(['nome_aluno', 'imagem_aluno', 'rg_aluno', 'cpf_aluno', 'email_aluno', 'celular_aluno', 'escola_aluno', 'serie_aluno']);
            $user;

            // $alunoAntigo = Aluno::find($email_aluno);

            // $caminhoArquivoAntigo = $alunoAntigo->imagem_aluno;

            // // Excluir o arquivo antigo se ele existir
            // if (file_exists($caminhoArquivoAntigo)) {
            //     unlink($caminhoArquivoAntigo);
            // }

            if($request->hasFile('imagem_aluno')){
                $imagem = $request->file('imagem_aluno');
                $num = rand(1111,9999);
                $dir = "img/alunos/";
                $ex = $imagem->guessClientExtension();
                $nomeImagem = "imagem_".$num.".".$ex;
                $imagem->move($dir,$nomeImagem);

                $row['imagem_aluno'] = '';
                $row['imagem_aluno'] = $dir."/".$nomeImagem;

                $user = [
                    'name'=> $row['nome_aluno'],
                    'email' => $row['email_aluno'],
                    'cpf' => $row['cpf_aluno'],
                    'imagem' => $row['imagem_aluno'],
                ];
            }
            else{
                $user = [
                    'name'=> $row['nome_aluno'],
                    'email' => $row['email_aluno'],
                    'cpf' => $row['cpf_aluno'],
                ];
            }

            

            if($email_aluno != $row['email_aluno'])
            {
                User::where('email', $email_aluno)->update(['autenticado' => false]);
            }
            
            User::where('email', $email_aluno)->update($user);
            
            Aluno::where('cpf_aluno', $cpf_aluno)->update($row);
 
            return redirect()->route('aluno.list')
            ->with('success', 'Atualizacao feita com sucesso.');
        
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Erro ao atualizar informações do aluno.']);
    }
        
    }


    public function destroy($email_aluno, $cpf_aluno)
    {
        try{
            User::where('email', $email_aluno)->delete();
            Aluno::where('cpf_aluno', $cpf_aluno)->delete(); 
                return redirect()->route('aluno.list')
                ->with('success', 'Aluno deletado com sucesso.');
                // ->with('sualuno.list sucesso!')
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao excluir.']);
        }

    }
    
    public function listar()
    {
        try {
            $rows = Aluno::paginate(10);
            return view('admin.tabelas.tabela_alunos', compact('rows'));
        } 
            
        catch (\Exception $e) {
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações de alunos.']);
        }
    }

    public function buscar(Request $req)
    {
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = Aluno::whereRaw('LOWER(nome_aluno) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10)
            ->appends(['busca' => $busca]);

            return view('admin.tabelas.tabela_alunos', compact('rows'));
        }catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao filtrar alunos.']);
        }
    }
}
