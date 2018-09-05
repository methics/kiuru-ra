@extends("templates.app")
@section("content")

            <div class="row justify-content-md-center">
                <div class="col col-lg-4">

                    @if($errors->any())
                        <h4>{{$errors->first()}}</h4>
                    @endif

                        @if(isset($msg))
                            <p class="alert alert-info">{{$msg}}</p>
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

                    <div class="form-group">
                        {{ Form::label("password","Password") }}
                        {{ Form::password("password",array("class" => "form-control")) }}
                    </div>

                    <div class="form-group">
                        {{ Form::label("password","Confirm Password") }}
                        {{ Form::password("password_confirmation",array("class" => "form-control")) }}
                    </div>

                    {{Form::submit("Update", array("class" => "btn btn-primary")) }}
                    {!! Form::close() !!}

            </div>


        </div>
    </div>
@endsection