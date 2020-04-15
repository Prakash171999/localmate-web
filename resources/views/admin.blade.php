<!DOCTYPE html>
<html>
	<head>
		<title>
			Admin Login
		</title>

		<link rel="stylesheet" href="{{ asset('adminCSS/admin.css') }}" />

	</head>
	<body>
       
		<div class="wrapper fadeInDown">
            
			<div id="formContent">
			  <!-- Tabs Titles -->
		  
			  <!-- Icon -->
			  <div class="fadeIn first">
				<img src="https://img.icons8.com/bubbles/2x/admin-settings-male.png" style="width:50%, height:60%;" id="icon" alt="User Icon" />
			  </div>
          
                @if(Session::has('flash_message_error'))
                    <div class="alert alert-error alert-block">  
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{!! session('flash_message_error') !!}</strong>
                    </div>   
                @endif  

                @if(Session::has('flash_message_success'))
                    <div class="alert alert-error alert-block">   
                        <button type="button" class="close" data-dismiss="alert">×</button> 
                        <strong>{!! session('flash_message_success') !!}</strong>
                    </div>   
                @endif

			  <!-- Login Form -->
			  <form method="post" action="{{ route('login') }}"> {{ csrf_field() }}
                <input type="text" id="email" class="fadeIn second form-control @error('email') is-invalid @enderror" name="email" placeholder="Your email" type="email" required>
                
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

                <input type="text" id="password" class="fadeIn third form-control @error('password') is-invalid @enderror" name="password" placeholder="Your password" type="password" required>
                
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

				<input type="submit" class="fadeIn fourth" value="Log In">
			  </form>		  
			</div>
		  </div>
	</body>
</html>

<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
