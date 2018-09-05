@extends("templates.app")
@section("content")


    <div class="row justify-content-md-center" style="margin-bottom: 50px;">
        <div class="col col-lg-3">
            <h1>Register user</h1>

            @if($errors->any())
                <p class="alert alert-danger"><img src="{{URL::asset("images/alert.svg")}}" class="alert-icon">
                    Fill all fields marked with *
                </p>
            @endif
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col col-lg-3">

            <h4>User info</h4>

            {!! Form::open(["action" => "MRegController@CreateMobileUser", "method"=> "POST"]) !!}

                @php ($count = count($cfg))

                @for($i=0;$i<$count;$i++)
                    @if($cfg[$i]["label"] == "address")
        </div>
        <div class="col col-lg-3">
                    <h4>Address</h4>
                    @endif

                    <?php $formID = $cfg[$i]["formID"]; ?>

                    <div class="form-group form-control-xl">
                        {{Form::label($cfg[$i]["label"],"")}}

                        <?php if(strpos($cfg[$i]["options"],"required") !== false){
                            echo "<span class='asterisk'>*</span>";
                        }?>

                        @if($errors->has($formID))
                            {{Form::text($cfg[$i]["formID"],"",["class" => "form-control reg-input has-success form-input-error", "placeholder" => ""])}}
                        @else
                            {{Form::text($cfg[$i]["formID"],"",["class" => "form-control reg-input", "placeholder" => ""])}}
                        @endif

                    </div>
                @endfor


        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col col-lg-12 text-center">
            <br><br><br>
            {{Form::submit("Submit",["class" => "btn btn-primary"])}}
            {!! Form::close() !!}
        </div>
    </div>

@endsection