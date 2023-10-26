<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Redacao;
use App\Models\RedacaoAluno;
use App\Models\RedacaoCorrigida;
use Exception; 



class RedacaoController extends Controller
{
    public function salvar(Request $req)
    {
        try{
            $dados = $req->all();
            // dd($dados);
            // $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);
            if($req->hasFile('nome_imagem')){
                $imagem = $req->file('nome_imagem');
                $num = rand(1111,9999);
                $dir = "img/redacaos/";
                $ex = $imagem->guessClientExtension();
                $nomeImagem = "imagem_".$num.".".$ex;
                $imagem->move($dir,$nomeImagem);
                $dados['nome_imagem'] = $dir."/".$nomeImagem;
            }
            Redacao::create($dados);
            return redirect()->route('admin.cadastro_redacao');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao cadastrar. Informações repetidas.']);
        }
        
    }

    // public function edit($titulo)
    // {
    //     $rows = Redacao::where('titulo', $titulo)->get(); 
    //     return view('admin.editar.editar_redacao', compact('rows'));
    // }

    // public function update(Request $request, $titulo)
    // {
    //     $row = $request->only(['nome_redacao', 'texto_imagem', 'descricao']);

    //     if($request->hasFile('nome_imagem')){
    //         $imagem = $request->file('nome_imagem');
    //         $num = rand(1111,9999);
    //         $dir = "img/redacaos/";
    //         $ex = $imagem->guessClientExtension();
    //         $nomeImagem = "imagem_".$num.".".$ex;
    //         $imagem->move($dir,$nomeImagem);
    //         $dados['nome_imagem'] = $dir."/".$nomeImagem;
    //     }

    //     Redacao::where('titulo', $titulo)->update($row);
    
    //     return redirect()->route('redacao.list')
    //     ->with('success', 'Post updated successfully.');
    // }

    // public function destroy($titulo)
    // {
    //     Redacao::where('titulo', $titulo)->delete(); 
    //         return redirect()->route('redacao.list');
    //         // ->with('sualuno.list sucesso!')
    // }

    

    public function listar(){
        $rows = Redacao::paginate(10);
        return view('admin.tabelas.tabela_redacoes', compact('rows'));
    }

    public function buscar(Request $req) //Busca na tabela que os professores e adms tem acesso
    {
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = Redacao::whereRaw('LOWER(titulo) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10)
            ->appends(['busca' => $busca]);

            return view('admin.tabelas.tabela_redacoes', compact('rows'));
        }catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Falha ao pegar informações.' ]);
        }
    }

    public function alunobuscar(Request $req) //Busca do aluno por redações
    {
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = Redacao::whereRaw('LOWER(titulo) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(9)
            ->appends(['busca' => $busca]);

            return view('aluno.redacao', compact('rows'));
        }catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao filtar redações.']);
        }
    }

    public function apresentar(){
        $rows = Redacao::paginate(10);
        return view('aluno.redacao', compact('rows'));
    }

    public function edit_redacao_aluno($titulo)
    {
        // $rows = Redacao::where('titulo', $titulo)->get(); 
        return view('aluno.enviar_redacao', ['titulo' => $titulo]);
        // $rows = Redacao::where('titulo', $titulo)->with('aluno')->get(); 
        // return view('admin.editar.editar_redacao', compact('rows'));
    }

    public function update_redacao_aluno(Request $req)
    {
        $dados =  $req->all();
        
        if ($req->hasFile('nome_arquivo')) {
            $arquivo = $req->file('nome_arquivo');
            $num = rand(1111, 9999);
            $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
            $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
            $nomeArquivo = "arquivo_" . $num . "." . $ex;
            $arquivo->move($dir, $nomeArquivo);
            $dados['nome_arquivo'] = $dir . "/" . $nomeArquivo;
        }
        RedacaoAluno::create($dados);
        return redirect()->route('redacao.list');
    }

    public function listar_redacao_aluno(){
        $rows = RedacaoAluno::with('aluno')->paginate(9);
        return view('admin.tabelas.tabela_redacao_aluno', compact('rows'));
    }

    public function edit($titulo)
    {
        try {
            $rows = Redacao::where('titulo',$titulo)->get(); 
            return view('admin.editar.editar_redacao', compact('rows'));
        } 
        
        catch (Exception $e) {
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações: ' + $e]);
        }
    }



