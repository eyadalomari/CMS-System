<x-admin-master>
    @section('content')
    
    
        @if(session('permission-message-update'))

            <div class="alert alert-warning">{{session('permission-message-update')}}</div>
        
        @endif

        <div class="row">
            <div class="col-sm-5">
                <h1>Edit Permission: {{$permission->name}} </h1>
            
                <form action="{{route('permission.update', $permission)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$permission->name}}">    
                    </div>
                
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>

    @endsection
</x-admin-master>