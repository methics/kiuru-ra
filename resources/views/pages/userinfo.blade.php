@extends("templates.app")
@section("content")
    <div class="row justify-content-md-center">
        <div class="col col-lg-4">

            @if(isset($data))
                <?php
                $fname      = $data["fname"];
                $lname      = $data["surname"];
                $msisdn     = $data["msisdn"];
                $state      = $data["state"];
                $country    = $data["country"];
                $lang       = $data["lang"];
                ?>
            @endif

                @if(isset($msg))
                    <p class="alert alert-info">{{$msg}}</p>
                @endif
                <div class="messages">

                </div>

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
                        <td class="state">{{$state}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Country</th>
                        <td>{{$country}}</td>
                    </tr>
                    <tr>
                        <th scope="row">Language</th>
                        <td>{{$lang}}</td>
                    </tr>


                </tbody>
            </table>

            <?php
            if($state == "ACTIVE"){
                echo "<button type='button' id='deactivate' class='btn btn-primary' role='button'> Deactivate </button>";
            }else{
                echo "<button type='button' id='activate' class='btn btn-primary' role='button'> Activate </button>";
            }
            ?>

            <button type="button" id="test" class="btn btn-primary" role="button">Test</button>
            <a href="/edituser/{{$msisdn}}" class="btn btn-primary">Edit</a>
            <a href="/lookup" class="btn btn-primary" role="button">Back</a>
            <a href="/deleteuser/{{$msisdn}}" class="btn btn-danger confirm" onclick="return confirm('Are you sure?')" id="delete">Delete</a>


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
                                        var messages = $(".messages");

                                        var html = "<p class='alert alert-info'>" + data.msg + "</p>";
                                        $(messages).html(html);
                                    }
                                });

                            });

                        });
                    }(jQuery));
                </script>

                <script>
                    (function ($) {
                        $(document).ready(function() {
                            var url = "<?php echo "/deactivate/" . $msisdn; ?>";

                            $(document).on('click',"#deactivate", function() {

                                var messages = $(".messages");
                                var loader = "<div class=\"loader\">Loading...</div>";

                                $(messages).html(loader);

                                $.ajax({
                                    url,
                                    type: 'GET',
                                    data: { _token: '{{ csrf_token() }}' },
                                    success:function(data){

                                        var html = "<p class='alert alert-info'>" + data.msg + "</p>";
                                        $(messages).html(html);

                                        $(".state").html("INACTIVE");

                                        $("#deactivate").replaceWith("<button type='button' id='activate' class='btn btn-primary' role='button'>Activate</button>");
                                    }
                                });

                            });

                        });
                    }(jQuery));
                </script>

                <script>
                    (function ($) {
                        $(document).ready(function() {
                            var url = "<?php echo "/reactivate/" . $msisdn; ?>"

                            $(document).on('click',"#activate", function() {

                                var messages = $(".messages");
                                var loader = "<div class=\"loader\">Loading...</div>";

                                $(messages).html(loader);


                                $.ajax({
                                    url,
                                    type: 'GET',
                                    data: { _token: '{{ csrf_token() }}' },
                                    success:function(data){

                                        var html = "<p class='alert alert-info'>" + data.msg + "</p>";
                                        $(messages).html(html);

                                        $(".state").html("ACTIVE");

                                        $("#activate").replaceWith("<button type='button' id='deactivate' class='btn btn-primary' role='button'>Deactivate</button>");

                                    }
                                });

                            });

                        });
                    }(jQuery));
                </script>

        </div>
    </div>
@endsection