@extends('layouts.app')

    @section('content')
        


        @if(count($posts) > 0)
            @foreach($posts as $post)
            <div class="container d-flex justify-content-center">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card mb-4">
                            <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">
                            <div class="card-body">
                                <h2 class="card-title">{{$post->title}}</h2>
                                <p class="card-text">{{Str::limit($post->body, '50','.....')}}</p>
                                <a href="{{route('post', $post->id)}}" class="btn btn-primary">Read More &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Posted on {{$post->created_at->diffForHumans()}} by
                                <a href="#">{{$post->user->name}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>    
        @endforeach


            <!-- Pagination -->
            {{$posts->links('pagination::bootstrap-4')}}
        @endif
    @endsection


