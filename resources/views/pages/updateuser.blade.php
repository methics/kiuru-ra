@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center" style="margin-bottom: 50px;">
        <div class="col col-lg-2">
            <h1>Edit User</h1>

            @if($errors->any())
                <p class="alert alert-danger"><img src="{{URL::asset("images/alert.svg")}}" class="alert-icon">
                    Fill all fields marked with *
                </p>
            @endif

            @if(session()->has("msg"))
                <div class="alert alert-success">
                    {{ session()->get("msg") }}
                </div>
            @endif
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col col-lg-3">

            <h4>User information</h4>

            {!! Form::open(["action" => "MRegController@UpdateUser", "method"=> "POST"]) !!}
            @csrf

            @php ($count = count($cfg))

            @for($i=0;$i<$count;$i++)

                @if($cfg[$i]["label"] == "address")
                    </div>
                    <div class="col col-lg-3">
                    <h4>Address</h4>
                @endif

                <?php
                    $formID = $cfg[$i]["formID"];
                    $mregname = strtolower($cfg[$i]["mregname"]); //for case insensitive array thingy

                        if(isset($data[$mregname])){
                            $placeholder = $data[$mregname];
                        }else{
                            $placeholder = " ";
                        }


                ?>

                <div class="form-group form-control-xl">
                    {{Form::label($cfg[$i]["label"],"")}}

                    <?php if(strpos($cfg[$i]["options"],"required") !== false){
                        echo "<span class='asterisk'>*</span>";
                    }?>

                    @if($errors->has($formID))
                        {{Form::text($cfg[$i]["formID"],$placeholder,["class" => "form-control reg-input form-input-error"])}}
                    @else
                        @if($formID == "msisdn")
                            {{Form::text($cfg[$i]["formID"],$placeholder,["class" => "form-control reg-input","readonly"])}}
                        @else
                            {{Form::text($cfg[$i]["formID"],$placeholder,["class" => "form-control reg-input"])}}
                        @endif
                    @endif
                </div>
            @endfor


            {{Form::submit("Submit",["class" => "btn btn-primary"])}}
            {!! Form::close() !!}

            <button class="btn btn-primary" onclick="goBack()">Back</button>

                    </div>


    </div>

    <script>
        function goBack() {
            window.history.back();
        }
    </script>

@endsection