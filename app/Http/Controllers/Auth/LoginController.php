<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Administrador;

class LoginController extends Controller
{

    public function __construct(){
        //$this->middleware('guest', ['only' => 'showLoginForm']);
    }

    public function showLoginForm(){
        return view('login');
    }

    public function login(Request $request){

        $request->validate([
            'alias' => 'required',
            'password' => 'required'
        ],[
            'alias.required' => 'El nombre de usuarios es requerido.',
            'password.required' => 'La contraseña es requerida.'
        ]);
        $user = Administrador::where('alias','=',$request['alias'])->first();

        if(!$user){
            return back()->withErrors(['errors' => 'No se encuentra el alias.'])->withInput(request(['alias']));
        }else{
            if(MD5($request['password'], $user->contrasena)){
                $request->session()->put('usuario', $user);
                return redirect()->route('home');
            }else{
                return back()->withErrors(['errors' => 'Contraseña incorrecta.'])->withInput(request(['alias']));
            }
        }

        if (Auth::attempt(['alias' => $credentials['alias'], 'password' => $credentials['contrasena']])){
            return redirect()->route('home'); 
        }
        return back()->withErrors(['errors' => 'Las credenciales no coinciden con los registros.'])->withInput(request(['alias']));
    }

    public function logout(){
        if(session()->has('usuario')){
            session()->pull('usuario');
            return redirect('/');
        }
    }

    public function username(){
        return 'alias';
    }

    public function guard(){
        return Auth::guard('administrador');
    }
}
