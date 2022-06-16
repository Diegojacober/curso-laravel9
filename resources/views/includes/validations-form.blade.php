@if ($errors->any())
<ul class="erros">
    @foreach ($errors->all() as $error)
        <li class="error">{{$error}}</li>
    @endforeach
</ul>        
@endif