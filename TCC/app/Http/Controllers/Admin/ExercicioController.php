<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Exercicio;
use App\Models\Alternativa;
use App\Models\Materia;
use App\Models\Assunto;
use Exception; 



class ExercicioController extends Controller
{
    private $allExercises; // Variável de classe para armazenar todos os exercícios

    public function __construct()
    {
        // Carregue todos os exercícios no construtor
        $this->allExercises = Exercicio::with('alternativas')->get();
    }

    public function salvar(Request $req)
    {
        // try{
        $dados = $req->all();
        
        // $exercicioExistente = Exercicio::where('id_exercicio', $dados['id_exercicio'])->first();

        // if ($exercicioExistente) {
        //     return view('tela_erro.tela_erro', ['erro' => 'Já existe um exercício com o mesmo ID']);
        // }

        $materia = Assunto::where('nome_assunto', $dados['fk_assunto'])->pluck('fk_materia');    
        // dd($dados);
        // $dados['senha_aluno'] = Hash::make($dados['senha_aluno']);
        if($req->hasFile('imagem_exercicio')){
            $imagem = $req->file('imagem_exercicio');
            $num = rand(1111,9999);
            $dir = "img/exercicios/";
            $ex = $imagem->guessClientExtension();
            $nomeImagem = "imagem_".$num.".".$ex;
            $imagem->move($dir,$nomeImagem);
            $dados['imagem_exercicio'] = $dir."/".$nomeImagem;
        }

        $cadEx = [
            'id_exercicio' => $dados['id_exercicio'],
            'descricao_exercicio' => $dados['descricao_exercicio'],
            'ano_exercicio' => $dados['ano_exercicio'],
            'vestibular' => $dados['vestibular'],
            'fk_assunto' => $dados['fk_assunto'],
            'fk_materia' => $materia['0'],
        ];
  
        if ($req->hasFile('imagem_exercicio')) {
            $cadEx['imagem_exercicio'] = $dados['imagem_exercicio'];
        }
        
        Exercicio::create($cadEx);
        return redirect()->route('admin.cadastro_exercicio');
    // }catch(Exception $e){
    //     return view('tela_erro.tela_erro', ['erro' => 'Erro no cadastro. Assunto/matéria não existentes. Verifique as informações']);
    // }
    }

    public function ListarAssuntos() //Direciona para a tela de cadastro de exercícios
    {
        $maiorIdExercicio = Exercicio::max('id_exercicio');
        $rows = Assunto::all();
        return view('admin.cadastros.cadExercicio', compact('rows', 'maiorIdExercicio'));
    }

    public function edit($id_exercicio)
    {
        try {
            $maiorIdExercicio = Exercicio::max('id_exercicio');
            $rows = Exercicio::where('id_exercicio', $id_exercicio)->get();
            $subject = Assunto::all();
            return view('admin.editar.editar_exercicio', compact('rows', 'subject', 'maiorIdExercicio'));
        } 
        catch (Exception $e) {
            dd($e);
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações.']);
        }
    }



    // public function update(Request $request, $id_exercicio)
    // {
  
    //     $exercicioAntigo = Exercicio::find($id_exercicio);
    //     $novoExercicio = Exercicio::create($request->all());

    //     if($request->id_exercicio!=$id_exercicio)
    //     {
    //         $alternativasAntigas = Alternativa::where('fk_id_exercicio',$id_exercicio)->get();
    //         foreach ($alternativasAntigas as $alternativa) {
    //             $alternativa->fk_id_exercicio = $request->id_exercicio; 
    //             $alternativa->save();
    //         }
    //         $exercicioAntigo->delete();
           
    //     }
    //     else{
    //         $exercicioAntigo->update($request->all());
    //     }
    //     return redirect()->route('exercicio.list');
    // }

