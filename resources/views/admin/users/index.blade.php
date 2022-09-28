<x-admin-master>
    @section('content')
        <h1>Users</h1>

        @if(session('user-deleted-message'))
          <div class="alert alert-danger">
            {{session('user-deleted-message')}}
          </div> 
        @endif
        
        <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Users</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="users-table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Registered on</th>
                                    <th>Updated profile date</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Username</th>
                                    <th>Avatar</th>
                                    <th>Name</th>
                                    <th>Registered on</th>
                                    <th>Updated profile date</th>
                                    <th>Delete</th>
                                </tr>
                            </tfoot>
                            <tbody id="table_body">
                                   
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


        <script>
//"<form action='@{{route('user.destroy',"+item.id+")}}' method='post'>"+

            $(document).ready(function() {
                const now = Date.now();
                var response = $.ajax({ type: "GET",  
                    url: "{{route('get-all-users')}}",  
                    async: false,
                    success: function (data){
                        for(item of data){
                            const id=item.id;
                            console.log(id);
                            $('#table_body').append(
                                    '<tr>' +
                                        '<td>' + item.id + '</td>' +
                                        '<td>' + '<a href="users/'+item.id+'/profile">' + item.username + '</a></td>' +

                                        '<td>' + '<img src="' + item.avatar + '" alt="" srcset="" height="150px">' + '</td>' +
                                        '<td>' + item.name + '</td>' +

                                        '<td>' +
                                            (new Date(item.created_at)).toLocaleString() +
                                        '</td>' +

                                        '<td>' +
                                            (new Date(item.updated_at)).toLocaleString() +  
                                        '</td>' +

                                        '<td>' +

                                            "<form action=users/"+item.id+"/destroy method='post'>"+
                                                '@csrf'+
                                                '@method("DELETE")'+
                                                '<button type="submit" class="btn btn-danger">Delete</button>'+
                                            '</form>'+

                                        '</td>'+
                                    
                                    '</tr>'
                            )
                        }                        
                    }
                });
            });
        </script>
       
    @endsection

    @section('scripts')
        <!-- Page level plugins -->
        <script src="{{asset('vendor/datatables/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

        <!-- Page level custom scripts -->
        <script src="{{asset('js/demo/datatables-demo.js')}}"></script>


        
    @endsection

</x-admin-master>