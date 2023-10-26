<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Assunto;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Exercicio;
use App\Models\RespostaAluno;
use App\Models\Alternativa;
use Illuminate\Http\Request;
use Exception; 


class AssuntoController extends Controller
{
    

    public function salvar(Request $req)
    {
        try {
            $dados = $req->all();
            // dd($dados);
            // $dados['senha_materia'] = Hash::make($dados['senha_materia']);
            Assunto::create($dados);

            return redirect()->route('assunto.list')
            ->with('success', 'Assunto cadastrado com sucesso.');
        
        
        }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Assunto já cadastrado.']);
    }
    }


    public function edit($nome_assunto)
    {
        try {
            $rows = Assunto::where('nome_assunto',$nome_assunto)->get();
            $materias = Materia::all(); 
            return view('admin.editar.editar_assunto', compact('rows', 'materias'));
        } 
        catch (Exception $e) {
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações.']);
        }
    }


    // public function update(Request $request, $nome_assunto)
    // {
    //     try {
    //         $row = $request->only(['nome_assunto', 'carga_horaria']);
    //         $assunto = [
    //             'fk_assunto' => $row['nome_assunto'],
    //         ];
            
            
    //         Assunto::where('nome_assunto', $nome_assunto)->update($row);
    //         Aula::where('fk_assunto', $nome_assunto)->update($assunto);

    //         return redirect()->route('assunto.list')
    //         ->with('success', 'Assunto atualizado com sucesso.');
    //     } 
        
    //     catch (Exception $e) {
    //         return redirect()->route('assunto.list')
    //         ->with('error', 'Erro ao atusalizar assunto.');
    //     }
    // }

    // public function update(Request $request, $nome_assunto) ///////////////NOVOOOOOOO
    // {
  
    //     $assuntoAntigo = Assunto::find($nome_assunto);
    //     $assuntoAntigo->update($request->all());
    //     return redirect()->route('assunto.list');
    // }
    // public function update(Request $request, $nome_assunto)
    // {
    //     // $teste = $request->all();
    //     // $updated = $this->materia->where('num', $num)->update($req->except(['_token', 'method']));
    //     // dd($teste);

    //     $assuntoAntigo = Assunto::find($nome_assunto);
    //     if($request->nome_assunto!=$nome_assunto)
    //     {
    //         $novoAssunto = Assunto::create($request->all());


    //         $aulasAntigas = $assuntoAntigo->aulas;
    //         foreach ($aulasAntigas as $aula) {
    //             $aula->fk_assunto = $novoAssunto->nome_assunto; // Supondo que a chave primária seja 'nome_assunto'
    //             $aula->save();
    //         }

    //         // Atualizar os exercícios associados à matéria antiga
    //         $exerciciosAntigos = $assuntoAntigo->exercicios;
    //         foreach ($exerciciosAntigos as $exercicio) {
    //             $exercicio->fk_assunto = $novoAssunto->nome_assunto; // Supondo que a chave primária seja 'nome_assunto'
    //             $exercicio->save();
    //         }
    //         // $materia = Materia::find($nome_assunto);
    //         $assuntoAntigo->delete();
    //     }
            
    //     return redirect()->route('assunto.list');
    // }

      public function update(Request $request, $nome_assunto) ///////////////NOVOOOOOOO
    {
        try{
            $assuntoAntigo = Assunto::find($nome_assunto);
            $assuntoAntigo->update($request->all());
            return redirect()->route('assunto.list');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao atualizar informações.']);
        }
    }

    public function listarMaterias(){
        $rows = Materia::all();
        // dd($rows);
        return view('admin.cadastros.cadAssunto', compact('rows'));
    }
    
  
        
    public function destroy($nome_assunto)
    {
        try{
        $assunto = Assunto::find($nome_assunto);

        $aulas = Aula::where('fk_assunto', $nome_assunto)->get();

        foreach ($aulas as $aula) {
            $aula->delete();
        }

        $exercicios = Exercicio::where('fk_assunto', $nome_assunto)->get();

        foreach ($exercicios as $exercicio) {
            $comando= $exercicio->id_exercicio;

            $alternativas = Alternativa::where('fk_id_exercicio', $comando)->get();
            $respostas = RespostaAluno::where('fk_id_exercicio', $comando)->get();
            foreach ($alternativas as $alternativa){
                    $alternativa->delete();
            }
            foreach ($respostas as $resposta){
                $resposta->delete();
              }
            $exercicio->delete();
        }
     

        $assunto->delete();
        return redirect()->route('assunto.list');
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Erro ao excluir.']);
    }

    }




    public function listar()
    {
        try {
            $rows = Assunto::paginate(10);
            return view('admin.tabelas.tabela_assuntos', compact('rows'));
        } 
        
        catch (Exception $e) {
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao listar: ' + $e]);
        }
    }


    public function buscar(Request $req)
    {
        $busca = $req->input('busca');
        // dd($busca);
        try{
            $rows = Assunto::whereRaw('LOWER(nome_assunto) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10)
            ->appends(['busca' => $busca]);

            return view('admin.tabelas.tabela_assuntos', compact('rows'));
        }catch (Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao filtrar assuntos.']);
        }
    }
}
