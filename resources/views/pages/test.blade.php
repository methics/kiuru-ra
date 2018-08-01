@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-4">

            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif

            <h1>Register user</h1>
            <br>

            {!! Form::open(["action" => "MRegController@CreateMobileUser", "method"=> "POST"]) !!}

                @php ($count = count($cfg))

                @for($i=0;$i<$count;$i++)
                    @if($cfg[$i]["label"] == "address")
                        <br><h4>Address</h4>
                    @endif

                    <div class="form-group form-control-sm">
                    {{Form::label($cfg[$i]["label"],"")}}
                    {{Form::text($cfg[$i]["formID"],"",["class" => "form-control", "placeholder" => ""])}}
                    </div>
                @endfor



            <br>
            {{Form::submit("Submit",["class" => "btn btn-primary"])}}
            {!! Form::close() !!}

        </div>

    </div>
    </div>

@endsection