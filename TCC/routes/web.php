<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AlunoController;
use App\Http\Controllers\Admin\ProfessorController;
use App\Http\Controllers\Admin\AlternativaController;
use App\Http\Controllers\Admin\AssuntoController;
use App\Http\Controllers\Admin\AulaController;
use App\Http\Controllers\Admin\ExercicioController;
use App\Http\Controllers\Admin\MateriaController;
use App\Http\Controllers\Admin\RedacaoController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\RespostaController;
use App\Http\Controllers\Admin\EmailController;
use App\Http\Controllers\RedacaoCorrigidaController;




/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

////////////////////////// Login ////////////////////////



Route::get('/login', function(){
    return view('aluno.login');
})->name('aluno.login');

Route::post('/login_entrar', [LoginController::class, 'entrar'])->name('aluno.login.entrar');

Route::get('/logout', [LoginController::class, 'sair'])->name('logout');

/////////////////////////////////////////////////////////////

///////////////////////// Mudar senha ////////////////////////

Route::get('/enviar_email', function(){
    return view('senha.enviar_email');
})->name('enviar_email');

Route::post('/gerar_codigo', [EmailController::class, 'gerarCodigo'])->name('gerar_codigo');

Route::post('/confirmar_email_senha', [EmailController::class, 'mudarSenha'])->name('confirmar_email_senha');

//////////////////////////////////////////////////////////////


///////////////////////// Confirmar email ////////////////////////

Route::post('/confirmar_email', [EmailController::class, 'confirmar'])->name('confirmaremail');

//////////////////////////////////////////////////////////////




