@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-4">

            @if($errors->any())
                <h4>{{$errors->first()}}</h4>
            @endif

            <h1>Admin dashboard</h1>
            <p>This is available for kiuru-ra-admins only</p>


        </div>
    </div>
@endsection