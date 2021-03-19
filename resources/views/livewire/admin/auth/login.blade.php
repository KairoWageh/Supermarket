
<div class="login-box">
	<!-- /.login-logo -->

	<div class="card card-outline card-primary">
	<div class="card-header text-center">
	  <a href="" class="h1"><b>Admin</b>LTE</a>
	</div>
	<div class="card-body">
		<p class="login-box-msg">{{__('signin_to_start_session')}}</p>
		{!! Form::open(['route' => 'login', 'method' => 'post']) !!}
		<!-- {!! Form::token() !!} -->
		@if ($errors->has('email'))
      		<p style="color: red">
                <strong>{{ $errors->first('email') }}</strong>
            </p>
        @endif
		<div class="input-group mb-3">
			{!! Form::email('email', $value = null, ["class"=>"form-control", "placeholder"=>__('email')]) !!}
	      	<div class="input-group-append">
	        	<div class="input-group-text">
	          		<span class="fas fa-envelope"></span>
	        	</div>
	      	</div>
	    </div>
	    @if ($errors->has('password'))
      		<p style="color: red">
                <strong>{{ $errors->first('password') }}</strong>
            </p>
        @endif
	    <div class="input-group mb-3">
          {!! Form::password('password', ["class"=>"form-control", "placeholder"=>__('password')]) !!}
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- /.col -->
          <div class="col-4">
          	  {!!  Form::submit(__('login'), array('class' => 'btn btn-primary btn-block'))  !!} 
          </div>
          <!-- /.col -->
        </div>

		{!! Form::close() !!}
	  	

	  <p class="mb-1">
	    <a href="{{route('password.request')}}">{{__('forgot_my_password')}}</a>
	  </p>
	</div>
	<!-- /.card-body -->
	</div>
	<!-- /.card -->
</div>