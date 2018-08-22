@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-3">

            @if($errors->any())
                <p class="alert alert-danger"><img src="{{URL::asset("images/alert.svg")}}" class="alert-icon">
                    Fill all required fields!
                </p>
            @endif

            @if(session()->has('msg'))
                <div class="alert alert-success">
                    {{ session()->get('msg') }}
                </div>
            @endif


            <h1>Edit user</h1>
            <br>

            {!! Form::open(["action" => "MRegController@UpdateUser", "method"=> "POST"]) !!}
            @csrf

            @php ($count = count($cfg))

            @for($i=0;$i<$count;$i++)

                @if($cfg[$i]["label"] == "address")
                    <br><h4>Address</h4>
                @endif

                <?php
                    $formID = $cfg[$i]["formID"];
                    $mregname = strtolower($cfg[$i]["mregname"]); //for case insensitive array thingy
                    $placeholder = $data[$mregname];
                ?>

                <div class="form-group form-control-xl">
                    {{Form::label($cfg[$i]["label"],"")}}

                    <?php if(strpos($cfg[$i]["options"],"required") !== false){
                        echo "<span class='required-mark'>*</span>";
                        //todo: MSISDN cant be changed with this, so it should be readonly
                    }?>


                    @if($errors->has($formID))
                        {{Form::text($cfg[$i]["formID"],$placeholder,["class" => "form-control has-error reg-input reg-input-error"])}}
                    @else

                        {{Form::text($cfg[$i]["formID"],$placeholder,["class" => "form-control reg-input"])}}
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