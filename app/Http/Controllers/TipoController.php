<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Tipo;
use App\Permission;
use Session;

class TipoController extends Controller
{
    protected $all;
    protected $singular;
    protected $newObject;
    protected $rules;
    public function __construct(){
        $this->all = Tipo::orderBy('name');
        $this->singular = 'tipo';
        $this->newObject = new Tipo();  
        $this->rules =[                
                'name' => 'required|max:30',                     
            ];         
    }    

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
            $objetoList=$this->all
                ->where('name','like','%'.$get->input("q").'%')               
                ->paginate($this->getMaxRows()); 
        }else{
            $objetoList=$this->all
                ->paginate($this->getMaxRows()); 
        }       
        return view($this->singular.'.list')
            ->with('deleted',False)
            ->with('q',$q)
            ->with("objetoList",$objetoList);
    }
    
    public function create()
    {
        //crio um objeto em branco
        //pq gosto de usar o mesmo 
        //form para editar e para cadastrar
        //isso facilita a manutencao e o
        //entendimento do sistema        
        $objeto= $this->newObject;
        return view($this->singular.'.form')
            ->with('acao',trans('labels.new').' '.trans('labels.tipo'))              
            ->with('objeto',$objeto);
    }

    public function edit($id)
    {
        //envio para a view o grupo para ser 
        //editado
        $objeto= $this->all->find($id);
        return view($this->singular.'.form')
            ->with('acao',trans('labels.edit').' '.$objeto->name)             
            ->with('objeto',$objeto);
    }

    public function store(Request $request)
    {        
         
        $this->validate($request, $this->rules); 

        //se tem id entao sera edicao
        if($request->input("id") != ""){
            $acao=trans('labels.edited');
            $objeto = $this->all->find($request->input("id"));            
        }else{
            //neste caso nao tem id(else) entao criacao
            $acao=trans('labels.created');
            $objeto = $this->newObject;           
        }

        //por fim esses campos serao alterados em 
        //qualquer das situacoes de criacao ou edicao
        $objeto->name = $request->input("name");           
        $objeto->save();
        Session::flash('message', trans('labels.item').' '.$acao.' '.trans('labels.withSuccess'));
        return redirect()->route($this->singular);
    }

    public function destroy($id)
    {       
        $objeto = $this->all->find($id);
        $objeto->delete();
        Session::flash('message', trans('labels.item').' '.trans('labels.deletedSingle').' '.trans('labels.withSuccess'));
        return redirect()->route($this->singular);
    }   
}