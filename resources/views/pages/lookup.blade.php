@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-4">

        @if($errors->any())
                <p class="alert alert-danger">{{$errors->first()}}</p>
        @endif

            @if(isset($msg))
                <p class="alert alert-info">{{$msg}}</p>
            @endif

        <h2>Lookup user</h2>


        {!! Form::open(["action" => "MRegController@LookupUser", "method"=> "POST"]) !!}
            <div class="form-group">
                {{Form::label("MSISDN","MSISDN")}}
                {{Form::text("msisdn","",["class" => "form-control", "placeholder" => ""])}}

            </div>
        {{Form::submit("Submit",["class" => "btn btn-primary"])}}
        {!! Form::close() !!}

        </div>
    </div>
@endsection