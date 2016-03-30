<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Group;
use App\Permission;
use Session;
class GroupController extends Controller
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
            $groups=Group::orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')               
                ->paginate($this->getMaxRows()); 
        }else{
            $groups=Group::orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('group.list')
            ->with('deleted',False)
            ->with('q',$q)
            ->with("groups",$groups);
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
            $groups=Group::onlyTrashed()
                ->orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')                
                ->paginate($this->getMaxRows()); 
        }else{
            $groups=Group::onlyTrashed()
                ->orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('group.list')
            ->with('deleted',True)
            ->with('q',$q)
            ->with("groups",$groups);
        
    }

    
    public function create()
    {
        //crio um objeto em branco
        //pq gosto de usar o mesmo 
        //form para editar e para cadastrar
        //isso facilita a manutencao e o
        //entendimento do sistema        
        $group= new Group();
        return view('group.form')
            ->with('acao',trans('labels.new').' '.trans('labels.group'))    
            ->with('permissions',Permission::all()->lists('name','id')->toArray())      
            ->with("group",$group);
    }

    public function edit($id)
    {
        //envio para a view o grupo para ser 
        //editado
        $group= Group::find($id);
        return view('group.form')
            ->with('acao',trans('labels.edit').' '.$group->name)
            ->with('permissions',Permission::all()->lists('name','id')->toArray())      
            ->with("group",$group);
    }

    public function store(Request $request)
    {        
        $rules =[                
                'name' => 'required|max:30',    
                'nivel' => 'required|digits:1',             
            ];     
        $this->validate($request, $rules); 

        //se tem id entao sera edicao
        if($request->input("id") != ""){
            $acao=trans('labels.edited');
            $group = Group::find($request->input("id"));            
        }else{
            //neste caso nao tem id(else) entao criacao
            $acao=trans('labels.created');
            $group = new Group();           
        }

        //por fim esses campos serao alterados em 
        //qualquer das situacoes de criacao ou edicao
        $group->name = $request->input("name");     
        $group->nivel = $request->input("nivel");      
        if($group->save()){
            $group->permissions()->detach();
            if(count($request->input('permissions')) >0){                    
                    $group->permissions()->sync($request->input('permissions'));
            }   
        }
        Session::flash('message', trans('labels.item').' '.$acao.' '.trans('labels.withSuccess'));
        return redirect()->route('group');
    }

    public function destroy($id)
    {       
        $group = Group::find($id);
        $group->delete();
        Session::flash('message', trans('labels.item').' '.trans('labels.deletedSingle').' '.trans('labels.withSuccess'));
        return redirect()->route('group');
    }

    public function restore($id)
    {
        Group::withTrashed()
        ->where('id', $id)
        ->restore();
        Session::flash('message', trans('labels.item').' '.trans('labels.recovered').' '.trans('labels.withSuccess'));
        return redirect()->route('group');        
    }
}