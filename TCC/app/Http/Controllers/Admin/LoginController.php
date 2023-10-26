<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('aluno.login');
    }

    public function entrar(Request $req)
    {   
        try{
            $dados = $req->all();

            if(Auth::attempt(['email' => $dados['email'], 'password' => $dados['password']])){
                $user = Auth::user();

                if($user->autenticado === false)
                {
                    $info = new \stdClass();
                    $codigo=rand(10000,99999);
                    $info->email=$dados['email'];
                    $info->nome=$user->name;
                    $info->time=time();
                    $info->codigo=$codigo; 


                    \Illuminate\Support\Facades\Mail::send(new \App\Mail\EnviarEmail($info));

                    return view('email.confirmaremail', compact("info"));
                }
                else {
                    return redirect()->route('home');
                }
            }

            return redirect()->route('aluno.login');
        }catch(Exception $e){
            return view('tela_erro.tela_erro', ['erro' => 'Erro na autenticação.']);
        }
        
    }

    public function sair(){
        session()->forget('exercicios');
        Auth::logout();
        return redirect()->route('aluno.login');
    }
}
