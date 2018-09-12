@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-4">

        <?php
            if(isset($activity)){
                print_r($activity);
            }
        ?>

        </div>
    </div>



@endsection