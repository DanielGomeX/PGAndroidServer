@extends('layout.base')
@section('content')

         <div id="loginbox" style="margin-top:50px;" class="mainbox col-md-12  col-sm-12 ">                    
            <div class="panel panel-info col-md-offset-3 col-sm-offset-2 col-md-6 col-sm-12" >
                    <div class="panel-heading">
                        <div class="panel-title">{{ trans('labels.signIn') }}</div>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">{{ trans('labels.forgot') }}</a></div>
                    </div>     

                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                        <form method="POST" class="form-horizontal" action="/auth/login">{!! csrf_field() !!}
                       
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" type="text" class="form-control" name="email"  placeholder="username or email" value="">                                        
                                    </div>
                                
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                        <input id="login-password" type="password" class="form-control" name="password" placeholder="password" value="">
                                    
                                </div>
                           

                                
                            <div class="input-group">
                                      <div class="checkbox">
                                        <label>
                                          <input id="login-remember" type="checkbox" name="remember" value="1"> {{ trans('labels.remember') }}
                                        </label>
                                      </div>
                                    </div>


                                <div style="margin-top:10px" class="form-group">
                                    

                                    <div class="col-sm-12 controls btn-sz-2">                                      
                                      <button class="btn btn-primary" type="submit" >{{ trans('labels.login') }}</button>  
                                         @if (count($errors) > 0)
                                           <span class="error-field">
                                               
                                                    @foreach ($errors->all() as $error)
                                                        {{ $error }}
                                                    @endforeach
                                               
                                            </span>
                                        @endif      
                                    </div>
                                </div>


                                  
                            </form>     



                        </div>                     
                    </div>


@endsection