//     public function update(Request $request, $titulo)
// {
//     // Encontre a redação antiga pelo título
//     $redacaoAntigo = Redacao::where('titulo', $titulo)->first();

//     if (!$redacaoAntigo) {
//         // Redação antiga não encontrada, talvez você queira tratar isso de alguma forma
//         return redirect()->route('redacao.list')->with('error', 'Redação não encontrada');
//     }

//     if ($request->titulo != $titulo) {
//         // Crie uma nova redação
//         $novoredacao = Redacao::create($request->all());

//         // Atualize as redações de alunos com o novo título
//         $redacoesalunosAntigas = RedacaoAluno::where('fk_tema', $titulo)->get();
//         foreach ($redacoesalunosAntigas as $redacaoaluno) {
//             $redacaoaluno->fk_tema = $novoredacao->titulo; 
//             $redacaoaluno->save();
//         }

//         $redacoescorrigidasAntigas = RedacaoCorrigida::where('fk_tema', $titulo)->get();
//         foreach ($redacoescorrigidasAntigas as $redacaoaluno) {
//             $redacaoaluno->fk_tema = $novoredacao->titulo; 
//             $redacaoaluno->save();
//         }

//         // Delete a redação antiga
//         $redacaoAntigo->delete();
//     } else {
//         // Atualize a redação antiga com os dados do request
//         $redacaoAntigo->update($request->all());
//     }

//     return redirect()->route('redacao.list')->with('success', 'Redação atualizada com sucesso');
// }

public function update(Request $req, $titulo) ///////////////NOVOOOOOOO
    {
        try{
       $redacaoAntigo = Redacao::where('titulo', $titulo)->first();
       $dados=$req->all();
       if($req->hasFile('nome_imagem')){
        $imagem = $req->file('nome_imagem');
        $num = rand(1111,9999);
        $dir = "img/redacaos/";
        $ex = $imagem->guessClientExtension();
        $nomeImagem = "imagem_".$num.".".$ex;
        $imagem->move($dir,$nomeImagem);
        $dados['nome_imagem'] = $dir."/".$nomeImagem;
    }
        $redacaoAntigo->update($dados);
        return redirect()->route('redacao.list');
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Erro ao atualizar redação.']);
    }
    }



public function destroy($titulo)
{
    try{
    // Encontre a redação pelo título
    $redacao = Redacao::where('titulo', $titulo)->first();

    if (!$redacao) {
        // Redação não encontrada, talvez você queira tratar isso de alguma forma
        return redirect()->route('redacao.list')->with('error', 'Redação não encontrada');
    }

    // Exclua as redações de alunos relacionadas ao tema
    $redacoesalunosAntigas = RedacaoAluno::where('fk_tema', $titulo)->get();
    foreach ($redacoesalunosAntigas as $redacaoaluno) {
        $redacaoaluno->delete();
    }

    $redacoescorrigidasAntigas = RedacaoCorrigida::where('fk_tema', $titulo)->get();
    foreach ($redacoescorrigidasAntigas as $redacaocorrigida) {
        $redacaocorrigida->delete();
    }

    // Exclua a redação
    $redacao->delete();

    return redirect()->route('redacao.list')->with('success', 'Redação excluída com sucesso');
}catch(Exception $e){
    return view('tela_erro.tela_erro', ['erro' => 'Erro ao excluir.']);
}
}

public function listar_redacao_aluno_para_aluno(Request $req, $cpf )
{
    // Use o parâmetro $cpf para buscar os registros no modelo RedacaoCorrigida
    $rows = RedacaoAluno::where('fk_cpf_aluno', $cpf)->get();
    // dd($rows);

    // Envie os registros para a view
    return view('aluno.tabela_redacao_aluno', compact('rows'));
}

