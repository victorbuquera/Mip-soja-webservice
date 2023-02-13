<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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
            'email'=>'required|email|unique:users',
            'cel'=>'required|unique:users',
            'senha'=>'required|confirmed',
            'cidade'=>'required',
            'estado' => 'required',
            'profissao' => 'required',
            'comoConheceuApp' => 'nullable',
            'finalidadeUso' => 'nullable'
        ]);

        $result = User::create([
            'nome'=>$request->nome,
            'email'=>$request->email,
            'cel'=>$request->cel,
            'senha'=>bcrypt($request->senha),
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
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(Auth::attempt($credentials) ){
            $user = Auth::user();
            $token = md5( time() ).'.'.md5($request->email);
            $user->forceFill([
                'api_token'=>$token
            ])->save();
            return response()->json([
                'token'=>$token
            ]);
        }
        //dada

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