Route::middleware(['auth.check'])->group(function () {


    Route::middleware(['auth.check.usuario'])->group(function () {
        
        Route::get('/', [ProfessorController::class, 'listar_home'])->name('home');

        Route::get('/Termos', function () {
            return view('aluno.termos'); 
        })->name('termos');
        
        Route::get('/buscar_por_exercicio', [ExercicioController::class, 'buscar_aluno'])->name('exercicio.search_aluno');

        Route::get('/aulas/{nome_materia?}', [AulaController::class, 'apresentar_assuntos'])->name('aulas.apresentar_assuntos');

        Route::get('/listar_exercicio_aluno', [ExercicioController::class, 'listar_para_aluno'])->name('aluno_listar_exercicio');

        Route::get('/buscar_material', [AulaController::class, 'PesquisaExercicio'])->name('aulas.search.assuntoaula');

        Route::post('/salvar_resposta', [RespostaController::class, 'salvar_resposta'])->name('salvar_resposta_aluno'); 

        Route::get('/listar_exercicios', [RespostaController::class, 'listar_exercicios'])->name('listar_exercicios'); 


        Route::get('/listar_redacao_aluno_para_aluno_{cpf}', [RedacaoController::class, 'listar_redacao_aluno_para_aluno'])->name('redacao.list_aluno_para_aluno');

        Route::get('/redacao_enviada/excluir/{id_redacao}/{fk_cpf_aluno}', [RedacaoController::class, 'destroy_redacao_enviada'])->name('admin.redacao_enviada.excluir');

        Route::get('/editar/redacao_enviada/{id_redacao}/edit', [RedacaoController::class, 'edit_redacao_enviada'])->name('admin.redacao_enviada.edit');

        Route::put('/editar/redacao_enviada/{id_redacao}', [RedacaoController::class, 'update_redacao_enviada'])->name('admin.redacao_enviada.update');

        Route::get('/buscar_red_aluno_aluno/{cpf}', [RedacaoController::class, 'buscar_redacao_aluno_aluno'])->name('redacaoalunoaluno.search');

        // Route::get('/redacao_enviada/excluir/{titulo}',[RedacaoController::class, 'destroy_redacao_enviada'])->name('admin.redacao_enviada.excluir');

        // Route::get('/editar/redacao_enviada/{titulo}/edit', [RedacaoController::class, 'edit_redacao_enviada'])->name('admin.redacao_enviada.edit');

        // Route::put('/editar/redacao_enviada/{titulo}', [RedacaoController::class, 'update_redacao_enviada'])->name('admin.redacao_enviada.update');
        Route::get('/buscar_redacao', [RedacaoController::class, 'alunobuscar'])->name('redacaoaluno.search');


        Route::get('/apresentar_redacao', [RedacaoController::class, 'apresentar'])->name('redacao'); //Essa///////////////////////////////////////////////

        Route::get('/apresentar_materia', [MateriaController::class, 'apresentar'])->name('materiais'); //Essa///////////////////////////////////////////////

        Route::get('/editar/redacao_aluno/{titulo}/edit', [RedacaoController::class, 'edit_redacao_aluno'])->name('redacao_aluno.edit');

        Route::post('/salvar_redacao_aluno', [RedacaoController::class, 'update_redacao_aluno'])->name('redacao_aluno.update');

        Route::get('/redirecionar_redacao', [RedacaoCorrigidaController::class, 'redirecionar_redacao'])->name('cadastro-redacoes-corrigidas');

        Route::get('/listar/redacoes_corrigidas/{cpf}', [RedacaoCorrigidaController::class, 'listar_redacoes_corrigidas'])->name('listar.redacoes_corrigidas');

       

    });

    



    Route::middleware(['auth.check.professor'])->group(function () {
        // Professores e admin

        Route::get('/menu_professor', function () {
            return view('professor.menu_professor');
        })->name('menu_professor.adm');

        ////////////////////////// Redação ////////////////////////

        Route::get('/cad_redacoes', function () {
            return view('admin.cadastros.cadRedacao');
        })->name('admin.cadastro_redacao');

        Route::get('/tabela_redacoes', function () {
            return view('admin.tabelas.tabela_redacoes');
        })->name('admin.tabelas.tabela_redacoes');

        Route::post('/salvar_redacao', [RedacaoController::class, 'salvar'])->name('admin.redacaos.salvar');

        Route::post('/salvar_redacao_corrigida', [RedacaoCorrigidaController::class, 'salvar'])->name('admin.redacaos_corrigidas.salvar');

        Route::get('/editar/redacao/{titulo}/edit', [RedacaoController::class, 'edit'])->name('redacao.edit');

        Route::put('/editar/redacao/{titulo}', [RedacaoController::class, 'update'])->name('redacao.update');

        Route::get('/listar_redacao', [RedacaoController::class, 'listar'])->name('redacao.list');

        Route::get('/Professor_buscar_redacao', [RedacaoController::class, 'buscar'])->name('redacao.search');

        Route::get('/redacao/excluir/{titulo}',[RedacaoController::class, 'destroy'])->name('redacao.excluir');

        //Aluno 
        Route::get('/listar_redacao_aluno', [RedacaoController::class, 'listar_redacao_aluno'])->name('redacao.list_aluno');

        Route::get('/buscar_red_aluno_adm', [RedacaoController::class, 'buscar_redaluno'])->name('redacaoalunoadm.search');



        Route::get('/editar/redacao/{titulo}/edit', [RedacaoController::class, 'edit'])->name('admin.redacao.edit');

        Route::put('/editar_redacao/{titulo}', [RedacaoController::class, 'update'])->name('admin.redacao.update');

        Route::get('/admin/redacao/excluir/{titulo}/',[RedacaoController::class, 'destroy'])->name('admin.redacao.excluir');

        Route::get('/listar_redacoes_corrigidas', [RedacaoCorrigidaController::class, 'listar_redacoes_corrigidas_para_professor'])->name('redacao_corrigida.list');

        Route::get('/buscar_redacao_corrigida', [RedacaoCorrigidaController::class, 'buscar'])->name('redacaocorrigida.search');
        

        Route::get('/editar/redacao_corrigida/{id_redacao_corrigida}/edit', [RedacaoCorrigidaController::class, 'edit'])->name('admin.redacao_corrigida.edit');

        Route::put('/editar_redacao_corrigida/{id_redacao_corrigida}', [RedacaoCorrigidaController::class, 'update'])->name('admin.redacao_corrigida.update');

        Route::get('/admin/redacao_corrigida/excluir/{id_redacao_corrigida}/',[RedacaoCorrigidaController::class, 'destroy'])->name('admin.redacao_corrigida.excluir');

        /////////////////////////////////////////////////////////////




        ////////////////////////// Materia ////////////////////////

        Route::get('/cad_materia', function () {
            return view('admin.cadastros.cadMateria');
        })->name('admin.cadastro_materia');

        Route::get('/tabela_materias', function () {
            return view('admin.tabelas.tabela_materias');
        })->name('admin.tabelas.tabela_materias');

        Route::post('/salvar_materia', [MateriaController::class, 'salvar'])->name('admin.materias.salvar');

        Route::get('/editar_materia/{nome_materia}/edit', [MateriaController::class, 'edit'])->name('admin.materia.edit');

        Route::put('/editar_materia/{nome_materia}', [MateriaController::class, 'update'])->name('admin.materia.update');

        Route::get('/admin/aluno/excluir/{nome_materia}',[MateriaController::class, 'destroy'])->name('admin.materia.excluir');

        Route::get('/listar_materia', [MateriaController::class, 'listar'])->name('materia.list');

        Route::get('/buscar_materia', [MateriaController::class, 'buscar'])->name('materia.search');




        /////////////////////////////////////////////////////////////



        ////////////////////////// Exercicios ////////////////////////

        //  Route::get('/cad_exercicios', function () {
        //     return view('admin.cadastros.cadExercicio');
        // })->name('admin.cadastro_exercicio');
        Route::get('/cad_exercicios', [ExercicioController::class, 'ListarAssuntos'])->name('admin.cadastro_exercicio');
        

        Route::get('/tabela_exercicios', function () {
            return view('admin.tabelas.tabela_exercicios');
        })->name('admin.tabelas.tabela_exercicios');

        Route::post('/salvar_exercicio', [ExercicioController::class, 'salvar'])->name('admin.exercicios.salvar');

        Route::get('/listar_exercicio', [ExercicioController::class, 'listar'])->name('exercicio.list');

        Route::get('/buscar_exercicio', [ExercicioController::class, 'buscar'])->name('exercicio.search');

        

        


        Route::get('/editar/exercicio/{id_exercicio}/edit', [ExercicioController::class, 'edit'])->name('admin.exercicio.edit');

        Route::put('/editar_exercicio/{id_exercicio}', [ExercicioController::class, 'update'])->name('admin.exercicio.update');

        Route::get('/admin/exercicio/excluir/{id_exercicio}/',[ExercicioController::class, 'destroy'])->name('admin.exercicio.excluir');


        /////////////////////////////////////////////////////////////

 

        ////////////////////////// Assuntos ////////////////////////

        Route::get('/cad_assunto', [AssuntoController::class, 'listarMaterias'])->name('admin.cadassuntos');

        // Route::get('/cad_assuntos', function () {
        //     return view('admin.cadastros.cadAssunto');
        // })->name('admin.cadastro_assunto');

        Route::get('/tabela_assuntos', function () {
            return view('admin.tabelas.tabela_assuntos'); 
        })->name('admin.tabelas.tabela_assuntos');

        Route::post('/salvar_assunto', [AssuntoController::class, 'salvar'])->name('admin.assuntos.salvar');

        Route::get('/listar_assunto', [AssuntoController::class, 'listar'])->name('assunto.list');

        Route::get('/buscar_assunto', [AssuntoController::class, 'buscar'])->name('assunto.search');

        /* Provavelmente vamos tirar */
        Route::get('/editar_assunto', function () {
            return view('admin.editar.editar_assuntos');
        })->name('editar.assunto');

        Route::get('/editar_assunto/{assunto}/edit', [AssuntoController::class, 'edit'])->name('admin.assunto.edit');

        Route::put('/editar_assunto/{assunto}', [AssuntoController::class, 'update'])->name('admin.assunto.update');

        Route::get('/admin/assunto/excluir/{nome_assunto}',['as'=>'admin.assunto.excluir','uses'=>'App\Http\Controllers\Admin\AssuntoController@destroy']);


        /////////////////////////////////////////////////////////////



        ////////////////////////// Alternativas ////////////////////////

        // Route::get('/cad_alternativas', function () {
        //     return view('admin.cadastros.cadAlternativa');
        // })->name('admin.cadastro_alternativa');;

        Route::get('/cad_alternativas', [AlternativaController::class, 'ListarIDExercicios'])->name('admin.cadastro_alternativa');

        Route::get('/tabela_alternativas', function () {
            return view('admin.tabelas.tabela_alternativas');
        })->name('admin.tabelas.tabela_alternativas');

        Route::post('/salvar_alternativa', [AlternativaController::class, 'salvar'])->name('admin.alternativas.salvar');

        Route::get('/listar_alternativa', [AlternativaController::class, 'listar'])->name('alternativa.list');

        Route::get('/editar/alternativa/{id_alternativa}/edit', [AlternativaController::class, 'edit'])->name('admin.alternativa.edit');

        Route::put('/editar_alternativa/{id_alternativa}', [AlternativaController::class, 'update'])->name('admin.alternativa.update');

        Route::get('/admin/alternativa/excluir/{id_alternativa}/',[AlternativaController::class, 'destroy'])->name('admin.alternativa.excluir');

        Route::get('/buscar_alternativas', [AlternativaController::class, 'buscar'])->name('alternativa.search');

        /////////////////////////////////////////////////////////////



        ////////////////////////// Aulas ////////////////////////

        // Route::get('/cad_aulas', function () {
        //     return view('admin.cadastros.cadAula');
        // })->name('admin.cadastro_aula');;

        Route::get('/cad_aulas', [AulaController::class, 'listarAssuntosMaterias'])->name('admin.cadaulas');

        Route::get('/tabela_aulas', function () {
            return view('admin.tabelas.tabela_aulas');
        })->name('admin.tabelas.tabela_aulas');

        Route::get('/tabela_cursos', function () {
            return view('admin.tabelas.tabela_cursos');
        })->name('admin.tabelas.tabela_cursos');

        Route::post('/salvar_aula', [AulaController::class, 'salvar'])->name('admin.aulas.salvar');

        Route::get('/listar_aula', [AulaController::class, 'listar'])->name('aula.list');

        Route::get('/buscar_aula', [AulaController::class, 'buscar'])->name('aula.search');

        Route::get('/editar_aula/{nome_aula}/edit', [AulaController::class, 'edit'])->name('admin.aula.edit');

        Route::put('/editar_aula/{nome_aula}', [AulaController::class, 'update'])->name('admin.aula.update');

        Route::get('/admin/aula/excluir/{nome_aula}/',[AulaController::class, 'destroy_aula'])->name('admin.aula.excluir');
        

        /////////////////////////////////////////////////////////

    });

    Route::middleware(['auth.check.admin'])->group(function () {
        // Apenas admin

        

        Route::get('/menu_admin', function () {
            return view('admin.menu_admin');
        })->name('menu.adm');

        Route::get('/menu_admin_aluno', function () {
            return view('admin.menu_admin_aluno');
        })->name('menu_aluno.adm');


        ////////////////////////// Alunos ////////////////////////

        Route::get('/tabela_alunos', function () {
            return view('admin.tabelas.tabela_alunos');
        })->name('admin.tabelas.tabela_alunos');

        Route::get('/cad_aluno', function () {
            return view('admin.cadastros.cadAluno');
        })->name('admin.cadastro_aluno');

        Route::get('/listar_aluno', [AlunoController::class, 'listar'])->name('aluno.list');

        Route::get('/buscar_aluno', [AlunoController::class, 'buscar'])->name('aluno.search');

        Route::post('/salvar_aluno', [AlunoController::class, 'salvar'])->name('admin.alunos.salvar');

        Route::get('/editar_aluno/{cpf_aluno}/edit', [AlunoController::class, 'edit'])->name('admin.aluno.edit');

        Route::put('/editar_aluno/{email_aluno}/{cpf_aluno}', [AlunoController::class, 'update'])->name('admin.aluno.update');

        Route::get('/admin/aluno/excluir/{email_aluno}/{cpf_aluno}',[AlunoController::class, 'destroy'])->name('admin.aluno.excluir');

        Route::get('/editar_aluno', function () {
                return view('admin.editar.editar_alunos');
            })->name('admin.editar.editar_alunos');

        /////////////////////////////////////////////////////////////




        ////////////////////////// Professor ////////////////////////
        Route::get('/cad_professores', function () {
            return view('admin.cadastros.cadProfessor');
        })->name('admin.cadastro_professor');

        Route::get('/tabela_professores', function () {
            return view('admin.tabelas.tabela_professores');
        })->name('admin.tabelas.tabela_professores');

        Route::post('/salvar_professor', [ProfessorController::class, 'salvar'])->name('admin.professors.salvar');

        Route::get('/listar_professor', [ProfessorController::class, 'listar'])->name('professor.list');

        Route::get('/buscar_professor', [ProfessorController::class, 'buscar'])->name('professor.search');

        Route::post('/salvar_professor', [ProfessorController::class, 'salvar'])->name('admin.professors.salvar');

        Route::get('/editar_professor/{cpf_professor}/edit', [ProfessorController::class, 'edit'])->name('admin.professor.edit');

        Route::put('/editar_professor/{email_professor}/{cpf_professor}', [ProfessorController::class, 'update'])->name('admin.professor.update');

        Route::get('/admin/professor/excluir/{email_professor}/{cpf_professor}', [ProfessorController::class, 'destroy'])->name('admin.professor.excluir');

        Route::get('/editar_[professor]', function () {
                return view('admin.editar.editar_professor');
            })->name('admin.editar.editar_professor');

        /////////////////////////////////////////////////////////////

        // Route::delete('/excluir_aluno/{aluno}', [AlunoController::class, 'destroy'])->name('admin.alunos.excluir');
        // Route::delete('/excluir_professor/{professor}', [AlunoController::class, 'destroy'])->name('admin.professores.excluir');



    });

    Route::get('/redirect/{page}', function ($page) {
        // Verifique o valor do parâmetro $page e redirecione para a página correspondente
        if ($page === 'home') {
            return redirect()->route('home');
        } elseif ($page === 'redacao') {
            return redirect()->route('redacao');
        } elseif ($page === 'materias') {
            return redirect()->route('materias');
        } elseif ($page === 'exercicios') {
            return redirect()->route('exercicios');
        }
    })->name('redirect');


    // Route::get('/redacao', function () {
    //     return view('aluno.redacao');
    // })->name('redacao');

    Route::get('/materias', function () {
        return view('aluno.materias');
    })->name('aluno.materias');

    Route::get('/exercicio', function () {
        return view('aluno.exercicios');
    })->name('exercicios');

    Route::get('/assunto', function () {
        return view('aluno.assunto');
    })->name('aluno.assunto');


});

