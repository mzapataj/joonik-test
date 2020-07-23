@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
                <form method="GET">
                    @csrf
                    <h4>{{ __('Posts Information') }} </h4>
                    <hr/>
                    <div class="row my-4">
                        <div class="col">
                            <input id="search_fullname"type="text" name="fullname" class="form-control" 
                             value="{{ request()->get('fullname')}}" placeholder="Full Name">
                        </div>
                        <div class="col">
                            <input id="search_title" type="text" name="title" class="form-control" 
                             value="{{ request()->get('title') }}" placeholder="Post Title">
                        </div>
                        <button id="submit_search" type="button" 
                                class="btn btn-primary mb-2" style="margin-right: 10px;">
                                <i class="fa fa-search" aria-hidden="true"></i> Search
                        </button>
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
                    <table class="table-responsive" id="table_posts" width="100%" style="display: none;"> 
                    <thead>
                    <tr>
                        <th scope="col" >Id</th>
                        <th scope="col" >Full name</th>
                        <th scope="col" >Email</th>
                        <th scope="col" >Birth date</th>
                        <th scope="col" data-orderable="false">Post title</th>
                        <th scope="col" class=".d-none .d-sm-block">Post description</th>
                        <th scope="col" >Post datetime</th>
                    </tr>
                    </thead>

                    <tbody>               

                    </tbody>
                    </table>
                </div>
                
        </div>
    </div>
</div>
@endsection
