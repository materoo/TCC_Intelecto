<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aula;
use App\Models\Assunto;
use App\Models\Aluno;
use Exception; 


class AulaController extends Controller
{
    public function salvar(Request $req)
    {
        try{
            $dados = $req->all();
            // dd($dados['fk_assunto']);
            $materia = Assunto::where('nome_assunto', $dados['fk_assunto'])->pluck('fk_materia');    
            
            if ($req->hasFile('nome_arquivo')) { 
                $arquivo = $req->file('nome_arquivo');
                $num = rand(1111, 9999);
                $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
                $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
                $nomeArquivo = "arquivo_" . $num . "." . $ex;
                $arquivo->move($dir, $nomeArquivo);
                $dados['nome_arquivo'] = $dir . "/" . $nomeArquivo;
            }

            $cadAula = [
                'nome_aula' => $dados['nome_aula'],
                'nome_arquivo' => $dados['nome_arquivo'],
                'fk_assunto' => $dados['fk_assunto'],
                'fk_materia' => $materia['0'],
            ];
                
            Aula::create($cadAula);
            return redirect()->route('admin.cadaulas');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Aula já cadastrada.']);
        }
    }

    public function edit($nome_aula)
    {
        try {
            $linhas = Aula::where('nome_aula', $nome_aula)->get();
            $rows = Assunto::all();
            return view('admin.editar.editar_aula', compact('linhas', 'rows'));
        } 
        
        catch (Exception $e) {
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações.']);
        }
        // return view('admin.editar.editar_aula', ['aula' => $aula]);
    }

    // public function update(Request $request, $nome_aula)
    // {
    //     // $updated = $this->materia->where('num', $num)->update($req->except(['_token', 'method']));
    //     // dd($request);
    //     $aulaAntiga = Aula::find($nome_aula);
        
    //     $aulanova = Aula::create($request->all());
          
          
    //     $aulaAntiga->delete();
       
    //     return redirect()->route('aula.list');
    // }

    public function update(Request $request, $nome_aula) ///////////////NOVOOOOOOO
    {
        try{
            $dados = $request->all();
            $aulaAntiga = Aula::find($nome_aula);
            // dd($request->input('fk_assunto'));
            $materia = Assunto::where('nome_assunto', $dados['fk_assunto'])->pluck('fk_materia');     

            if($request->hasFile('nome_arquivo'))
            {
                $caminhoArquivoAntigo = $aulaAntiga->nome_arquivo;

                // Excluir o arquivo antigo se ele existir
                if (file_exists($caminhoArquivoAntigo)) {
                    unlink($caminhoArquivoAntigo);
                }

                $arquivo = $request->file('nome_arquivo');
                $num = rand(1111, 9999);
                $dir = "uploads/"; // Diretório onde os arquivos serão armazenados
                $ex = $arquivo->getClientOriginalExtension(); // Obtém a extensão original do arquivo
                $nomeArquivo = "arquivo_" . $num . "." . $ex;
                $arquivo->move($dir, $nomeArquivo);
                $dados['nome_arquivo'] = $dir . "/" . $nomeArquivo;
                
                $cadAula = [
                    'nome_aula' => $dados['nome_aula'],
                    'nome_arquivo' => $dados['nome_arquivo'],
                    'fk_assunto' => $dados['fk_assunto'],
                    'fk_materia' => $materia['0'],
                ];
            }
            else 
            {
                $cadAula = [
                    'nome_aula' => $dados['nome_aula'],
                    'fk_assunto' => $dados['fk_assunto'],
                    'fk_materia' => $materia['0'],
                ];
            }
            
            $aulaAntiga->update($cadAula);
            return redirect()->route('aula.list');
        }catch(Exception $e){
            dd($e);
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao alterar informações.']);
        }
    }
    
    // public function update(Request $request, $nome_aula) ///////////////NOVOOOOOOO
    // {
    //     $aulaAntiga = Aula::find($nome_aula);
    //     $aulaAntiga->update($request->all());
    //     return redirect()->route('aula.list');
    // }
    public function destroy_aula($nome_aula)
    {
        try{
            $aulas = Aula::where('nome_aula', $nome_aula)->get();
            

            foreach ($aulas as $aula) {
                $caminhoImg = $aula->nome_arquivo;
                
                $aula->delete();

                if (file_exists($caminhoImg)) {
                    unlink($caminhoImg);
                }
            }
            return redirect()->route('aula.list');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao excluir.']);
        }
    }

  

    public function listar(){
        $rows = Aula::paginate(10);
        return view('admin.tabelas.tabela_aulas', compact('rows')); 
    }

    
  


    public function listarAssuntosMaterias(){
        
        $rows = Assunto::all();
        return view('admin.cadastros.cadAula', compact('rows'));
    }


    public function apresentar(){
        $rows = Aula::paginate(10);
        return view('aluno.assunto', compact('rows')); 
    }

    public function buscar(Request $req)
    {
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = Aula::whereRaw('LOWER(nome_aula) LIKE ?', ['%' . strtolower($busca) . '%'])
            ->paginate(10)
            ->appends(['busca' => $busca]);
            return view('admin.tabelas.tabela_aulas', compact('rows'));
        }catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao filtrar aulas.']);
        }
    }
 

    public function apresentar_assuntos($nome_materia){
        // $rows = Aula::all();
        // dd($nome_materia);
        $rows = Aula::where('fk_materia', $nome_materia)
        ->orderBy('fk_assunto') // Adicione esta linha para ordenar por fk_assunto
        ->paginate(10);
        // dd($rows);
        // return view('aluno.assunto', ['aulas' => $rows]);
        return view('aluno.assunto', compact('rows', 'nome_materia'));
    }

    public function PesquisaExercicio(Request $req)
    {
        $dadosBusca = $req->all();

        try {
            $query = Aula::where('fk_materia', $dadosBusca['materia']);
        
            if (isset($dadosBusca['filtro'])) {
                if ($dadosBusca['filtro'] == 'assunto') {
                    $query->whereRaw('LOWER(fk_assunto) LIKE ?', ['%' . strtolower($dadosBusca['busca']) . '%']);
                } else if ($dadosBusca['filtro'] == 'aula') {
                    $query->whereRaw('LOWER(nome_aula) LIKE ?', ['%' . strtolower($dadosBusca['busca']) . '%']);
                }
            }
        
            $rows = $query->paginate(10)->appends($dadosBusca);
        
            $nome_materia = $dadosBusca['materia'];
            return view('aluno.assunto', compact('rows', 'nome_materia'));
        } catch (Exception $e) {
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pesquisar aulas.']);
        }
    }

    
}
