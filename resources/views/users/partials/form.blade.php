@csrf
<input class="form-control" type="text" placeholder="Nome" name="name" value="{{$user->name ?? old('name')}}">
<input class="form-control" type="email" name="email" placeholder="email" value="{{$user->email ?? old('name')}}">
<input class="form-control" type="password" name="password" placeholder="Senha">
<input type="file" name="image" class="form-control">
<button type="submit">Editar</button>