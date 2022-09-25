<x-admin-master>
   @section('content')





   @if (session('role-deleted-message'))

      <div class="alert alert-danger">{{session('role-deleted-message')}}</div>

   @elseif(session('role-message-update'))

      <div class="alert alert-success">{{session('role-message-update')}}</div>
      
   @endif



    <div class="row">
      <div class="col-sm-3">
         <form action="{{route('role.store')}}" method="post">
            @csrf
            <div class="form-group">
               <label for="name">Name</label>
               <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" >

               <div class="invalid-feedback"> 
                  @error('name')

                     <span><strong>{{$message}}</strong></span>
                     
                  @enderror
               </div>

               <br>
               <button type="submit" class="btn btn-primary btn-block col-sm-5">Create</button>
            </div>
         </form>
      </div>



   

      <div class="col-sm-12">
         <div class="card shadow mb-2">

            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Roles</h6>
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
                        @foreach ($roles as $role)
                        <tr>
                           <td>{{$role->id}}</td>
                           <td><a href="{{route('role.edit', $role)}}">{{$role->name}}</a> </td>
                           <td>{{$role->slug}}</td>
                           <td>

                              <form action="{{route('role.destroy', $role)}}" method="post">
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
      </div>
   </div>

   @endsection 
</x-admin-master>