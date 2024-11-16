<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

    <style>
        form { margin: 0px 10px; }

        h2 {
        margin-top: 2px;
        margin-bottom: 2px;
        }

        .container { max-width: 360px; }

        .divider {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 5px;
        }

        .divider hr {
        margin: 7px 0px;
        width: 35%;
        }

        .left { float: left; }

        .right { float: right; }
    </style>
</head>
<body style="background-color: #ddd">
    <div class="container" style="margin-top:50px">
        @include('suc_or_err');

		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body">
					<form method="POST" action="{{ url('signin') }}" role="form">
                        @csrf
						<div class="form-group">
							<h2>Login your account</h2>
						</div>

						<div class="form-group">
							<label class="control-label" for="signupEmail">Email</label>
							<input name="email" id="signupEmail" value="{{ old('email') }}" type="email" maxlength="50" class="form-control">
                            @error('email')
                                <div style="margin-top: 10px" class="alert alert-danger">{{ $message }}</div>
                            @enderror

						</div>

						<div class="form-group">
							<label class="control-label" for="signupPassword">Password</label>
							<input name="password" id="signupPassword" type="password" maxlength="25" class="form-control" placeholder="at least 6 characters" length="40">
                            @error('password')
                                <div style="margin-top: 10px" class="alert alert-danger">{{ $message }}</div>
                            @enderror

						</div>




						<div class="form-group">
							<button id="signupSubmit" type="submit" class="btn btn-info btn-block">Login</button>
						</div>
						<p class="form-group">By creating an account, you agree to our <a target="blank" href="https://policies.google.com/terms?hl=en-US">Terms of Use</a> and our <a target="blank" href="https://www.privacyguides.org/en/about/privacy-policy/?gad_source=1&gclid=Cj0KCQiA57G5BhDUARIsACgCYnyXkuyLbHL2ZHXqeYlfjgUMBMJopQv8cYlw65chwygPpZ2aeeef5bYaAp2hEALw_wcB">Privacy Policy</a>.</p>
						<hr>
						<p></p>Haven't any account? <a href="{{ url('register') }}">Click to Register</a></p>
					</form>
				</div>
			</div>
		</div>
	</div>


    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
