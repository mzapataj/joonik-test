@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <form action="{{route('posts/search')}}" method="POST">
                    @csrf
                    <h4>{{ __('Posts Information') }} </h4>
                    <hr/>
                    <div class="row my-4">
                        <div class="col">
                            <input type="text" name="fullname" class="form-control" placeholder="Full Name">
                        </div>
                        <div class="col">
                            <input type="text" name="title" class="form-control" placeholder="Post Title">
                        </div>
                        <button type="submit" class="btn btn-primary mb-2"><i class="fa fa-search" aria-hidden="true"></i> Search</button>
                    </div>
                </form>
            


                <!--<div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>-->
                
                <div class="card-body">
                @if (count($posts) > 0)
                    <table class="table-responsive" id="table_posts">
                    <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Full name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Birth date</th>
                        <th scope="col" data-orderable="false">Post title</th>
                        <th scope="col" class="d-none d-sm-block">Post description</th>
                        <th scope="col">Post datetime</th>
                    </tr>
                    </thead>
                    <tbody>
                   
                        @foreach($posts as $post)
                        <tr>
                            <td scope="row">{{$post->author->id}}</td>
                            <td>{{$post->author->first_name." ".$post->author->last_name}}</td>
                            <td><a href="mailto://{{$post->author->email}}">{{$post->author->email}}</a></td>
                            <td>{{date('F m, Y',strtotime($post->author->birthdate))}}</td>
                            <td>{{$post->title}}</td>
                            <td class="d-none d-sm-block">{{$post->description}}</td>
                            <td>{{$post->date?date('F m, Y h:i A',strtotime($post->date)): 'N/A'}}</td>
                        </tr>
                        @endforeach
                  
                    </tbody>
                    </table>
                    @else
                        <div class="row justify-content-center">
                            <h5>No Results</h4>
                        </div>   
                    @endif
                </div>
                
        </div>
    </div>
</div>
@endsection
