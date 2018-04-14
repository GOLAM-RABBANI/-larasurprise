@extends('admin.admin_master')

@section('main_content')
    <div class="card mt-3">
        <div class="card-header">
            <div class="d-inline pr-4 text-uppercase">ALL GALLERIES Image</div>
            <div class="d-inline"><a href="{{route('gposts.create')}}" class="btn btn-outline-primary btn-sm"> Add New
                    +</a></div>
        </div>
        <div class="card-body">
            @if(Session::get('message'))
                <div class="alert alert-success alert-dismissible fade show success_msg" role="alert">
                    <h4>{{Session::get('message')}}</h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            @if(count($errors)>0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <table class="table table-bordered  mt-1">
                <thead class="bg-light">
                <tr>
                    <th scope="col">CAPTION</th>
                    <th scope="col">IMAGE</th>
                    <th scope="col">GALLERY</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">ACTION</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $galleryPosts as $galleryPost)
                    <tr>
                        <td>{{$galleryPost->title}}</td>
                        <td>
                            @if(!empty($galleryPost->image))
                                <img width="100" height="60" src="{{asset('gallery_images/'.$galleryPost->image)}}" alt="image">
                            @endif
                        </td>
                        <td>{{$galleryPost->gallery->title}}</td>
                        <td>
                            @if($galleryPost->publication_status==1)
                                <a class="btn btn-success justify-content-center" href="{{asset('unpublished-gpost/'.$galleryPost->id)}}">
                                    <i class="far fa-thumbs-down"></i>
                                </a>
                            @else
                                <a class="btn btn-danger justify-content-center" href="{{asset('published-gpost/'.$galleryPost->id)}}">
                                    <i class="far fa-thumbs-up"></i>
                                </a>
                            @endif
                        </td>
                        <td>
                            {!! Html::decode(Html::linkRoute('gposts.edit','<i class="far fa-edit"></i>', [$galleryPost->id],['class'=>'btn btn-info','style'=>'float:left; margin-right:5px'])) !!}
                            {!! Form::open(['route'=>['gposts.destroy',$galleryPost->id],'method'=>'DELETE']) !!}
                            {{Form::button( '<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger','onclick'=>'return confirm("Are You Sure You Want To Delete This! ")'])}}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
