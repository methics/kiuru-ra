@extends("templates.app")
@section("content")


    <div class="row justify-content-md-center" style="margin-bottom: 50px;">
        <div class="col col-lg-3">

            <div class="messages">

            </div>

            <h1>Register user</h1>

            @if($errors->any())
                <p class="alert alert-danger"><img src="{{URL::asset("images/alert.svg")}}" class="alert-icon">
                    Fill all fields marked with *</p>
                <p>{{$errors->first()}}</p>
            @endif
        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col col-lg-3">

            <h4>User info</h4>
            {!! Form::open(array("action" => "MRegController@CreateMobileUser","method"=> "POST","id" =>"register")) !!}

            @php ($count = count($cfg))

            @for($i=0;$i<$count;$i++)

                <?php

                if(isset($cfg[$i]["formID"])){
                    $formID = $cfg[$i]["formID"];
                }else{
                    continue;
                }

                if(isset($cfg[$i]["label"])){
                    $label = $cfg[$i]["label"];
                }else{
                    continue;
                }

                if(isset($cfg[$i]["options"])){
                    $options = $cfg[$i]["options"];
                }else{
                    continue;
                }
                ?>

                @if(isset($label) && $label == "address")
        </div>
        <div class="col col-lg-3">
            <h4>Address</h4>
            @endif


            <div class="form-group form-control-xl">
                {{Form::label($label,"")}}

                <?php if(strpos($options,"required") !== false){
                    echo "<span class='asterisk'>*</span>";
                }?>

                @if($errors->has($formID))
                    {{Form::text($formID,"",["class" => "form-control reg-input has-success form-input-error", "placeholder" => ""])}}
                @else
                    {{Form::text($formID,"",["class" => "form-control reg-input", "placeholder" => ""])}}
                @endif

            </div>

            <?php unset($formID); unset($label); unset($options);?>
            @endfor


        </div>
    </div>

    <div class="row justify-content-md-center">
        <div class="col col-lg-12 text-center">
            <br><br><br>
            <button type="reset" value="Reset" class="btn btn-warning">Reset</button>
            {{Form::submit("Submit",["class" => "btn btn-primary submit","id"=>"submit"])}}
            {!! Form::close() !!}
        </div>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <script>

        $("#submit").click(function() {
            if (this.id === "submit") {

                var messages = $(".messages");
                var html = "<div class=\"loader\">Loading...</div>";
                var formdata = $("#register").serialize();

                $(messages).html(html);

                $.ajax({
                    url: "/reg",
                    type: "POST",
                    data: {
                        formdata: formdata,
                        _token: "{{ csrf_token() }}"
                    },
                    success: function (data) {

                        if (data.msg === "success") {

                            window.location.replace("/getlookup/" + data.msisdn);

                        }else if(data.msg === "User exists"){
                            var url = "/edituser/" + data.msisdn;
                            window.location.replace(url);

                        } else {
                            var messages = $(".messages");
                            var html = "<p class='alert alert-danger'>ERROR: " + data.msg +  "</p>";
                            $(messages).html(html);
                        }
                    },
                    error: function (err) {
                        console.log("AJAX ERROR " + JSON.stringify(err, null, 2));
                    }
                });

                return false; //dont let form submit to php/laravel
            }
        });



    </script>
@endsection