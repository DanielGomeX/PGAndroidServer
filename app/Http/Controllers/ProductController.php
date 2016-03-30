<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Product;
use App\Permission;
use Session;
class ProductController extends Controller
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
            $products=Product::orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')               
                ->paginate($this->getMaxRows()); 
        }else{
            $products=Product::orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('product.list')
            ->with('deleted',False)
            ->with('q',$q)
            ->with("products",$products);
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
            $products=Product::onlyTrashed()
                ->orderBy('name')
                ->where('name','like','%'.$get->input("q").'%')                
                ->paginate($this->getMaxRows()); 
        }else{
            $products=Product::onlyTrashed()
                ->orderBy('name')
                ->paginate($this->getMaxRows()); 
        }       
        return view('product.list')
            ->with('deleted',True)
            ->with('q',$q)
            ->with("products",$products);
        
    }

    
    public function create()
    {
        //crio um objeto em branco
        //pq gosto de usar o mesmo 
        //form para editar e para cadastrar
        //isso facilita a manutencao e o
        //entendimento do sistema        
        $product= new Product();
        return view('product.form')
            ->with('acao',trans('labels.new').' '.trans('labels.product'))
            ->with("product",$product);
    }

    public function edit($id)
    {
        //envio para a view o grupo para ser 
        //editado
        $product= Product::find($id);
        return view('product.form')
            ->with('acao',trans('labels.edit').' '.$product->name)
            ->with("product",$product);
    }

    public function store(Request $request)
    {        
        $rules =[                
                'name' => 'required|max:30',    
                'valor' => 'required|max:30',
        ];
        $this->validate($request, $rules); 

        //se tem id entao sera edicao
        if($request->input("id") != ""){
            $acao=trans('labels.edited');
            $product = Product::find($request->input("id"));            
        }else{
            //neste caso nao tem id(else) entao criacao
            $acao=trans('labels.created');
            $product = new Product();           
        }

        //por fim esses campos serao alterados em 
        //qualquer das situacoes de criacao ou edicao
        $product->name = $request->input("name");     
        $product->valor = $request->input("valor");
        $product->save();
        Session::flash('message', trans('labels.item').' '.$acao.' '.trans('labels.withSuccess'));
        return redirect()->route('product');
    }

    public function destroy($id)
    {       
        $product = Product::find($id);
        $product->delete();
        Session::flash('message', trans('labels.item').' '.trans('labels.deletedSingle').' '.trans('labels.withSuccess'));
        return redirect()->route('product');
    }

    public function restore($id)
    {
        Product::withTrashed()
        ->where('id', $id)
        ->restore();
        Session::flash('message', trans('labels.item').' '.trans('labels.recovered').' '.trans('labels.withSuccess'));
        return redirect()->route('product');        
    }
}