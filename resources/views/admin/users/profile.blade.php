<x-admin-master>
    @section('content')
        <h1>{{$user->name}}</h1>
        <div class="row">
            <div class="col-sm-4">
                <form action="{{route('user.profile.update', $user)}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <img class="img-profile rounded-circle" src="https://source.unsplash.com/QAB-WJcbgJk/60x60" height="258px" width="250px">
                    </div>
                    
                    <div class="form-group">
                        <input type="file" name="avatar" class="form-control-file" id="avatar">
                    </div>

                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" 
                        class="form-control @error('username') is-invalid @enderror" 
                        id="username" value="{{$user->username}}">

                        @error('username')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" name="name" 
                        class="form-control @error('name') is-invalid @enderror" 
                        id="name" value="{{$user->name}}">
                        @error('name')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="text" name="email" 
                        class="form-control @error('email') is-invalid @enderror" 
                        id="email" value="{{$user->email}}">
                        @error('email')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" 
                        class="form-control @error('password') is-invalid @enderror" 
                        id="password">
                        @error('password')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirmation">Confirm Password</label>
                        <input type="password" name="password-confirmation" 
                        class="form-control @error('password-confirmation') is-invalid @enderror" 
                        id="password-confirmation">
                        @error('password-confirmation')
                            <div class="invalid-feedback">{{$message}}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Submit</button>

                </form>
            </div>
        </div>
    @endsection
</x-admin-master>