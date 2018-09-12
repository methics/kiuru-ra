@extends("templates.app")
@section("content")

    <div class="row justify-content-md-center">
        <div class="col col-lg-11">



            <h4>Search</h4>
            <input name="search" type="text">
            <br><br>
            <h1>Activity Logs
                <a href="/logs/all" class="btn btn-default pull-right">All</a>
                <a href="/logs/createmobileuser" class="btn btn-default pull-right">Create mobileuser</a>
                <a href="/logs/editmobileuser" class="btn btn-default pull-right">Edits</a>
                <a href="/logs/lookup" class="btn btn-default pull-right">Lookups</a>
                <a href="/logs/deletemobileuser" class="btn btn-default pull-right">Deletes</a>
                <a href="/logs/login" class="btn btn-default pull-right">Logins</a>
            </h1>
            <hr>




            <br>




            <div class="table-responsive">
                <table class="table table-bordered table-striped">

                    <thead>
                    <tr>
                        <th>Log name</th>
                        <th>Description</th>
                        <th>Date/Time Added</th>
                        <th>IP-address</th>
                        <th>User ID & Name</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach ($activities as $activity)
                        <tr>
                            <td>{{ $activity->log_name }}</td>
                            <td>{{ $activity->description }}</td>
                            <td>{{ $activity->created_at->format('F d, Y h:ia') }}  - ( {{$activity->created_at->diffForHumans()}} )</td>
                            <td>{{ $activity->getExtraProperty("IP") }}</td>
                            <td>{{ $activity->causer_id }}</td>
                        </tr>
                    @endforeach
                    </tbody>

                </table>
            </div>

        </div>
    </div>



@endsection