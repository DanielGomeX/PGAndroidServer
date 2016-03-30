@extends('layout.base')
@section('content')
@if(Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif

<div class="panel panel-primary">
	<div class="panel-heading">
		<form  method="get">   
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-6">					
					<h4>{{ trans('labels.group') }}s {{ $deleted ? trans('labels.disable') : trans('labels.enable')}}</h4>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-4">
					<input type="text" name="q" placeholder="{{ trans('labels.search') }}" value="{{ count($q) == 1 ? $q['q'] : '' }}" class="form-control" >
				</div>
				<div class="col-lg-1 col-md-1 col-sm-2 col-xs-2">
					<button type="submit" class="btn btn-success">
				 		<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
				    </button>
			    </div>
			</div>
		</form> 
	</div>
  <div class="panel-body">
  		
	  <table class="table table-striped btn-actions">
	  	<thead>
		    <tr>
		    	<th class="center">#</th>
		    	<th>{{ trans('labels.description') }}</th>		
		    	<th class="center">{{ trans('labels.level') }}</th>    	
		    	<th colspan="2" class="center">{{ trans('labels.actions') }}</th>
		    </tr>
	    </thead>
	    <tbody>
		    @foreach ($groups as $group)
				<tr>
			        <td class="center">{{ $group->id }} </td>
			        <td>{{ $group->name }} </td>	
			        
			        <td class="center">{{ $group->nivel }} </td>				     		        
			        <td class="col-md-2 center">
			        	<a href="{{ route('group_edit', ['id' => $group->id])}}" class="btn btn-success">
			        		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			        	</a> 
			        	@if ($deleted)			        		
			        		<form class="hide" id="theForm_{{ $group->id }}" name="theForm_{{ $group->id }}" method="POST" action="{{ route('group_restore', ['id' => $group->id]) }}">
					    		{!! csrf_field() !!}
					    		<button type="button" class="btn btn-warning" onClick="javascript:confirRestoreForm('theForm_{{ $group->id }}','{{ $group->name }}')">
					    			<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
					    		</button>
				    		</form>
				    		<a href="javascript:confirRestoreForm('theForm_{{ $group->id }}','{{ $group->name }}')" class="btn btn-warning">
				        		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
				        	</a> 
			        	@else	
				    	<form  class="hide" id="theForm_{{ $group->id }}" name="theForm_{{ $group->id }}" method="POST" action="{{ route('group_delete', ['id' => $group->id]) }}">
				    		{!! csrf_field() !!}
				    		<button type="button" class="btn btn-danger" onClick="javascript:confirDeleteForm('theForm_{{ $group->id }}','{{ $group->name }}')">
				    			<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
				    		</button>
				    	</form>
				    	<a href="javascript:confirDeleteForm('theForm_{{ $group->id }}','{{ $group->name }}')" class="btn btn-danger">
			        		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			        	</a> 
				    	@endif
			        </td>			      
			    </tr>    
		 	@endforeach  
		 	  <tr>
		 		<td colspan="10" class="col-md-1 center">
		 			{!! $groups->appends($q)->render() !!}
		 		</td>
		 	</tr>
	 	</tbody>
	  </table>	
  </div>
</div>
@endsection