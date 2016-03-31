<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;
use Session;
use Auth;


class SessionController extends Controller
{
   

    public function authenticate(Request $request)
    {
        //gosto de fazer a autenticacao manual 
        //para poder colocar os dados do usuario em session
        //assim evita que todas as paginas facao consulta no banco
        //para obter dados como nome, grupo e principalente as permissoes
      
        if (Auth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
           $user = Auth::user();          
           session(['user_id' => $user->id]); 
           session(['user_name' => $user->name]);
           session(['user_permissions' => $user->group->permissions()->lists('permission_id')->toArray()]);          
           session(['user_group' => $user->group]);
          
           return redirect()->intended('/');
        }else{            
            return redirect()->intended('/login')
                ->withErrors(array('message' => trans('labels.loginError')));     
                
        }
    }

    public function logout(){
        Auth::logout();
        Session::flush();
        return redirect()->intended('/');
    }
   
}
