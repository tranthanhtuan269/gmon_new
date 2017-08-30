@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.sidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Edit Post #{{ $post->id }}</div>
                    <div class="panel-body">
                        <a href="{{ url('/master/post') }}" title="Back"><button class="btn btn-warning btn-xs"><i class="fa fa-arrow-left" aria-hidden="true"></i> Back</button></a>
                        <br />
                        <br />

                        @if ($errors->any())
                            <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        @endif

                        {!! Form::model($post, [
                            'method' => 'PATCH',
                            'url' => ['/master/post', $post->id],
                            'class' => 'form-horizontal',
                            'files' => true
                        ]) !!}

                        <script src="https://cdn.ckeditor.com/4.7.2/standard/ckeditor.js"></script>
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : ''}}">
                                {!! Form::label('title', 'Title', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    {!! Form::text('title', $post->title, ['class' => 'form-control']) !!}
                                    {!! $errors->first('title', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('description') ? 'has-error' : ''}}">
                                {!! Form::label('description', 'Description', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    {!! Form::textarea('description', $post->description, ['class' => 'form-control']) !!}
                                    {!! $errors->first('description', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('category') ? 'has-error' : ''}}">
                                {!! Form::label('category', 'Category', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    {!! Form::select('category', \App\Category::pluck('name', 'id'), $post->category, ['placeholder' => 'Select A Category...', 'class' => 'form-control']) !!}
                                    {!! $errors->first('category', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>
                            <div class="form-group {{ $errors->has('image') ? 'has-error' : ''}}">
                                {!! Form::label('image', 'Image', ['class' => 'col-md-2 control-label']) !!}
                                <div class="col-md-10">
                                    @if($post->image)
                                    <img src="{{ url('/') }}/public/images/{{ $post->image }}" id="avatar-image" class="img" style="background-color: #fff; border: 2px solid gray; border-radius: 5px; width: 100%; height: 300px;">
                                    @else
                                    <img src="http://test.gmon.com.vn/?image=anh_dai_dien.jpg" id="avatar-image" class="img" style="background-color: #fff; border: 2px solid gray; border-radius: 5px; width: 100%; height: 300px;">
                                    @endif
                                    <input type="file" name="imagePost" id="image-img" style="display: none;">
                                    {!! $errors->first('image', '<p class="help-block">:message</p>') !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-offset-2 col-md-2">
                                    {!! Form::submit('Update', ['class' => 'btn btn-primary']) !!}
                                </div>
                            </div>

                            <script>
                                CKEDITOR.replace( 'description' );
                            </script>

                        {!! Form::close() !!}

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
