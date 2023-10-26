<?php

namespace App\Http\Controllers;
use App\Models\RedacaoCorrigida;
use Illuminate\Http\Request;

class RedacaoCorrigidaController extends Controller
{
    public function salvar(Request $req)
    {
        try{
        $dados = $req->all();
        // dd($dados);
        // $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);
        if ($req->hasFile('arquivo_correcao')) {
            $arquivo = $req->file('arquivo_correcao');
            $num = rand(1111, 9999);
            $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
            $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
            $nomeArquivo = "arquivocorrecao_" . $num . "." . $ex;
            $arquivo->move($dir, $nomeArquivo);
            $dados['arquivo_correcao'] = $dir . "/" . $nomeArquivo;
        }
        RedacaoCorrigida::create($dados);
        return redirect()->route('redacao.list_aluno');
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => ' ']);
    }
    }


        public function redirecionar_redacao(Request $request)
        {

            $cpfAluno = $request->query('cpf_aluno');
            $temaRedacao = $request->query('tema_redacao');
            $cpfAluno = [$cpfAluno];
            $temaRedacao = [$temaRedacao];
            // dd($cpfAluno);
            return view('admin.cadastros.cadRedacaoCorrigida', compact('cpfAluno', 'temaRedacao'));
            // Resto do seu código
        }

        public function listar_redacoes_corrigidas($cpf)
        {
            // Use o parâmetro $cpf para buscar os registros no modelo RedacaoCorrigida
            $rows = RedacaoCorrigida::where('fk_cpf_aluno', $cpf)->paginate(10);

            // Envie os registros para a view
            return view('aluno.correcao_redacao', compact('rows'));
        }

        public function listar_redacoes_corrigidas_para_professor()
        {
            // Use o parâmetro $cpf para buscar os registros no modelo RedacaoCorrigida
            $rows = RedacaoCorrigida::with('aluno')->paginate(10);

            // Envie os registros para a view
            return view('admin.tabelas.tabela_redacoes_corrigidas', compact('rows'));
        }

        // public function listar(){
        //     $rows = Materia::all();
        //     // dd($rows);
        //     return view('admin.tabelas.tabela_materias', compact('rows'));
        // }

        public function edit($id_redacao_corrigida) 
        {
            try {
                $rows = RedacaoCorrigida::where('id_redacao_corrigida',$id_redacao_corrigida)->get(); 
                return view('admin.editar.editar_redacao_corrigida', compact('rows'));
            } 
            
            catch (Exception $e) {
                return redirect()->route('redacao_corrigida.list')
                ->with('error', 'Erro ao pegar infos de assuntos.');
            }
        }
    
    
    
        // public function update(Request $req, $id_redacao_corrigida)
        // {
      
        //     $redacaoAntiga = RedacaoCorrigida::find($id_redacao_corrigida);
        //     $redacaoAntiga->delete();
        //     $dados = $req->all();
        //     // dd($dados);
        //     // $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);
        //     if ($req->hasFile('arquivo_correcao')) {
        //         $arquivo = $req->file('arquivo_correcao');
        //         $num = rand(1111, 9999);
        //         $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
        //         $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
        //         $nomeArquivo = "arquivo_correcao" . $num . "." . $ex;
        //         $arquivo->move($dir, $nomeArquivo);
        //         $dados['arquivo_correcao'] = $dir . "/" . $nomeArquivo;
        //     }
        //     RedacaoCorrigida::create($dados);
        //     return redirect()->route('redacao_corrigida.list');
        // }

        public function update(Request $req, $id_redacao_corrigida) ///////////////NOVOOOOOOO
        {
            try{
            $redacao = RedacaoCorrigida::find($id_redacao_corrigida);
            $dados = $req->all();
        // dd($dados);
        // $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);
            if ($req->hasFile('arquivo_correcao')) {
                $arquivo = $req->file('arquivo_correcao');
                $num = rand(1111, 9999);
                $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
                $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
                $nomeArquivo = "arquivo_correcao" . $num . "." . $ex;
                $arquivo->move($dir, $nomeArquivo);
                $dados['arquivo_correcao'] = $dir . "/" . $nomeArquivo;
            }
            $redacao->update($dados);
                return redirect()->route('redacao_corrigida.list');
            }catch(Exception $e){
                return view('tela_erro.tela_erro', ['erro' => ' ']);
            }


        }
    
    
        public function destroy($id_redacao_corrigida)
        {
            try{
            $redacao = RedacaoCorrigida::find($id_redacao_corrigida);
    
            // $alternativas = Alternativa::where('fk_id_alternativa', $id_alternativa)->get();
    
            // foreach ($alternativas as $alternativa) {
            //     $alternativa->delete();
            // }
        
            $redacao->delete();
            return redirect()->route('redacao_corrigida.list');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => ' ']);
        }
    
        }

        // teste buscar de red_corrigidas

        public function buscar(Request $req)
        {
            $busca = $req->input('busca');
            // dd($busca);
            try{
                $rows = RedacaoCorrigida::whereRaw('LOWER(fk_tema) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10)
                ->appends(['busca' => $busca]);

                return view('admin.tabelas.tabela_redacoes_corrigidas', compact('rows'));
            }catch (Exception $e){
                dd($e);
            }
        }


}
