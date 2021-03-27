<a class="btn btn-primary" href="{{route('rooms.edit', ['id'=>$id] )}}" >Edit</a>

<form method="post" style="display: inline" action="{{ route('rooms.destroy', ['id' => $id]) }}">
                  @csrf
                  {{ method_field("DELETE") }}
                  <input type="submit" onclick="return confirm ('are you sure?')" class="btn btn-danger" value="Delete"> 
</form>