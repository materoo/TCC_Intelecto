<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Materia;
use App\Models\Aula;
use App\Models\Assunto;
use App\Models\Exercicio;
use App\Models\RespostaAluno;
use App\Models\Alternativa;
use Illuminate\Http\Request;
use Exception; 

class MateriaController extends Controller
{
    public function salvar(Request $req)
    {
        // try {} catch (Exception $e) {} ////// verificar se existe materia.list
        try{
            $dados = $req->all();
            Materia::create($dados);
            return redirect()->route('admin.cadastro_materia');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Matéria já cadastrada.']);
        }
 
    }
    
    

    public function edit($nome_materia)
    {
        try{
        $linhas = Materia::where('nome_materia', $nome_materia)->get();
        return view('admin.editar.editar_materia', compact('linhas'));

    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações.']);
    }
    }

    // public function update(Request $request, $nome_materia)
    // {
    //     // $updated = $this->materia->where('num', $num)->update($req->except(['_token', 'method']));


    //     $materiaAntiga = Materia::find($nome_materia);
    //     if($request->nome_materia!=$nome_materia)
    //     {
    //         $novaMateria = Materia::create($request->all());

    //         $assuntosAntigos = $materiaAntiga->assuntos;
    //         foreach ($assuntosAntigos as $assunto) {
    //             $assunto->fk_materia = $novaMateria->nome_materia;
    //             $assunto->save();
    //         }

    //         $aulasAntigas = $materiaAntiga->aulas;
    //         foreach ($aulasAntigas as $aula) {
    //             $aula->fk_materia = $novaMateria->nome_materia; // Supondo que a chave primária seja 'nome_materia'
    //             $aula->save();
    //         }

    //         // Atualizar os exercícios associados à matéria antiga
    //         $exerciciosAntigos = $materiaAntiga->exercicios;
    //         foreach ($exerciciosAntigos as $exercicio) {
    //             $exercicio->fk_materia = $novaMateria->nome_materia; // Supondo que a chave primária seja 'nome_materia'
    //             $exercicio->save();
    //         }
    //         $materia = Materia::find($nome_materia);
    //         $materiaAntiga->delete();
    //     }
    //     return redirect()->route('materia.list');
    // }

    
public function update(Request $request, $nome_materia) ///////////////NOVOOOOOOO
    {
        try{
        $materia = Materia::find($nome_materia);
        $materia->update($request->all());
        return redirect()->route('materia.list');
    }catch(Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Erro ao atualizar']);
    }
    }


    public function destroy($nome_materia)
    {
        try{
            $materia = Materia::find($nome_materia);

            $aulas = Aula::where('fk_materia', $nome_materia)->get();

            foreach ($aulas as $aula) {
                $aula->delete();
            }

            $exercicios = Exercicio::where('fk_materia', $nome_materia)->get();

            foreach ($exercicios as $exercicio) {
                $comando= $exercicio->id_exercicio;

                $alternativas = Alternativa::where('fk_id_exercicio', $comando)->get();
                foreach ($alternativas as $alternativa){
                        $alternativa->delete();
                }
                $exercicio->delete();
            }
            $assuntos = Assunto::where('fk_materia', $nome_materia)->get();

            foreach ($assuntos as $assunto) {
                $assunto->delete();
            }

            $materia->delete();
            return redirect()->route('materia.list');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao excluir.']);
        }

    }
    public function listar()
    {
        $rows = Materia::paginate(10); // Paginação com 10 registros por página

        return view('admin.tabelas.tabela_materias', ['rows' => $rows]);
    }

public function buscar(Request $req)
{
    $busca = $req->input('busca');
    // dd($busca);
    try{
        // $rows = Materia::whereRaw('LOWER(nome_materia) LIKE ?', ['%' . strtolower($busca) . '%'])->paginate(10);
        $rows = Materia::whereRaw('LOWER(nome_materia) LIKE ?', ['%' . strtolower($busca) . '%'])
        ->paginate(10)
        ->appends(['busca' => $busca]);
        return view('admin.tabelas.tabela_materias', ['rows' => $rows]);
    }catch (Exception $e){
        return view('tela_erro.tela_erro', ['erro' => 'Erro ao buscar.']);
    }
}


    public function apresentar(){
        $rows = Materia::paginate(10);
        // dd($rows);
        return view('aluno.materias', compact('rows')); 
    }

 
}
