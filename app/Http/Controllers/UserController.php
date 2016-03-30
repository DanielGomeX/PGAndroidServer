<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use App\Group;
use Session;
use Auth;
use Input;
use DB;

class UserController extends Controller
{
   

    
   


    public function index(Request $get)
    {        
        //pega todos os usuarios ativos do banco     
        //getMaxRows indica a quantidade de registros por pagina   
        //getMaxRows esta dentro de Controller.php   
        $q = [];
        //se tem $get->input("q") entao é busca....
        if($get->input("q")){
            $q = ['q' => $get->input("q")];
            //fiz testes de sql-inject no where abaixo
            // e o laravel tratou 
            //tudo corretamente ;)
            $users=User::orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')
                ->orWhere('email','like','%'.$get->input("q").'%')
                ->paginate($this->getMaxRows()); 
        }else{
            $users=User::orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('user.list')
            ->with('deleted',False)
            ->with('q',$q)
            ->with("users",$users);
    }

    public function deleted(Request $get)
    {
        //pega todos os usuarios ativos do banco     
        //getMaxRows indica a quantidade de registros por pagina   
        //getMaxRows esta dentro de Controller.php   
        $q = [];
        //se tem $get->input("q") entao é busca....
        if($get->input("q")){
            $q = ['q' => $get->input("q")];
            //fiz testes de sql-inject no where abaixo
            // e o laravel tratou 
            //tudo corretamente ;)
            $users=User::onlyTrashed()
                ->orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')
                ->orWhere('email','like','%'.$get->input("q").'%')
                ->paginate($this->getMaxRows()); 
        }else{
            $users=User::onlyTrashed()
                ->orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('user.list')
            ->with('deleted',True)
            ->with('q',$q)
            ->with("users",$users);
        
    }

    
    public function create()
    {
        //crio um objeto em branco
        //pq gosto de usar o mesmo 
        //form para editar e para cadastrar
        //isso facilita a manutencao e o
        //entendimento do sistema        
        $user= new User();
        return view('user.form')
            ->with('acao',trans('labels.new').' '.trans('labels.user'))  

            ->with("groups",Group::lists('name','id'))       
            ->with("user",$user);
    }

    public function edit($id)
    {
        //envio para a view o usuario para ser 
        //editado
        $user= User::find($id);
        return view('user.form')
            ->with("groups",Group::lists('name','id'))
            ->with('acao',trans('labels.edit').' '.$user->name)
            ->with("user",$user);
    }

    public function store(Request $request)
    {
        //as regras sao:
        //se nao tem ID entao é para criar e tem que ter password
        //se tem ID entao é para alterar, nao precisa de passwod
            //se tem ID e pasword nao vazio, faz o compare e altera o do password banco
            //se tem ID e password em branco, so altera os outros dados
        if($request->input("id") == 0 || $request->input("password") != ""){
            $rules =[
                'email' => 'required|email|unique:users,email,'.$request->input("id").',id|max:255',
                'name' => 'required',
                'group_id' => 'required',
                'password' => 'required|confirmed|min:6',
                'password_confirmation' => 'required',
             ];
        }else{ 
            $rules =[
                'email' => 'required|email|unique:users,email,'.$request->input("id").',id|max:255',
                'name' => 'required',   
                'group_id' => 'required', 

            ];
        }       
        $this->validate($request, $rules); 

        //se tem id entao sera edicao
        if($request->input("id") != ""){
            $acao=trans('labels.edited');
            $user = User::find($request->input("id"));
            //na edicao ter o password sera opcional
            //nao precisa trocar a senha para arrumar o nome
            if($request->input("password") != ""){
                $user->password = bcrypt($request->input("password"));
                $user->senhaapp = md5($this->getPassString().$request->input("password"));
            }
        }else{
            //neste caso nao tem id(else) entao criacao
            $acao=trans('labels.created');
            $user = new User();
            $user->password = bcrypt($request->input("password"));
            $user->senhaapp = md5($this->getPassString().$request->input("password"));
        }

        //por fim esses campos serao alterados em 
        //qualquer das situacoes de criacao ou edicao

        $user->group()->associate(Group::find($request->input("group_id")));


        $user->name = $request->input("name");
        $user->email =  $request->input("email");        
        $user->save();
        Session::flash('message', trans('labels.item').' '.$acao.' '.trans('labels.withSuccess'));
        return redirect()->route('user');
    }

    public function destroy($id)
    {       
        //para evitar que eu seja removido 
        //hahhahahahaah
        if($id == 1){
          Session::flash('message', 'Você não pode remover este usuário.');  
        }else{
            $user = User::find($id);
            $user->delete();
            Session::flash('message', trans('labels.item').' '.trans('labels.deletedSingle').' '.trans('labels.withSuccess'));
        }
        return redirect()->route('user');
    }

    public function restore($id)
    {
        User::withTrashed()
        ->where('id', $id)
        ->restore();
        Session::flash('message', trans('labels.item').' '.trans('labels.recovered').' '.trans('labels.withSuccess'));
        return redirect()->route('user');        
    }




    public function authenticate(Request $request)
    {
        //gosto de fazer a autenticacao manual 
        //para poder colocar os dados do usuario em session
        //assim evita que todas as paginas facao consulta no banco
        //para obter dados como nome, grupo e principalente as permissoes
        if (Auth::attempt(['email' => $request->input("email"), 'password' => $request->input("password")])) {
           $user = Auth::user();           
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



    //get em JSON

    public function getJson(){
        return DB::table('users')->select('id','name', 'email', 'senhaapp')->get();


    }
   
}
