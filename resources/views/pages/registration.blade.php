@extends("templates.app")
@section("content")

    <h2>Register user</h2>

    {!! Form::open(["action" => "MRegController@CreateMobileUser", "method"=> "POST"]) !!}
        <div class="form-group">
            {{Form::label("MSISDN", "MSISDN")}}
            {{Form::text("msisdn","",["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("First name", "First name")}}
            {{Form::text("fname","",["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("Last name", "Last name")}}
            {{Form::text("lname", "", ["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("Language","Language")}}
            {{Form::text("language", "", ["class" => "form-control", "placeholder" => "fi"])}}
        </div>
        <div class="form-group">
            {{Form::label("SSN","SSN")}}
            {{Form::text("ssn", "", ["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("Address line 1","Address")}}
            {{Form::text("address","", ["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("Address line 2","Address line 2")}}
            {{Form::text("address2","",["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("City","City")}}
            {{Form::text("city","", ["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("State/Province/","State/Province")}}
            {{Form::text("stateorprovince","", ["class" => "form-control", "placeholder" => ""])}}
        </div>
        <div class="form-group">
            {{Form::label("Postal code","Postal code")}}
            {{Form::text("postalcode","", ["class" => "form-control", "placeholder" => ""])}}
        </div>
        <!-- Add country list, maybe http://js.nicdn.de/bootstrap/formhelpers/docs/country.html -->
        <div class="form-group">
            {{Form::label("Country","Country")}}
            {{Form::text("country","", ["class" => "form-control", "placeholder" => ""])}}
        </div>





        {{Form::submit("Submit",["class" => "btn btn-primary"])}}
        {!! Form::close() !!}


@endsection