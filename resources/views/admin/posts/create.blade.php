<x-admin-master>

    @section('content')
        <h1>Create</h1>
        <form method="post" action="{{route('post.store')}}" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" aria-describedby="">
            </div>

            <div class="form-group">
                <label for="file">File</label>
                <input type="file" name="post_image" id="post_image" class="form-control-file" placeholder="">
            </div>

            <div class="form-group">
                <textarea name="body" id="body" class="form-control" cols="30" rows="10"></textarea>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>

    @endsection

</x-admin-master>
