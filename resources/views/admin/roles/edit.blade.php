<x-admin-master>
    @section('content')
    
    
        @if(session('role-message-update'))

            <div class="alert alert-warning">{{session('role-message-update')}}</div>
        
        @endif

        <div class="row">
            <div class="col-sm-5">
                <h1>Edit Role: {{$role->name}} </h1>
            
                <form action="{{route('role.update', $role)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{$role->name}}">    
                    </div>
                
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>




        @if($permissions->isNotEmpty())

            <div class="row">
                <div class="col-lg-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Permissions</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    
                                    <thead>
                                        <tr>
                                            <th>Options</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Attach</th>
                                            <th>Detach</th>
                                        </tr>
                                    </thead>
                    
                                    <tfoot>
                                        <tr>
                                            <th>Options</th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Slug</th>
                                            <th>Attach</th>
                                            <th>Detach</th>
                                        </tr>
                                    </tfoot>
                                    
                                    <tbody>
                                        @foreach ($permissions as $permission)
                                        <tr>
                                            <td><input type="checkbox" name="" id=""
                                                @foreach($role->permissions as $role_permission)
                                                    @if($role_permission->slug == $permission->slug)
                                                        checked
                                                    @endif
                                                @endforeach
                                                
                                                
                                                ></td>
                                            <td>{{$permission->id}}</td>
                                            <td>{{$permission->name}}</td>
                                            <td>{{$permission->slug}}</td>
                                            <td>
                                                <form action="{{route('role.permission.attach', $role)}}" method="post">
                                                    @csrf
                                                    @method('PUT')
                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button 
                                                        type="submit"
                                                        class="btn btn-primary"
                                                        @if($role->permissions->contains($permission))
                                                            disabled
                                                        @endif
                                                    >Attach</button>
                                                </form>
                                            </td>

                                            <td>
                                                <form action="{{route('role.permission.detach', $role)}}" method="post">
                                                    @csrf
                                                    @method('PUT')

                                                    <input type="hidden" name="permission" value="{{$permission->id}}">
                                                    <button 
                                                        type="submit" 
                                                        class="btn btn-danger"
                                                        @if (!$role->permissions->contains($permission))
                                                            disabled
                                                        @endif
                                                    >Detach</button>
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
    @endif

    @endsection
</x-admin-master>