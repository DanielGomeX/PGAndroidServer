@extends('layout.base')
@section('content')
<form method="POST" action="{{ route('group_store') }}">
    {!! csrf_field() !!}    
    {!! Form::hidden('id', $group->id) !!}
<div class="panel panel-primary">
  <div class="panel-heading">
    <h3 class="panel-title">{!! $acao !!}</h3>
  </div>
  <div class="panel-body">
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                <label for="name">{{ trans('labels.description') }}</label>
                {!! Form::text('name', $group->name,array('id'=>'name','class' => 'form-control')) !!}  
                <span class="error-field">{{ $errors->first('name') }}</span>
            </div>
        </div> 
         <div class="col-md-1">
            <div class="form-group">
                <label for="name">{{ trans('labels.level') }}</label>
                     {!! Form::text('nivel', $group->nivel,array('id'=>'nivel','class' => 'form-control max-1')) !!} 
                    <span class="error-field">{{ $errors->first('nivel') }}</span>
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group btn-sz-3">
                <label for="permissions">{{ trans('labels.permissions') }}</label><br>
                {!! Form::select('permissions[]', $permissions , $group->permissions()->lists('permission_id')->toArray() ,array('id'=>'permissions','multiple'=>'multiple', 'class' => 'form-control min-width-1'))  !!}
            </div>
        </div> 
    </div>    
    <div class="row btn-sz-2">
        <div class="col-md-4">
            <button class="btn btn-primary" type="submit" >{{ trans('labels.save') }}</button>   
            <a href="{{ route('group')}}" class="btn btn-warning">{{ trans('labels.cancel') }}</a>          
        </div> 
        
    </div>
  </div>
  <div class="panel-footer"></div>
</div>

</form>
@endsection
@section('scripts')
<script>
  $('#permissions').multiselect({
      maxHeight: 300,
      buttonWidth: '250px',      
      buttonText: function(options, select) {
                if (options.length === 0) {
                    return '{{ trans('labels.noneSelected') }}';
                }else if (options.length === 1) {
                    return options.length + ' - {{ trans('labels.item') }} {{ trans('labels.selected') }}!';
                }else{
                    return options.length + ' - {{ trans('labels.items') }} {{ trans('labels.selecteds') }}!';

                }
            },
      numberDisplayed: 1
  })
</script>
@endsection