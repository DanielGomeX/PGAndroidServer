@extends('layout.base')
@section('content')
<form method="POST" action="{{ route('pedido_store') }}">
    {!! csrf_field() !!}    
    {!! Form::hidden('id', $objeto->id) !!}
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">Exibir</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name">{{ trans('labels.description') }}</label><br>
                {!! $objeto->name !!}  
               
            </div>
        </div> 

        <div class="col-md-3">
            <div class="form-group btn-sz-3">
                <label for="user_id">{{ trans('labels.user') }}</label><br>
                {!! $objeto->user->name !!}               
            </div>
        </div> 
        
         
    </div>    
    <div class="row">

    

    <table class="table table-striped btn-actions">
      <thead>
        <tr>
          <th class="center">#</th>
          <th>{{ trans('labels.product') }}</th>  
          <th>{{ trans('labels.quantidade') }}</th>   
          <th>{{ trans('labels.unitario') }}</th>    
          <th>{{ trans('labels.total') }}</th>   
          
        </tr>
      </thead>
      <tbody>
        @foreach ($objeto->products as $objeto)
        <tr>
              <td class="center">{{ $objeto->id }} </td>
              <td>{{ $objeto->product->name }} </td> 
              <td>{{ $objeto->quantidade }} </td> 
              <td>{{ $objeto->product->valor }} </td> 
              <td>{{ $objeto->quantidade * $objeto->product->valor}} </td>               
                      
          </tr>    
      @endforeach  
        
    </tbody>
    </table>  



        
    

    </div>
    
  </div>
  <div class="panel-footer"></div>
</div>

</form>
@endsection
