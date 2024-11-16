<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Create Page</title>
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
<body style="background-color: #d5a7a7">
    <div class="container" style="margin-top:50px">
		<div class="row">
			<div class="panel panel-primary">
				<div class="panel-body" style="background-color: rgb(47, 44, 44); color:white">
					<form method="POST" action="{{ url('user/update/'. $user->id) }}" role="form" enctype="multipart/form-data">
                        @csrf
						<div class="form-group">
							<h2>Edit user Account</h2>
						</div>
						<div class="form-group">
							<label class="control-label" for="signupName">Name</label>
							<input name="name" id="signupName" type="text" maxlength="50" class="form-control @error('name') is-invalid @enderror" value="{{ $user->name }}">
                            @error('name')
                                <div style="margin-top: 10px" class="alert alert-danger">{{ $message }}</div>
                            @enderror

						</div>
						<div class="form-group">
							<label class="control-label" for="signupEmail">Email</label>
							<input name="email" id="signupEmail" type="email" maxlength="50" class="form-control @error('email') is-invalid @enderror" value="{{ $user->email }}">
                            @error('email')
                                <div style="margin-top: 10px" class="alert alert-danger">{{ $message }}</div>
                            @enderror

						</div>


						<div class="form-group">
							<label class="control-label" for="signupPasswordagain">Phone Number</label>
							<input name="phone" id="signupPasswordagain" type="number" maxlength="25" class="form-control @error('phone') is-invalid @enderror" value="{{ $user->phone }}" >
                            @error('phone')
                                <div style="margin-top: 10px" class="alert alert-danger">{{ $message }}</div>
                            @enderror

						</div>


						<div class="form-group">
							<label style="margin-right: 20px" class="control-label" for="gender">Gender</label>
							<input style="margin:0 5px" name="gender" value="male" id="gender" type="radio" @if ($user->gender == 'male') {{'checked'}} @endif  >Male
							<input style="margin-left:10px; margin-right:5px" name="gender" value="female" id="gender" type="radio" @if ($user->gender == 'female') {{'checked'}} @endif >Female
						</div>

                        <div class="form-group form-control">
							<label style="margin-right: 10px" class="control-label" for="hobby">Hobby</label>
							<input style="margin-right:2px" name="hobby[]" value="reading"  type="checkbox"@if (in_array('reading', explode(',', $user->hobby))) checked @endif>Reading
							<input style="margin-right:2px" name="hobby[]" value="playing"  type="checkbox" @if (in_array('playing', explode(',', $user->hobby))) checked @endif>Playing
							<input  name="hobby[]" value="gardening" type="checkbox" @if (in_array('gardening', explode(',', $user->hobby))) checked @endif>Gardening

						</div>

                        <div class="col-sm-9">
                            <img id="pro_img" src="{{ $user->image ? asset($user->image) : asset('default/default.png') }}" alt="" style="height: 120px; width:100%; object-fit:contain; border-radius:30px; margin: 10px 0;">
                            <input onchange="document.querySelector('#pro_img').src=window.URL.createObjectURL(this.files[0]) " name="image" type="file" class="form-control mt-2" id="inputEmail3" >

                        </div>



						<div class="form-group">
							<button id="signupSubmit" type="submit" class="btn btn-info btn-block">Update user account</button>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>


    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</body>
</html>
