@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-3">


            <h1>Register user</h1>
            <br>

                {!! Form::open(["action" => "MRegController@CreateMobileUser", "method"=> "POST"]) !!}
            @if ($errors->any())
                {{ implode('', $errors->all(':message')) }}
            @endif

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
                            {{Form::text($cfg[$i]["formID"],"",["class" => "form-control reg-input has-success form-input-error", "placeholder" => ""])}}
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