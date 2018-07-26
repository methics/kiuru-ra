@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-4">

            @if(isset($msg))
                {{$msg}}
            @endif

            <h1>Register user</h1>
            <br>

            {!! Form::open(["action" => "MRegController@CreateMobileUser", "method"=> "POST"]) !!}
                <div class="form-group form-control-sm">
                    {{Form::label("MSISDN", "MSISDN")}}
                    {{Form::text("msisdn","",["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("First name", "First name")}}
                    {{Form::text("fname","",["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("Last name", "Last name")}}
                    {{Form::text("lname", "", ["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("Language","Language")}}
                    {{Form::text("language", "", ["class" => "form-control", "placeholder" => "default"])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("SSN","SSN")}}
                    {{Form::text("ssn", "", ["class" => "form-control", "placeholder" => ""])}}
                </div>

                    <h3 style="margin-top: 50px;">Address</h3>
                <div class="form-group form-control-sm">
                    {{Form::label("Address line 1","Address")}}
                    {{Form::text("address","", ["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("Address line 2","Address line 2")}}
                    {{Form::text("address2","",["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("City","City")}}
                    {{Form::text("city","", ["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("State/Province","State/Province")}}
                    {{Form::text("stateorprovince","", ["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("Postal code","Postal code")}}
                    {{Form::text("postalcode","", ["class" => "form-control", "placeholder" => ""])}}
                </div>
                <div class="form-group form-control-sm">
                    {{Form::label("Country","Country")}}
                    {{Form::text("country","", ["class" => "form-control", "placeholder" => ""])}}
                </div>
                    <!-- Add country list, maybe http://js.nicdn.de/bootstrap/formhelpers/docs/country.html -->

                    <br>
                    {{Form::submit("Submit",["class" => "btn btn-primary"])}}
                    {!! Form::close() !!}

                </div>

        </div>
    </div>

@endsection