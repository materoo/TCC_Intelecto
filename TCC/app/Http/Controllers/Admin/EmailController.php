<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\Professor;
use App\Models\Aluno;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class EmailController extends Controller
{
    public function index(){
        return view("admin.email.emailconfirmar",compact("user"));
    }

    public function confirmar(Request $req){
        try{
            //chamar os dados do usuário
            $time=$req->input('time');
            $resposta=$req->input('codigoresp');
            $respostacorreta=$req->input('codigo');
            $email = $req->input('email');
    
            if($resposta==$respostacorreta)
            {
                if (time()-$time<3600)
                {
                    User::where('email', $email)->update(['autenticado' => true]);
    
                    return redirect()->route('home');
                }
                else
                {
                    return redirect()->route('aluno.login');
                }
    
            }
            else{
                return redirect()->route('aluno.login');
            }
        }
        catch(Exception $e)
        {
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao pegar informações do usuário']);
        }
    }

    public function gerarCodigo(Request $req){  

        try{
            $email = $req->all();
    
            $info = new \stdClass();
            $info->email = $email['email'];
            $info->codigo = $codigo=rand(10000,99999);
            $info->time = $time = time();
    
            \Illuminate\Support\Facades\Mail::send(new \App\Mail\EmailSenha($info));
    
            return view('senha.confirmar_email_senha', compact('info'));
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Falha ao gerar código.']);
        }
    
    }

    public function mudarSenha(Request $req){
        try{
            $time = $req->input('time');
            $resposta = $req->input('codigoresp');
            $respostacorreta = $req->input('codigo');

            $email = $req->input('email');
            $senha = bcrypt($req->input('senhaNova'));


            if($resposta == $respostacorreta && time() - $time < 3600)
            {
                if(Professor::where('email_professor', $email))
                {
                    $dados = [
                        'senha_professor' => $senha,
                    ];
                    
                    $user = [
                        'password' => $senha,
                    ];
                    User::where('email', $email)->update($user);

                    Professor::where('email_professor', $email)->update($dados);
                    
                }
                else if(Aluno::where('email_aluno', $email))
                {
                    $dados = [
                        'senha_aluno' => $senha,
                    ];
                    
                    $user = [
                        'password' =>$senha,
                    ];
                    User::where('email', $email)->update($user);
                    
                    Aluno::where('email_aluno', $email)->update($dados);
                }
                
                return view('aluno.login');
            }        
            else 
            {
                return view('tela_erro.tela_erro', ['erro' => 'Resposta incorreta']);
            }
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro ao autenticar.']);
        }
        
    }
}