public function edit_redacao_enviada($id_redacao)
{
    $rows = RedacaoAluno::where('id_redacao', $id_redacao)->get();
    return view('aluno.editar_redacao_enviada', compact('rows'));
    // return view('admin.editar.editar_aula', ['aula' => $aula]);
}

    // public function update_redacao_enviada(Request $req, $id_redacao)
    // {
    //     // $updated = $this->materia->where('num', $num)->update($req->except(['_token', 'method']));
    //     // dd($request);
    //     $redacaoAntiga = RedacaoAluno::find($id_redacao);
    //     $redacaoAntiga->delete();
    //     $dados =  $req->all();
    //     if ($req->hasFile('nome_arquivo')) {
    //         $arquivo = $req->file('nome_arquivo');
    //         $num = rand(1111, 9999);
    //         $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
    //         $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
    //         $nomeArquivo = "arquivo_" . $num . "." . $ex;
    //         $arquivo->move($dir, $nomeArquivo);
    //         $dados['nome_arquivo'] = $dir . "/" . $nomeArquivo;
    //     }
    //     RedacaoAluno::create($dados);
    //     // $redacaoAntiga->update($request->all());
    // //     }
       
    //     return redirect()->route('redacao.list_aluno_para_aluno', ['cpf' => $req->fk_cpf_aluno]);
    // }

    public function update_redacao_enviada(Request $req, $id_redacao) ///////////////NOVOOOOOOO
    {
        try{
            $redacao = RedacaoAluno::find($id_redacao);

            $dados =  $req->all();
        
            if ($req->hasFile('nome_arquivo')) {
                $arquivo = $req->file('nome_arquivo');
                $num = rand(1111, 9999);
                $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
                $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
                $nomeArquivo = "arquivo_" . $num . "." . $ex;
                $arquivo->move($dir, $nomeArquivo);
                $dados['nome_arquivo'] = $dir . "/" . $nomeArquivo;
            }

            $redacao->update($dados);
            return redirect()->route('redacao.list_aluno_para_aluno', ['cpf' => $req->fk_cpf_aluno]);
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao alterar informações da redação.']);
        }
    }

    public function destroy_redacao_enviada($id_redacao, $fk_cpf_aluno)
    {
        
        try{
        $redacaoenviada = RedacaoAluno::where('id_redacao', $id_redacao)->get();

        foreach ($redacaoenviada as $redacao) {
            $redacao->delete();
        }
        
        return redirect()->route('redacao.list_aluno_para_aluno', ['cpf' => $fk_cpf_aluno]);
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Erro ao excluir.']);
    }
    }


    public function buscar_redaluno(Request $req) //Buscar redação enviada por aluno na tabela de administrador professor
    {
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = RedacaoAluno::whereRaw('LOWER(fk_tema) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10)
            ->appends(['busca' => $busca]);

            return view('admin.tabelas.tabela_redacao_aluno', compact('rows'));
        }catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao filtrar redações.']);
        }
    }


    public function buscar_redacao_aluno_aluno(Request $req, $cpf) //Busca redação enviada pelo aluno na tabela que o aluno tem acesso
    {
        try{
            $busca = $req->input('busca');
            // $rows = RedacaoAluno::where('fk_tema', 'LIKE', '%' . $busca . '%')->get();
                $rows = RedacaoAluno::where('fk_cpf_aluno', $cpf)
                ->whereRaw('LOWER(fk_tema) LIKE ?', ['%' . strtolower($busca) . '%'])
                ->paginate(10)->appends(['busca' => $busca]);

        //    $rows = RedacaoAluno::whereRaw('LOWER(fk_tema) LIKE ?', ['%' . strtolower($busca) . '%'])
        //    ->get();
           return view('aluno.tabela_redacao_aluno', compact('rows'));
        }catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao filtar redações.']);
        }
    } 


 
}
  