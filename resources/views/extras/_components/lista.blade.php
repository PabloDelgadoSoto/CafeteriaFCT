<input type="checkbox" name="{{$extra->id}}">
<label>{{$extra->nombre}}
    @if ($extra->coste_extra==0)
        Gratis
    @else
        + {{$extra->coste_extra}} €
    @endif
</label><br>
