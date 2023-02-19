<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
class   UserController extends Controller
{
    public function index(Request $request)
    {
        return $request->user();
    }

    public function register(Request $request)
    {
        $request->validate([
            'nome'=>'required',
            'sobreNome'=>'required',
            'email'=>'required|email|unique:users',
            'cel'=>'required|unique:users',
            'password'=>'required|confirmed',
            'cidade'=>'required',
            'estado' => 'required',
            'profissao' => 'required',
            'comoConheceuApp' => 'nullable',
            'finalidadeUso' => 'nullable'
        ]);

        $result = User::create([
            'nome'=>$request->nome,
            'sobreNome'=>$request->sobreNome,
            'email'=>$request->email,
            'cel'=>$request->cel,
            'password'=>bcrypt($request->password),
            'cidade'=>$request->cidade,
            'estado'=>$request->estado,
            'profissao'=>$request->profissao,
            'comoConheceuApp'=>$request->comoConheceuApp,
            'finalidadeUso'=>$request->finalidadeUso
        ]);
        return $result;
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        Log::debug("credenciais " . json_encode($credentials));

        if(Auth::attempt($credentials) ){
            $user = Auth::user();
            $token = md5( time() ).'.'.md5($request->email);
            $user->forceFill([
                'api_token'=>$token
                //descobrir como colocar uma duração de tempo nesse token
            ])->save();
            return response()->json([
                'token'=>$token
            ]);
        }

        return response()->json([
            'message'=> 'Dados fornecedios invalidos'
        ]);
    }

    public function logout(Request $request)
    {
        $request->user()->forceFill([
            'api_token'=>null,
        ])->save();

        return response()->json(['message'=>'sucesso']);
    }
}

