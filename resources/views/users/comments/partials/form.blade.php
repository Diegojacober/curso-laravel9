@csrf
<textarea name="body" placeholder="Comentário" cols="30" rows="10">{{$comment->body ?? old('body')}}</textarea>
<label for="visible">
    <input type="checkbox" name="visible" 
    @if (isset($comment) && $comment->visible)
        @checked(true)
    @endif>
    Visível?
</label>
<button type="submit">Enviar</button>