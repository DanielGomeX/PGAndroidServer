<!-- Fixed navbar -->
    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container-fluid">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Checkpoint</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Checkpoint</a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">

          @if (session('user_name'))
          <ul class="nav navbar-nav">    
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('labels.acessos') }} <span class="caret"></span></a>
                <ul class="dropdown-menu">
             
                  <li class="dropdown-header">{{ trans('labels.users') }}</li>
                  <li><a href="{{ route('user') }}">{{ trans('labels.list') }}</a></li>              
                  <li><a href="{{ route('user_new') }}">{{ trans('labels.new') }}</a></li>  
                  <li role="separator" class="divider"></li>                
           
                  <li class="dropdown-header">{{ trans('labels.groups') }}</li>
                  <li><a href="{{ route('group') }}">{{ trans('labels.list') }}</a></li>                 
                  <li><a href="{{ route('group_new') }}">{{ trans('labels.new') }}</a></li>  
                  <li role="separator" class="divider"></li>
           
                  <li class="dropdown-header">{{ trans('labels.permissions') }}</li>
                  <li><a href="{{ route('permission') }}">{{ trans('labels.list') }}</a></li>
                  <li><a href="{{ route('permission_new') }}">{{ trans('labels.new') }}</a></li>                 
            
             </ul>
            </li>
            
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('labels.product') }}s <span class="caret"></span></a>
                <ul class="dropdown-menu">
            
                  <li class="dropdown-header">{{ trans('labels.product') }}s</li>
                  <li><a href="{{ route('product') }}">{{ trans('labels.list') }}</a></li>                  
                  <li><a href="{{ route('product_new') }}">{{ trans('labels.new') }}</a></li>  
                  <li role="separator" class="divider"></li>
            
                  <li class="dropdown-header">{{ trans('labels.tipo') }}s</li>
                  <li><a href="{{ route('tipo') }}">{{ trans('labels.list') }}</a></li>                 
                  <li><a href="{{ route('tipo_new') }}">{{ trans('labels.new') }}</a></li>  
                  <li role="separator" class="divider"></li>          

             </ul>
            </li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ trans('labels.pedido') }}s <span class="caret"></span></a>
                <ul class="dropdown-menu">                    
                    <li><a href="{{ route('pedido') }}">{{ trans('labels.list') }}</a></li>                    
                    <li><a href="{{ route('pedido_new') }}">{{ trans('labels.new') }}</a></li>
                </ul>
              </li>
                 
          </ul>
          @endif
          <ul class="nav navbar-nav navbar-right">   
          @if (!Request::is('login')) 
          	@if (!(session('user_name')))
          	<form class="navbar-form navbar-right" action="/auth/login" method="post">
          	 	{!! csrf_field() !!}
	            <div class="form-group">
	              <input type="text" name="email" placeholder="Email" value="cleber@digitalmap.com.br" class="form-control">
	            </div>
	            <div class="form-group">
	              <input type="password" name="password" placeholder="Password" value="123456" class="form-control">
	            </div>
            	<button type="submit" class="btn btn-success">Login</button>
          	</form>            	
          	@else
          		<li class="dropdown">
	              <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ session('user_name')  }} | {{ session('user_group')->name  }} <span class="caret"></span></a>
	              <ul class="dropdown-menu">
	                <li><a href="#">Profile</a></li>
	                <li><a href="#">Trocar Senha</a></li>	                
	                <li role="separator" class="divider"></li>	                
	                <li><a href="/auth/logout">Logout</a></li>
	              </ul>
	            </li> 
            @endif
            @endif
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>
