<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\RespostaAluno;
use App\Models\Exercicio;
use App\Models\Alternativa;
use App\Models\Materia;
use App\Models\Assunto;
use Exception; 


class RespostaController extends Controller
{
    private $allExercises; // Variável de classe para armazenar todos os exercícios

    public function __construct()
    {
        // Carregue todos os exercícios no construtor
        $this->allExercises = Exercicio::with('alternativas')->get();
    }

    public function salvar_resposta(Request $req)
    {
        // try{ 
            // $paginaAtual = $req->input('page',1);
            // return $page;
            // return $paginaAtual;
            // session()->forget('exercicios');
            // return 1;
            $exs = $this->allExercises;
            $materias = Materia::all();  
            $assuntos = Assunto::all();
            $dados = $req->all();
            
            // return back();
            if (!session()->has('exercicios')) {
                session(['exercicios' => []]);
            }

            $rows=$exs;
            if (session()->has('busca')) { 
                $query = Exercicio::with('alternativas');
                $busca = session('busca');
                 
                // dd($busca);
                if (isset($busca[0]['Materia']) && $busca[0]['Materia'] != "todos") {
                    $query->where('fk_materia', $busca[0]['Materia']);
                }
            
                if (isset($busca[0]['Assunto']) && $busca[0]['Assunto'] != "todos") {
                    $query->where('fk_assunto', $busca[0]['Assunto']);
                }
            
                if (isset($busca[0]['Vestibular']) && $busca[0]['Vestibular'] != "todos") {
                    $query->where('vestibular', $busca[0]['Vestibular']);
                }
            
                if (isset($busca[0]['Ano']) && $busca[0]['Ano'] != "todos") { 
                    $query->where('ano_exercicio', $busca[0]['Ano']);   
                }
                $rows = $query->get();
                }
           
           
           
            $alternativaCorreta = Alternativa::where('fk_id_exercicio', $dados['fk_id_exercicio'])
            ->where('correta', true) 
            ->value('letra'); 
            
            if (!isset($dados['letra_respondida']) || empty($dados['letra_respondida'])) {
                session(['resposta_certa_errada' => 'Selecione uma resposta antes de enviar.']); 
                $exercicio= ['resposta_certa_errada' => 'Selecione uma resposta antes de enviar.' ,'id_exercicio' => $dados['fk_id_exercicio'],
                'alternativa_respondida'=>null, 'letra_correta'=>$alternativaCorreta];
                session()->push('exercicios', $exercicio);
                // return 1;
                // return redirect()->back();
                return view('aluno.exercicios', compact('rows', 'materias', 'assuntos', 'exs')); 
            }
            RespostaAluno::create($dados);
            
            
            // if ($dados['letra_respondida'] === $alternativaCorreta) {
            // return redirect()->route('aluno.homepage');
            if ($dados['letra_respondida'] === $alternativaCorreta) {
                // $resposta_certa_errada='correta';
                $exercicio= ['resposta_certa_errada' => 'correta' ,'id_exercicio' => $dados['fk_id_exercicio'],
                'alternativa_respondida'=>$dados['letra_respondida'], 'letra_correta'=>$alternativaCorreta];
                
                // Adicionar o exercício ao array de exercícios na sessão
                session()->push('exercicios', $exercicio);

            
                
                
                
            } else {
                // A resposta do aluno está incorreta
                // $resposta_certa_errada=$alternativaCorreta;
            
                $exercicio=['resposta_certa_errada' => 'errada', 'id_exercicio' => $dados['fk_id_exercicio'],
                 'alternativa_respondida'=>$dados['letra_respondida'], 'letra_correta'=>$alternativaCorreta];
                session()->push('exercicios', $exercicio);
            }  
            
           
                
            
            return view('aluno.exercicios', compact('rows', 'materias', 'assuntos', 'exs')); 
            

            // $rows=$exs;
            // return back();
            // return redirect()->route('aluno_listar_exercicio'); 
            // return view('aluno.exercicios', compact('rows', 'materias', 'assuntos', 'exs'));
        }
            // return back();
            // return view('aluno.exercicios', compact('rows', 'materias', 'assuntos', 'exs'));
        
    // }catch(Exception $e){
    //     return view('tela_erro.tela_erro', ['erro' => 'Erro ao responder: ' + $e]);
    // }
        // return redirect()->route('aluno_listar_exercicio'); 
    // }  }

   
// public function listar_exercicios(Request $req) 
// { 
//     $exs = $this->allExercises;
//     $materias = Materia::all();  
//     $assuntos = Assunto::all();
 
//     // $pagina = $req->input('page', 1); 
//     // return back();
//     // $rows=$exs;
//     if (session()->has('busca')) { 
//         $rows = session('busca')->get();
//     dd($rows);}
    
//     return view('aluno.exercicios', compact('rows', 'materias', 'assuntos', 'exs'));
//     // dd($page);
      
// }
} 

 