@if (session()->has('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
@if (session()->has('mensaje'))
    <div class="alert alert-warning">
        {{ session('mensaje') }}
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif