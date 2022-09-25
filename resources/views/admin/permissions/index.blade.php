<x-admin-master>
   @section('content')


    @if(session('permission-created'))

        <div class="alert alert-success">{{session('permission-created')}}</div>

    @elseif(session('permission-message-update'))

        <div class="alert alert-success">{{session('permission-message-update')}}</div>

    @elseif(session('permission-message-delete'))

        <div class="alert alert-danger">{{session('permission-message-delete')}}</div>
        
    @endif

    

      <h2>Permissions</h2>
      <div class="col-sm-3">
         <form action="{{route('permission.store')}}" method="post">
            @csrf
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control">
            <br>
            <button type="submit" class="btn btn-primary btn-block col-sm-5">Create</button>
         </form>
      </div>



      <div class="card shadow mb-4">
         <div class="card-header py-3">
             <h6 class="m-0 font-weight-bold text-primary">Permission</h6>
         </div>
         <div class="card-body">
             <div class="table-responsive">
                 <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                     
                     <thead>
                         <tr>
                           <th>ID</th>
                           <th>Name</th>
                           <th>Slug</th>
                           <th>Delete</th>
                         </tr>
                     </thead>
     
                     <tfoot>
                         <tr>
                             <th>ID</th>
                             <th>Name</th>
                             <th>Slug</th>
                             <th>Delete</th>
                         </tr>
                     </tfoot>
                     
                     <tbody>
                         @foreach ($permissions as $permission)
                         <tr>
                             <td>{{$permission->id}}</td>
                             <td><a href="{{route('permission.edit', $permission)}}">{{$permission->name}}</a></td>
                             <td>{{$permission->slug}}</td>
                             <td>
                                <form action="{{route('permission.delete', $permission->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    
                                    <button type="submit" class="btn btn-danger">Delete</button>
                                </form>
                              
                             </td>
                         </tr>
                         @endforeach
                     </tbody>
                 </table>
             </div>
         </div>
     </div>


   @endsection 
</x-admin-master>