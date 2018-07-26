@extends("templates.app")
@section("content")
    <div class="row justify-content-md-center">
        <div class="col col-lg-4">

            @if(isset($data))
                <?php
                $fname = $data["fname"];
                $lname = $data["surname"];
                $msisdn = $data["msisdn"];
                $state = $data["state"];
                ?>
            @endif

            <h2>User info</h2>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Value</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">First Name</th>
                        <td>{{$fname}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Surname</th>
                        <td>{{$lname}}</td>
                    </tr>
                    <tr>
                        <th scope="row">MSISDN</th>
                        <td>{{$msisdn}}</td>
                    </tr>
                    <tr>
                        <th scope="row">State</th>
                        <td>{{$state}}</td>
                    </tr>

                </tbody>
            </table>

            <?php
            if($state == "ACTIVE"){
                echo "<a href='/deactivate/{$msisdn}' class='btn btn-primary btn-lg' role='button'>Deactivate</a>";
            }else{
                echo "<a href='/activate/{$msisdn}' class='btn btn-primary btn-lg' role='button'>Activate</a>";
            }
            ?>
            <a href="/testsignature/{{$msisdn}}" class="btn btn-primary btn-lg" role="button">Test</a>
            <a href="/lookup" class="btn btn-primary btn-lg" role="button">Back</a>

        </div>
    </div>
@endsection