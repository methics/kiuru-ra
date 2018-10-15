@extends("templates.app")
@section("content")

            <div class="row justify-content-md-center">
                <div class="col col-lg-4">

                    @if(Session::has("flash_message"))
                        <p class="alert alert-danger">{{Session::get("flash_message")}}</p>
                    @endif

                    @php
                        $user = Auth::User();
                    @endphp

                    <h2> Editing user: {{Auth::user()->name}}</h2>


                    {{ Form::model($user, array('route' => array('users.update', $user->id), 'method' => 'PUT')) }}{{-- Form model binding to automatically populate our fields with user data --}}

                <div class="form-group">
                    {{ Form::label('name', 'Name') }}
                    {{ Form::text('name', null, array('class' => 'form-control')) }}
                </div>

                <div class="form-group">
                    {{ Form::label('email', 'Email') }}
                    {{ Form::email('email', null, array('class' => 'form-control')) }}
                </div>

                    <a href="#" class="btn btn-warning" onclick="showDiv();" id="pwbutton"> Change Password </a>
                    <br><br>

                    <div class="hidden" id="pwfields">
                        <br>
                        <div class="form-group">
                            {{ Form::label("password","Password") }}
                            {{ Form::password("password",array("class" => "form-control")) }}
                        </div>

                        <div class="form-group">
                            {{ Form::label("password","Confirm Password") }}
                            {{ Form::password("password_confirmation",array("class" => "form-control")) }}
                        </div>
                    </div>

                    {{Form::submit("Update", array("class" => "btn btn-primary")) }}
                        <a href="/" class="btn btn-primary" role="button">Back</a>
                    {!! Form::close() !!}


            </div>


        </div>
    </div>

    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script>


        $(document).ready(function(){
            $("#pwfields").hide();

            $("#pwbutton").click(function(){
                $("#pwfields").toggle();
            });
        });

    </script>
@endsection