@extends('layout.base')
@section('content')
<form method="POST" action="{{ route('permission_store') }}">
    {!! csrf_field() !!}    
    {!! Form::hidden('id', $permission->id) !!}
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">{!! $acao !!}</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name">{{ trans('labels.description') }}</label>
                {!! Form::text('name', $permission->name,array('id'=>'name','class' => 'form-control')) !!}  
                <span class="error-field">{{ $errors->first('name') }}</span>
            </div>
        </div> 
         <div class="col-md-3">
            <div class="form-group">
                <label for="slug">slug</label>
                {!! Form::text('slug', $permission->slug,array('id'=>'slug','class' => 'form-control')) !!}  
                <span class="error-field">{{ $errors->first('slug') }}</span>
            </div>
        </div> 
    </div>    
    <div class="row btn-sz-2">
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit" >{{ trans('labels.save') }}</button>   
             <a href="{{ route('permission')}}" class="btn btn-warning">{{ trans('labels.cancel') }}</a>          
        </div> 
       
    </div>
  </div>
  <div class="panel-footer"></div>
</div>

</form>
@endsection
