@extends('templates.app')

@section('content')
<div class="container">
    <div class="row justify-content-center" style="padding: 50px 0px 50px 0px;">
        <button class="btn btn-primary" id="switch">Switch login method</button>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            @if(isset($msg))
                <p class="alert alert-info">{{$msg}}</p>
            @endif

            <div class="messages">

            </div>

            <div class="code">

            </div>


            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <div class="col-md-6 offset-md-4">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-8 offset-md-6">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="mobilelogin">
                <div class="col-md-10 col-md-offset-3">
                    {!! Form::open(array("action" => "MobileIDController@MobileIDLogin","method"=> "POST","id" =>"mlogin")) !!}
                    <div class="form-group">
                        {{Form::label("MSISDN","MSISDN")}}
                        {{Form::text("msisdn","",["class" => "form-control", "placeholder" => "","id" => "msisdn"])}}
                    </div>

                        <input type="hidden" name="randomcode" value="" id="randomcode">

                        {{Form::submit("Submit",["class" => "btn btn-primary submit","id"=>"submit"])}}


                    {!! Form::close() !!}

                </div>
            </div>
        </div>


    </div>
</div>



<script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
    (function ($) {
        $(document).ready(function() {
            $(".mobilelogin").hide();
            $(".messages").hide();

            $('#switch').on('click', function() {

                if($(".mobilelogin").is(":hidden")){
                    $(".mobilelogin").show();
                    $(".messages").show();
                    $(".card").hide();
                }else{
                    $(".mobilelogin").hide();
                    $(".messages").hide();
                    $(".card").show();
                }
            });
        });
    }(jQuery));
</script>





<script>
    $("#submit").click(function(){
        if(this.id === "submit"){

            $.ajax({
                url: "/code",
                type: "GET",
                async: false,
                data: { _token: '{{ csrf_token() }}' },
                success:function(data){
                    var code = $(".code");

                    var html = "<p class='alert alert-info'> Code shown in your phone: " + data.msg + "</p>";
                    $(code).html(html);

                    //add value to hidden input
                    $("#randomcode").val(data.msg);

                }
            });

            var randomcode = $("#randomcode").val();
            var msisdn = $("#msisdn").val();

            var messages = $(".messages");
            var html = "<div class=\"loader\">Loading...</div>";

            $(messages).html(html);


            $.ajax({
                url: "/mlogin",
                type: "POST",
                data: {
                    msisdn: msisdn,
                    randomcode: randomcode,
                    _token: '{{ csrf_token() }}'
                },
                success:function(data){
                    if(data.success === "true"){
                        window.location.replace("/");

                    }else{
                        var messages = $(".messages");
                        var html = "<p class='alert alert-danger'> You do not have the rights to use this software. </p>";
                        $(messages).html(html);
                    }
                },
                error:function(err){
                    console.log("AJAX ERROR " + JSON.stringify(err,null,2));
                }
            });

          return false; //dont let form submit to php/laravel
        }
    });


</script>


@endsection
