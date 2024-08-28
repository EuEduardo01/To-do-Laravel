<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(Request $request) {
        //Auth::user() mostra todos od dados do usuario
        // dd(Auth::user());

        //verifica se esta logado ou não
        if(Auth::check()) {
            return redirect()->route('home');
        }

        return view('login', [
            'notExist' => $request->session()->get('notExist')
        ]);
    }

    public function login_action(Request $request) {
        
        $validator = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt($validator)) {
            return redirect()->route('home');
        } else {
            $request->session()->flash('notExist', 'E-mail e/ou senha não conferem');
            return redirect()->back();
        }
        
    }

    public function register(Request $r) {

        $is_logged_in = Auth::check();
        if($is_logged_in){
            return redirect()->route('home');
        }

        return view('register');
    }

    public function register_action(Request $request) {

        // Regras para registro
        // x O usuario tem que ter um nome 
        // x O email tem que ser unico na tabela users
        // x Todos os campos são REQUIRED
        // x Password tem que ter no minimo 6 caracters
        //*************************** 

        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users', 
            'password' => 'required|min:6|confirmed'
        ]);

        $data = $request->only('name', 'email', 'password');
        $user_created = User::create($data);

        return redirect(route('login'));
    }

    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }

}
