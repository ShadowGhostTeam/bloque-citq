@if($errors->any())
    <ul class="alert alert-danger">

        @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
    </ul>

@endif

@if(Session::has('message'))

    <p class="alert alert-success">{{ Session::pull('message')  }}</p>

@endif

@if(Session::has('error'))

    <ul class="alert alert-danger">{{ Session::pull('error')  }}</ul>

@endif