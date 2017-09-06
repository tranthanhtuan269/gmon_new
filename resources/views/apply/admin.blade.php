@extends('layouts.backend')

@section('content')
    <div class="container">
        <div class="row">
            @include('admin.Msidebar')

            <div class="col-md-9">
                <div class="panel panel-default">
                    <div class="panel-heading">Apply</div>
                    <div class="panel-body">
                        <br/>
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <thead>
                                    <tr>
                                        <th style="width: 10%">ID</th>
                                        <th style="width: 30%">Name</th>
                                        <th style="width: 30%">Job</th>
                                        <th style="width: 20%">Created At</th>
                                        <th style="width: 10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($apply as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td><a href="{{ url('/') }}/curriculumvitae/view/{{ $item->cv_id }}">{{ $item->user }}</a></td>
                                        <td>{{ $item->job }}</td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>
                                                <div class="btn btn-default btn-xs apply-cv @if($item->active==1) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                                UnApply
                                                </div>
                                                <div class="btn btn-success btn-xs unapply-cv @if($item->active==0) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                                Apply
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $apply->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
