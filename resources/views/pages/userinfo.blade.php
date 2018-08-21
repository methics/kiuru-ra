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

                @if(isset($msg))
                    <p class="alert alert-info">{{$msg}}</p>
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
                echo "<a href='/deactivate/{$msisdn}' class='btn btn-primary btn-lg short-button' role='button'>Deactivate</a>";
            }
            ?>
            <a href="edituser/{{$msisdn}}" class="btn btn-primary btn-lg">Edit</a>
                <br><br>

            <a href="/lookup" class="btn btn-primary btn-lg" role="button">Back</a>
            <br><br>

            <button type="button" id="test" class="btn btn-primary btn-lg short-button" role="button">Test</button>

                <script src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
                <script>
                    (function ($) {
                        $(document).ready(function() {
                            var url = "<?php echo "/testsignature/" . $msisdn; ?>"

                            $('#test').on('click', function() {

                                $.ajax({
                                    url,
                                    type: 'GET',
                                    data: { _token: '{{ csrf_token() }}' },
                                    success:function(data){
                                        alert(data.msg);
                                    }
                                });

                            });

                        });
                    }(jQuery));
                </script>
        </div>
    </div>
@endsection