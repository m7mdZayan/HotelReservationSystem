<a class="btn btn-info" href={{route('admin.show', $manager->id)}} >View</a>
{{-- value={id} --}}
<a class="btn btn-primary" href={{route('admin.update', $manager->id)}} >Update</a>

<a class="btn btn-danger" href={{route('admin.destroy', $manager->id)}} >Delete</a>
