@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{ trans('subject.subject') }}
@stop
@endsection
@section('page-header')
    <!-- breadcrumb -->
@section('PageTitle')
    {{ trans('subject.add') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-md-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="col-xl-12 mb-30">
                        <div class="card card-statistics h-100">
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (session()->has('add'))
                                <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    <strong>{{ session()->get('add') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                @endif
                                @if (session()->has('edit'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('edit') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif
                                @if (session()->has('delete'))
                                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                        <strong>{{ session()->get('delete') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                @endif

                                <a href="{{route('Subjects.create')}}" class="btn btn-success btn-sm" role="button"
                                   aria-pressed="true">{{ trans('subject.add') }}</a><br><br>
                                <div class="table-responsive">
                                    <table id="" class="table  table-hover table-sm table-bordered p-0"
                                           data-page-length="50"
                                           style="text-align: center">
                                        <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>{{ trans('subject.sub') }}</th>
                                            <th>{{ trans('subject.Grades') }}</th>
                                            <th>{{ trans('subject.class') }}</th>
                                            <th>{{ trans('subject.Name_Teacher') }}</th>
                                            <th>{{ trans('subject.process') }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($subjects as $subject)
                                            <tr>
                                            <td>{{$loop->iteration}}</td>
                                            <td>{{$subject->name}}</td>
                                            <td>{{$subject->grade->name}}</td>
                                            <td>{{$subject->classroom->name_class}}</td>
                                            <td>{{$subject->teacher->name}}</td>
                                                <td>
                                                    <a href="{{route('Subjects.edit',$subject->id)}}" title={{ trans('subject.Edit') }} class="btn btn-info btn-sm" role="button" aria-pressed="true"><i class="fa fa-edit"></i></a>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete_subject{{ $subject->id }}" title={{ trans('subject.Delete') }}><i class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>

                                            <div class="modal fade" id="delete_subject{{$subject->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <form action="{{route('Subjects.destroy','test')}}" method="post">
                                                        {{method_field('delete')}}
                                                        {{csrf_field()}}
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">{{ trans('subject.delete_sub') }}</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <p> {{ trans('subject.Warning_Grade') }}</p>
                                                            <input type="hidden" name="id"  value="{{$subject->id}}">
                                                        </div>
                                                        <div class="modal-footer">
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('subject.Close') }}</button>
                                                                <button type="submit"
                                                                        class="btn btn-danger">{{ trans('subject.submit') }}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- row closed -->
@endsection
@section('js')
    @toastr_js
    @toastr_render
@endsection
