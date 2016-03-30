<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Permission;
use Session;

class PermissionController extends Controller
{
   


    public function index(Request $get)
    {
        //pega todos os grupos ativos do banco     
        //getMaxRows indica a quantidade de registros por pagina   
        //getMaxRows esta dentro de Controller.php  
        
        $q = [];
        //se tem $get->input("q") entao é busca....
        if($get->input("q")){
            $q = ['q' => $get->input("q")];
            //fiz testes de sql-inject no where abaixo
            // e o laravel tratou 
            //tudo corretamente ;)
            $permissions=Permission::orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')               
                ->paginate($this->getMaxRows()); 
        }else{
            $permissions=Permission::orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('permission.list')
            ->with('deleted',False)
            ->with('q',$q)
            ->with("permissions",$permissions);
    }

    public function deleted(Request $get)
    {
        //pega todos os grupos ativos do banco     
        //getMaxRows indica a quantidade de registros por pagina   
        //getMaxRows esta dentro de Controller.php   
        $q = [];
        //se tem $get->input("q") entao é busca....
        if($get->input("q")){
            $q = ['q' => $get->input("q")];
            //fiz testes de sql-inject no where abaixo
            // e o laravel tratou 
            //tudo corretamente ;)
            $permissions=Permission::onlyTrashed()
                ->orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')                
                ->paginate($this->getMaxRows()); 
        }else{
            $permissions=Permission::onlyTrashed()
                ->orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('permission.list')
            ->with('deleted',True)
            ->with('q',$q)
            ->with("permissions",$permissions);
        
    }

    
    public function create()
    {
        //crio um objeto em branco
        //pq gosto de usar o mesmo 
        //form para editar e para cadastrar
        //isso facilita a manutencao e o
        //entendimento do sistema        
        $permission= new Permission();
        return view('permission.form')
            ->with('acao',trans('labels.newa').' '.trans('labels.permission'))          
            ->with("permission",$permission);
    }

    public function edit($id)
    {
        //envio para a view o grupo para ser 
        //editado
        $permission= Permission::find($id);
        return view('permission.form')
            ->with('acao',trans('labels.edit').' '.$permission->name)
            ->with("permission",$permission);
    }

    public function store(Request $request)
    {        
        $rules =[                
                'name' => 'required|max:30', 
                'slug' => 'required|max:30', 
                                       
            ];     
        $this->validate($request, $rules); 

        //se tem id entao sera edicao
        if($request->input("id") != ""){
            $acao=trans('labels.edited');
            $permission = Permission::find($request->input("id"));            
        }else{
            //neste caso nao tem id(else) entao criacao
            $acao=trans('labels.created');
            $permission = new Permission();           
        }

        //por fim esses campos serao alterados em 
        //qualquer das situacoes de criacao ou edicao
        $permission->name = $request->input("name");
        $permission->slug = $request->input("slug");            
        $permission->save();
        Session::flash('message', trans('labels.item').' '.$acao.' '.trans('labels.withSuccess'));
        return redirect()->route('permission');
    }

    public function destroy($id)
    {       
        $permission = Permission::find($id);
        $permission->delete();
        Session::flash('message', trans('labels.item').' '.trans('labels.deletedSingle').' '.trans('labels.withSuccess'));
        return redirect()->route('permission');
    }

    public function restore($id)
    {
        Permission::withTrashed()
        ->where('id', $id)
        ->restore();
        Session::flash('message', trans('labels.item').' '.trans('labels.recovered').' '.trans('labels.withSuccess'));
        return redirect()->route('permission');        
    }
}