    public function update(Request $request, $id_exercicio) ///////////////NOVOOOOOOO
    {
        try{
            $exercicio = Exercicio::find($id_exercicio);

            $dados = $request->all();

            $materia = Assunto::where('nome_assunto', $dados['fk_assunto'])->pluck('fk_materia'); 

            if($req->hasFile('imagem_exercicio')){
                $imagem = $req->file('imagem_exercicio');
                $num = rand(1111,9999);
                $dir = "img/exercicios/";
                $ex = $imagem->guessClientExtension();
                $nomeImagem = "imagem_".$num.".".$ex;
                $imagem->move($dir,$nomeImagem);
                $dados['imagem_exercicio'] = $dir."/".$nomeImagem;
            }

            $cadEx = [
                'id_exercicio' => $dados['id_exercicio'],
                'descricao_exercicio' => $dados['descricao_exercicio'],
                'ano_exercicio' => $dados['ano_exercicio'],
                'vestibular' => $dados['vestibular'],
                'fk_assunto' => $dados['fk_assunto'],
                'fk_materia' => $materia['0'],
            ];

            if ($req->hasFile('imagem_exercicio')) {
                $cadEx['imagem_exercicio'] = $dados['imagem_exercicio'];
            }

           

            $exercicio->update($cadEx);
            return redirect()->route('exercicio.list');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro no cadastro. Assunto/matéria não existentes ou Id já cadastrado. Verifique as informações']);
        }
    }


    public function destroy($id_exercicio)
    {
        try{
        $exercicio = Exercicio::find($id_exercicio);

        $alternativas = Alternativa::where('fk_id_exercicio', $id_exercicio)->get();

        foreach ($alternativas as $alternativa) {
            $alternativa->delete();
        }
     

        $exercicio->delete();
        return redirect()->route('exercicio.list');
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => ' ']);
    }

    }
    public function listar(){
        $rows = Exercicio::paginate(10);
        return view('admin.tabelas.tabela_exercicios', compact('rows'));
    }

    public function listar_para_aluno(){
        $rows = Exercicio::with('alternativas')->get();
        $exs = $this->allExercises; 
        // dd($exs);
        $materias = Materia::all(); 
        $assuntos = Assunto::all();
        // Verifica se há uma resposta certa/errada e a define
        $resposta_certa_errada = session('resposta_certa_errada', null);
        $id_exercicio = session('id_exercicio', null);
        session()->forget(['resposta_certa_errada']);
        session()->forget(['id_exercicio']);
        if (session()->exists('busca')) {
            session()->forget('busca'); 
        }
        return view('aluno.exercicios', compact('rows', 'resposta_certa_errada', 'id_exercicio', 'assuntos', 'materias', 'exs'));
    }
 

    
    // teste buscar de exercicios

    public function buscar(Request $req)
    { 
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = Exercicio::whereRaw('LOWER(descricao_exercicio) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10);

            return view('admin.tabelas.tabela_exercicios', compact('rows'))
            ->appends(['busca' => $busca]);
        }catch (Exception $e){
            dd($e); 
        }
    }

    public function buscar_aluno(Request $req)
    {
        // dd($busca);
        try {
            $busca = $req->all();
            $exs = $this->allExercises;
            $materias = Materia::all(); 
            $assuntos = Assunto::all();
            $resposta_certa_errada = session('resposta_certa_errada', null);
            $id_exercicio = session('id_exercicio', null);
            session()->forget(['resposta_certa_errada']);
            session()->forget(['id_exercicio']);
        
            $query = Exercicio::with('alternativas');
        
            // Construa a consulta dinamicamente com base nas seleções dos campos
            if (isset($busca['Materia']) && $busca['Materia'] != "todos") {
                $query->where('fk_materia', $busca['Materia']);
            }
        
            if (isset($busca['Assunto']) && $busca['Assunto'] != "todos") {
                $query->where('fk_assunto', $busca['Assunto']);
            }
        
            if (isset($busca['Vestibular']) && $busca['Vestibular'] != "todos") {
                $query->where('vestibular', $busca['Vestibular']);
            }
        
            if (isset($busca['Ano']) && $busca['Ano'] != "todos") { 
                $query->where('ano_exercicio', $busca['Ano']); 
            }
            
            // Adicione mais condições para outros campos conforme necessário
           
            $rows = $query->get(); 
            if (session()->exists('busca')) {
                session()->forget('busca'); 
            }
            session()->push('busca', $busca);

            
            
            return view('aluno.exercicios', compact('rows', 'resposta_certa_errada', 'id_exercicio', 'assuntos', 'materias', 'exs'));
        } catch (Exception $e) {
            dd($e); 
        } 
    }        

   
 
} 