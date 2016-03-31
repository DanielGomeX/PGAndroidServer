@extends('layout.base')
@section('content')
<form method="POST" action="{{ route('pedido_store') }}">
    {!! csrf_field() !!}    
    {!! Form::hidden('id', $objeto->id) !!}
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">{!! $acao !!}</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name">{{ trans('labels.description') }}</label>
                {!! Form::text('name', $objeto->name,array('id'=>'name','class' => 'form-control')) !!}  
                <span class="error-field">{{ $errors->first('name') }}</span>
            </div>
        </div> 

        <div class="col-md-3">
            <div class="form-group btn-sz-3">
                <label for="user_id">{{ trans('labels.tipo') }}</label><br>
                {!! Form::select('user_id', $users , $objeto->user_id ,array('id'=>'user_id', 'class' => 'form-control min-width-1'))  !!}
                <span class="error-field">{{ $errors->first('user_id') }}</span>
            </div>
        </div> 
        
         
    </div>    
    <div class="row">

        <div class="col-md-3">
            <div class="form-group btn-sz-3">
                <label for="productList">{{ trans('labels.product') }}</label><br>
                {!! Form::select('productList', $products , -1 ,array('id'=>'productList', 'class' => 'form-control min-width-1'))  !!}
               
            </div>
        </div> 

         <div class="col-md-1">
            <div class="form-group btn-sz-1">
                <label for="quantidade">{{ trans('labels.quantidade') }}</label><br>
                {!! Form::select('quantidade', [0,1,2,3,4,5,6,7,9,10] , -1 ,array('id'=>'quantidade', 'class' => 'form-control min-width-1'))  !!}
               
            </div>
        </div> 

         <div class="col-md-3">
            <div class="form-group btn-sz-1">
                <label for="">&nbsp;</label><br>
                <button class="btn btn-success" type="button" onclick="javascript:inserir()" >{{ trans('labels.adicionar') }}</button>  
            </div>
        </div>  

    

    </div>
    <div class="row btn-sz-2">
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit" >{{ trans('labels.save') }}</button>   
            <a href="{{ route('pedido')}}" class="btn btn-warning">{{ trans('labels.cancel') }}</a>          
        </div> 
        
    </div>
  </div>
  <div class="panel-footer"></div>
</div>
<input type="hidden" name='produtosSelecionados' id='produtosSelecionados'>
<input type="hidden" name='quantidadesSelecionados' id='quantidadesSelecionados'>
</form>
@endsection

@section('scripts')
<script>
  var produtos = []
  var quantidades = []
  function inserir(){
      if($("#productList").val() > 0 && $("#quantidade").val() >0 ){
        i = produtos.length;
        produtos[i]=$("#productList").val();
        quantidades[i]=$("#quantidade").val();   
        $("#produtosSelecionados").val(produtos) ;
        $("#quantidadesSelecionados").val(quantidades);
      }
      $("#quantidade").val(0);
      $("#productList").val('');
      alert(produtos.length)

     
  }
</script>
@endsection
