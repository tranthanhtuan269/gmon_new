@extends('layouts.app')

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
                                        <th style="width: 80%">Name</th>
                                        <th style="width: 80%">Job</th>
                                        <th style="width: 10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($apply as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->user }}</td>
                                        <td>{{ $item->job }}</td>
                                        <td>
                                                <div class="btn btn-default btn-xs active-city @if($item->active==1) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                                Unactive
                                                </div>
                                                <div class="btn btn-success btn-xs unactive-city @if($item->active==0) hidden-object @else show-object @endif" data-id="{{ $item->id }}">
                                                Active
                                                </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="pagination-wrapper"> {!! $city->appends(['search' => Request::get('search')])->render() !!} </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
