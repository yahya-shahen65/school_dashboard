@extends('layouts.master')
@section('css')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
@endsection
@section('title')
    {{trans('Classrooms_trans.class')}}
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('Classrooms_trans.class')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('sidebars.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Classrooms_trans.class')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-xl-12 mb-30">
        <div class="card card-statistics h-100">
            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" >
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
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
                <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                    {{ trans('Classrooms_trans.add_class') }}
                    </button>
            <button type="button" class="button x-small" id="btn_delete_all">
                {{ trans('Classrooms_trans.delete_all') }}
                </button>
            <br><br>
            <form action={{route('filter')}} method="POST">
                @csrf
                <div class="input-group">
                    <select class="custom-select" name="Grade_id" onchange="this.form.submit()">
                        <option selected disabled >{{trans('Classrooms_trans.search_by_grade_name')}}</option>
                        @foreach (  $grades as $g)
                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                        @endforeach
                    </select>
                </div>
            </form>
            <br>
          <div class="table-responsive">
          <table id="data" class="table table-striped table-bordered p-0">
            <thead>
                <tr>
                    <th><input type="checkbox" name="select_all" id="example-select-all" onclick="checkAll('box1',this)"></th>
                    <th>#</th>
                    <th>{{ trans('Classrooms_trans.name') }}</th>
                    <th>{{ trans('Classrooms_trans.grade') }}</th>
                    <th>{{ trans('Classrooms_trans.process') }}</th>
                </tr>
            </thead>
            <tbody>
                <?php $i=0?>
                @foreach ($Classrooms as $Classrooms)
                    <tr>
                        <td><input type="checkbox" class="box1" value={{$Classrooms->id}}></td>
                        <td>{{++$i}}</td>
                        <td>{{$Classrooms->name_class}}</td>
                        <td>{{$Classrooms->grade->name}}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{ $Classrooms->id }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                data-target="#delete{{ $Classrooms->id }}"
                                title="{{ trans('Grades_trans.Delete') }}"><i
                                    class="fa fa-trash"></i></button>
                        </td>
                    </tr>
                    <div class="modal fade" id="edit{{ $Classrooms->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('Classrooms_trans.edit_Grade') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <!-- add_form -->
                                    <form action="{{ route('Classrooms.update', 'test') }}" method="post">
                                        {{ method_field('patch') }}
                                        @csrf
                                        <div class="row">
                                            <div class="col">
                                                <label for="Name"
                                                    class="mr-sm-2">{{ trans('Classrooms_trans.Name_class_ar') }}
                                                    :</label>
                                                <input id="Name" type="text" name="Name"
                                                    class="form-control"
                                                    value="{{ $Classrooms->getTranslation('name_class', 'ar') }}">
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $Classrooms->id }}">
                                            </div>
                                            <div class="col">
                                                <label for="Name_en"
                                                    class="mr-sm-2">{{ trans('Classrooms_trans.Name_class_en') }}
                                                    :</label>
                                                <input type="text" class="form-control"
                                                    value="{{ $Classrooms->getTranslation('name_class', 'en') }}"
                                                    name="Name_en" >
                                            </div>
                                        </div>
                                        <div class="col">
                                            <label class="mr-sm-2">{{ trans('Classrooms_trans.grade') }}:</label>
                                                <div class="box">
                                                <select class="form-control form-control-lg" name="Grade_id">
                                                    <option value="{{ $Classrooms->grade->id}}">{{ $Classrooms->grade->name }}</option>
                                                    @foreach (  $grades as $g)
                                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <br><br>

                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('Classrooms_trans.Close') }}</button>
                                            <button type="submit"
                                                class="btn btn-success">{{ trans('Classrooms_trans.submit') }}</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="delete{{ $Classrooms->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                        id="exampleModalLabel">
                                        {{ trans('Classrooms_trans.delete_Grade') }}
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('Classrooms.destroy', 'test') }}" method="post">
                                        {{ method_field('Delete') }}
                                        @csrf
                                        {{ trans('Classrooms_trans.Warning_Grade') }}
                                        <input id="id" type="hidden" name="id" class="form-control"
                                            value="{{ $Classrooms->id }}">
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">{{ trans('Classrooms_trans.Close') }}</button>
                                            <button type="submit"
                                                class="btn btn-danger">{{ trans('Classrooms_trans.submit') }}</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
         </table>
        </div>
        </div>
        </div>
      </div>
    </div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Classrooms_trans.add_class') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form class=" row mb-30" action={{route('Classrooms.store')}} method="POST">
                    @csrf
                    <div class="card-body">
                        <div class="repeater">
                            <div data-repeater-list="List_Classes">
                                <div data-repeater-item>
                                    <div class="row">

                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('Classrooms_trans.Name_class_ar') }}
                                                :</label>
                                            <input id="Name" class="form-control" type="text" name="Name" />
                                        </div>


                                        <div class="col">
                                            <label for="Name"
                                                class="mr-sm-2">{{ trans('Classrooms_trans.Name_class_en') }}
                                                :</label>
                                            <input class="form-control" type="text" name="Name_class_en" />
                                        </div>


                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('Classrooms_trans.grade') }}
                                                :</label>
                                            <div class="box">
                                                <select class="fancyselect" name="Grade_id">
                                                    @foreach ($grades as $g)
                                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col">
                                            <label for="Name_en"
                                                class="mr-sm-2">{{ trans('Classrooms_trans.process') }}
                                                :</label>
                                            <input class="btn btn-danger btn-block" data-repeater-delete
                                                type="button" value="{{ trans('Classrooms_trans.Delete') }}" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-20">
                                <div class="col-12">
                                    <input class="button" data-repeater-create type="button" value="{{ trans('Classrooms_trans.add_class') }}"/>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary"
                                    data-dismiss="modal">{{ trans('Grades_trans.Close') }}</button>
                                <button type="submit"
                                    class="btn btn-success">{{ trans('Grades_trans.submit') }}</button>
                            </div>


                        </div>
                    </div>
                </form>
        </div>
    </div>
    </div>
</div>
<div class="modal fade" id="delete_all" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Classrooms_trans.delete_Grade') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{ route('delete_all') }}" method="POST">
                {{ csrf_field() }}
                <div class="modal-body">
                    {{ trans('Classrooms_trans.Warning_Grade') }}
                    <input class="text" type="hidden" id="delete_all_id" name="delete_all_id" value=''>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Classrooms_trans.Close') }}</button>
                    <button type="submit" class="btn btn-danger">{{ trans('Classrooms_trans.submit') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script type="text/javascript">
    $(function() {
        $("#btn_delete_all").click(function() {
            var selected = new Array();
            $("#data input[type=checkbox]:checked").each(function() {
                selected.push(this.value);
            });
            if (selected.length > 0) {
                $('#delete_all').modal('show')
                $('input[id="delete_all_id"]').val(selected);
            }
        });
    });
</script>
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> --}}
@endsection
