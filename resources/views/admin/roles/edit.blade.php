<x-admin-master>
    @section('content')

    
    <h1>Edit Role: {{$role->name}} </h1>
    
    <form action="{{route('role.update', $role)}}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" value="{{$role->name}}">    
        </div>
       
        <button type="submit" class="btn btn-primary">Save</button>
    </form>
        
    @endsection
</x-admin-master>