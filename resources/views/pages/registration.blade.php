@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-3">

            @if($errors->any())
                <p class="alert alert-danger"><img src="{{URL::asset("images/alert.svg")}}" class="alert-icon">
                    Fill all required fields!
                </p>

            @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

            <h1>Register user</h1>
            <br>

                {!! Form::open(["action" => "MRegController@CreateMobileUser", "method"=> "POST"]) !!}


                @php ($count = count($cfg))

                @for($i=0;$i<$count;$i++)
                    @if($cfg[$i]["label"] == "address")
                        <h4>Address</h4>
                    @endif

                    <?php $formID = $cfg[$i]["formID"]; ?>

                    <div class="form-group form-control-xl">
                        {{Form::label($cfg[$i]["label"],"")}}

                        <?php if(strpos($cfg[$i]["options"],"required") !== false){
                            echo "<span class='required-mark'>*</span>";
                        }?>

                        @if($errors->has($formID))
                            <img src="{{URL::asset("images/alert.svg")}}" class="alert-icon">
                        @endif


                        @if($errors->has($formID))
                            {{Form::text($cfg[$i]["formID"],"",["class" => "form-control has-error reg-input reg-input-error", "placeholder" => ""])}}
                        @else
                            {{Form::text($cfg[$i]["formID"],"",["class" => "form-control reg-input", "placeholder" => ""])}}
                        @endif


                    </div>
                @endfor

                <br>
                {{Form::submit("Submit",["class" => "btn btn-primary"])}}
                {!! Form::close() !!}
                <br><br>
        </div>


    </div>

@endsection