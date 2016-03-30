@extends('layout.base')
@section('content')
@if(Session::has('message'))
	<p class="alert alert-success">{{ Session::get('message') }}</p>
@endif
<div class="panel panel-primary">
	<div class="panel-heading">
		<form  method="get">   
			<div class="row">
				<div class="col-lg-8 col-md-8 col-sm-7 col-xs-12">					
					<h4>{{ trans('labels.users') }} {{ $deleted ? trans('labels.disable') : trans('labels.enable')}}</h4>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-8">
					<input type="text" name="q" placeholder="{{ trans('labels.search') }}" value="{{ count($q) == 1 ? $q['q'] : '' }}" class="form-control" >
				</div>
				<div class="col-lg-1 col-md-1 col-sm-2 col-xs-4">
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
		    	<th class=" center">#</th>
		    	<th>{{ trans('labels.name') }}</th>
		    	<th class="hidden-xs">{{ trans('labels.email') }}</th>
		    	<th class="hidden-xs hidden-sm center">{{ trans('labels.group') }}</th>


		    	<th colspan="2" class="center">{{ trans('labels.actions') }}</th>
		    </tr>
	    </thead>
	    <tbody>
		    @foreach ($users as $user)
				<tr>
			        <td class="center">{{ $user->id }} </td>
			        <td>{{ $user->name }} </td>
			        <td class="hidden-xs">{{ $user->email }} </td>
			        <td class="hidden-xs hidden-sm  center">{{ ($user->group ? $user->group->name : '') }} </td>
			        <td class="col-md-2  center">
			        	<a href="{{ route('user_edit', ['id' => $user->id])}}" class="btn btn-success">
			        		<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			        	</a> 
			        	@if ($deleted)	
			        		<!-- hide no form porque estava atrapalhando o layout da pagina //-->
			        		<form  class="hide" id="theForm_{{ $user->id }}" name="theForm_{{ $user->id }}" method="POST" action="{{ route('user_restore', ['id' => $user->id]) }}">
					    		{!! csrf_field() !!}					    		
				    		</form>
				    	
			        	<a href="javascript:confirRestoreForm('theForm_{{ $user->id }}','{{ $user->name }}')" class="btn btn-warning">
			        		<span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
			        	</a> 
			        	@else	
			        		<!-- hide no form porque estava atrapalhando o layout da pagina //-->
			        		<form class="hide" id="theForm_{{ $user->id }}" name="theForm_{{ $user->id }}" method="POST" action="{{ route('user_delete', ['id' => $user->id]) }}">
					    		{!! csrf_field() !!}				    		
					    	</form>
					    
			        	<a href="javascript:confirDeleteForm('theForm_{{ $user->id }}','{{ $user->name }}')" class="btn btn-danger">
			        		<span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
			        	</a> 
			        	@endif
			        			        	
			        </td>			        
			    </tr>    
		 	@endforeach  
		 	  <tr>
		 		<td colspan="10" class="col-md-1 center">
		 			{!! $users->appends($q)->render() !!}
		 		</td>
		 	</tr>
	 	</tbody>
	  </table>	
  </div>
</div>
@endsection