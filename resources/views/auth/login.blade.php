@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login '.(@$user ? @$user :'User')) }}</div>
                <div class="card-body">
                    <form method="POST" id="login-form" >
                        @csrf

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                            <div class="alert d-none alert-danger alert-dismissible fade show">
                                Invalid email or email
                            </div>
                        
           

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="button" class="btn btn-primary login-action">
                                    {{ __('Login') }}
                                </button>

                           
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script>



$(document).on('click', '.login-action', function() {

    var form = $('#login-form');
    var actionUrl = '{{route(@$login_route)}}';
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: "POST",
        url: actionUrl,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            if(data.success==true){
           
                document.cookie = "token=Bearer "+data.user.token;
                document.cookie = "name="+data.user.name;
                document.cookie = "id="+data.user.id;
                document.cookie = "guard="+data.guard;
                $('.alert-dismissible').addClass('d-none'); 
                if(getCookie('guard')=='superadmin'){
                    window.location.href = "http://localhost/gharbar-test/super-admin/index";
                }else{
                    window.location.replace("http://localhost/gharbar-test/"+getCookie('guard')+"/index");
                }
               

            }else{
                $('.alert-dismissible').removeClass('d-none'); 
            }
        }
    });

});
function getCookie(cname) {
  let name = cname + "=";
  let decodedCookie = decodeURIComponent(document.cookie);
  let ca = decodedCookie.split(';');
  for(let i = 0; i <ca.length; i++) {
    let c = ca[i];
    while (c.charAt(0) == ' ') {
      c = c.substring(1);
    }
    if (c.indexOf(name) == 0) {
      return c.substring(name.length, c.length);
    }
  }
  return "";
}
</script>
@endsection
