@extends('layout.base')
@section('content')


<form method="POST" action="{{ route('user_store') }}">
    {!! csrf_field() !!}    
    {!! Form::hidden('id', $user->id) !!}
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">{!! $acao !!}</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name">{{ trans('labels.name') }}</label>
                {!! Form::text('name', $user->name,array('id'=>'name','class' => 'form-control')) !!}  
                <span class="error-field">{{ $errors->first('name') }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="email">{{ trans('labels.email') }}</label>
                {!! Form::text('email', $user->email,array('id'=>'email','class' => 'form-control')) !!} 
                <span class="error-field">{{ $errors->first('email') }}</span> 
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                <label for="grupo_id">{{ trans('labels.group') }}</label>             
                {!! Form::select('group_id', $groups, $user->group_id,array('id'=>'group_id','class' => 'form-control')) !!}
                <span class="error-field">{{ $errors->first('group_id') }}</span> 
            </div>
        </div>



    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="password">{{ trans('labels.password') }}</label>
                <input type="password" name="password" id="password" class="form-control"> 
                <span class="error-field">{{ $errors->first('password') }}</span> 
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <label for="password_confirmation">{{ trans('labels.confirmacaoPassword') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"> 
                <span class="error-field">{{ $errors->first('password_confirmation') }}</span> 
            </div>
        </div>  

    </div>
    <div class="row btn-sz-2">
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit" >{{ trans('labels.save') }}</button>   
             <a href="{{ route('user')}}" class="btn btn-success">{{ trans('labels.cancel') }}</a>          
        </div> 
       
    </div>
  </div>
  <div class="panel-footer"></div>
</div>

</form>
@endsection