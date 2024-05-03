    @if ($errors->any())
    @foreach ($errors->all() as $error)
    <div class="alert alert-danger">{{$error}}</div>
    @endforeach

    @elseif (session()->has("error"))
    <div class="alert alert-danger">{{session()->get("error")}}</div>
    @endif
