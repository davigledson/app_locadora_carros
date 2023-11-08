<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //
    public function login(Request $request){
        $credenciais = $request->all(['email','password']);
        $token = auth('api')->attempt($credenciais);
        if($token){ //usuario autenticado com sucesso
            return response()->json(['token'=> $token]);
        } else { //erro de usuário ou senha
           return response()->json(['error'=>'Usuário ou senha invalido '], 403);

           //401 = Unauthorized -> não autorizado
           //403 =forbidden -> proibido (login invalido)
        }
    }
    public function logout(){
        return 'logout';
    }
    public function refresh(){
        return 'refresh';
    }
    public function me(){
        return 'me';
    }
}
