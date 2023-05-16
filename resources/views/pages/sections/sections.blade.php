@extends('layouts.master')
@section('css')
@endsection
@section('title')
    {{trans('Sections_trans.sections_menu')}}
@stop
@section('page-header')
<!-- breadcrumb -->
<div class="page-title">
    <div class="row">
        <div class="col-sm-6">
            <h4 class="mb-0">{{trans('Sections_trans.sections_menu')}}</h4>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb pt-0 pr-0 float-left float-sm-right ">
                <li class="breadcrumb-item"><a href="#" class="default-color">{{trans('sidebars.Dashboard')}}</a></li>
                <li class="breadcrumb-item active">{{trans('Sections_trans.sections_menu')}}</li>
            </ol>
        </div>
    </div>
</div>
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">
    <div class="col-md-12 mb-30">
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
                @if (session()->has('active'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('active') }}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session()->has('no active'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{ session()->get('no active') }}</strong>
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
                    {{ trans('Sections_trans.add_sections') }}
                </button>
                <br><br>
                <div class="accordion gray plus-icon round">
                @foreach ($grades as $grade)
                <div class="acd-group">
                    <a href="#" class="acd-heading">{{$grade->name}}</a>
                    <div class="acd-des">
                        <div class="row">
                            <div class="col-xl-12 mb-30">
                              <div class="card card-statistics h-100">
                                <div class="card-body">
                                    <div class="d-block d-md-flex justify-content-between">
                                        <div class="d-block">
                                        </div>
                                    </div>
                                  <div class="table-responsive  mt-15">
                                  <table class="table center-aligned-table mb-0">
                                    <thead>
                                        <tr class="text-dark">
                                            <th>#</th>
                                            <th>{{trans('Sections_trans.section')}}</th>
                                            <th>{{trans('Sections_trans.class')}}</th> 
                                            <th>{{trans('Sections_trans.status')}}</th>
                                            <th>{{trans('Sections_trans.teachers')}}</th>
                                            <th>{{trans('Sections_trans.process')}}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i=0?>
                                        @foreach ($grade->sections as $section)
                                            <tr>
                                                <td>{{++$i}}</td>
                                                <td>{{$section->name_section}}</td>
                                                <td>{{$section->classroom->name_class}}</td>
                                                <td>
                                                    @if ($section->status==1)
                                                    <label class="badge badge-success">{{ trans('Sections_trans.active') }}</label>
                                                    @else
                                                    <label class="badge badge-danger">{{ trans('Sections_trans.no') }}</label>
                                                    @endif
                                                </td>
                                                <td>
                                                    @foreach ($section->teachers as $teacher)
                                                        <li>{{$teacher->name}}</li>
                                                    @endforeach
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-info btn-sm" data-toggle="modal"
                                                data-target="#edit{{$section->id }}"
                                                title="{{ trans('Grades_trans.Edit') }}"><i class="fa fa-edit"></i></button>
                                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal"
                                                        data-target="#delete{{$section->id }}"
                                                        title="{{ trans('Grades_trans.Delete') }}"><i
                                                            class="fa fa-trash"></i></button>
                                                </td>
                                            </tr>
                                            <div class="modal fade" id="edit{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                                                                {{ trans('Sections_trans.edit_section') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <!-- add_form -->
                                                            <form action="{{ route('Sections.update','test') }}" method="POST">
                                                                {{ method_field('patch') }}
                                                                @csrf
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <input id="Name" type="text" name="Name" class="form-control" placeholder="{{ trans('Sections_trans.section_name_ar') }}" value={{$section->getTranslation('name_section','ar')}}>
                                                                    </div>
                                                                    <div class="col">
                                                                        <input id="id" type="hidden" name="id" class="form-control"
                                                                            value="{{ $section->id }}">
                                                                        <input type="text" class="form-control" name="Name_en" placeholder="{{ trans('Sections_trans.section_name_en') }}" value={{$section->getTranslation('name_section','en')}}>
                                                                    </div>
                                                                </div>
                                                                <div class="input-group">
                                                                    <h5>{{ trans('Sections_trans.grade') }}:</h5>
                                                                    <select class="custom-select" name="grade_id">
                                                                        <option value={{$section->grade->id}}>{{$section->grade->name}}</option>
                                                                        @foreach (  $grades as $g)
                                                                            <option value="{{ $g->id }}">{{ $g->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <br>
                                                                <div class="input-group">
                                                                    <h5>{{ trans('Sections_trans.class') }}:</h5>
                                                                    <select class="custom-select" name="class_id">
                                                                        <option value={{$section->classroom->id}}>{{$section->classroom->name_class}}</option>
                                                                    </select>
                                                                </div>

                                                                <div class="input-group">
                                                                    <div class="form-check">

                                                                        @if ($section->status === 1)
                                                                            <input
                                                                                type="checkbox"
                                                                                checked
                                                                                class="form-check-input"
                                                                                name="status"
                                                                                id="exampleCheck1">
                                                                        @else
                                                                            <input
                                                                                type="checkbox"
                                                                                class="form-check-input"
                                                                                name="status"
                                                                                id="exampleCheck1">
                                                                        @endif
                                                                        <h5><label
                                                                            class="form-check-label"
                                                                            for="exampleCheck1">{{ trans('Sections_trans.status') }}</label></h5>
                                                                        <div class="input-group">
                                                                            <h5><label for="inputName" class="control-label">{{ trans('Sections_trans.Name_Teacher') }}</label></h5>
                                                                            <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                                                                                <option disabled>{{trans('Teacher_trans.teacherActive')}}</option>
                                                                                @foreach($section->teachers as $teacher)
                                                                                    <option selected disabled value="{{$teacher['id']}}">{{$teacher['name']}}</option>
                                                                                @endforeach
                                                                                <option disabled>{{trans('Teacher_trans.choose')}}</option>
                                                                                @foreach($teachers as $teacher)
                                                                                    <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                                                    <button type="submit" class="btn btn-success">{{ trans('Sections_trans.submit') }}</button>
                                                                </div>
                                                        </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal fade" id="delete{{$section->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                                id="exampleModalLabel">
                                                                {{ trans('Sections_trans.delete_section') }}
                                                            </h5>
                                                            <button type="button" class="close" data-dismiss="modal"
                                                                aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="{{ route('Sections.destroy', 'test') }}" method="post">
                                                                {{ method_field('Delete') }}
                                                                @csrf
                                                                {{ trans('Sections_trans.Warning_Grade') }}
                                                                <input id="id" type="hidden" name="id" class="form-control"
                                                                    value="{{ $section->id }}">
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                                                                    <button type="submit"
                                                                        class="btn btn-danger">{{ trans('Sections_trans.submit') }}</button>
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
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{ trans('Sections_trans.add_sections') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('Sections.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col">
                            <input id="Name" type="text" name="Name" class="form-control" placeholder="{{ trans('Sections_trans.section_name_ar') }}">
                        </div>
                        <div class="col">
                            <input type="text" class="form-control" name="Name_en" placeholder="{{ trans('Sections_trans.section_name_en') }}">
                        </div>
                    </div>
                    <div class="input-group">
                        <h5>{{ trans('Sections_trans.grade') }}</h5>
                        <select class="custom-select" name="grade_id">
                            <option selected disabled >{{trans('Sections_trans.select')}}</option>
                            @foreach (  $grades as $g)
                                <option value="{{ $g->id }}">{{ $g->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <br>
                    <div class="input-group">
                        <h5>{{ trans('Sections_trans.class') }}</h5>
                        <select class="custom-select" name="class_id">
                        </select>
                    </div>
                    <br>
                    <div class="col">
                        <label for="inputName" class="control-label"><h5>{{ trans('Sections_trans.Name_Teacher') }}</h5></label>
                        <select multiple name="teacher_id[]" class="form-control" id="exampleFormControlSelect2">
                            @foreach($teachers as $teacher)
                                <option value="{{$teacher->id}}">{{$teacher->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{ trans('Sections_trans.Close') }}</button>
                        <button type="submit" class="btn btn-success">{{ trans('Sections_trans.submit') }}</button>
                    </div>
            </form>

        </div>
    </div>
</div>
</div>
<!-- row closed -->
@endsection
@section('js')
<script>
    $(document).ready(function () {
        $('select[name="grade_id"]').on('change', function () {
            var Grade_id = $(this).val();
            if (Grade_id) {
                $.ajax({
                    url: "{{ URL::to('classes') }}/" + Grade_id,
                    type: "GET",
                    dataType: "json",
                    success: function (data) {
                        $('select[name="class_id"]').empty();
                        $.each(data, function (key, value) {
                            $('select[name="class_id"]').append('<option value="' + key + '">' + value + '</option>');
                        });
                    },
                });
            } else {
                console.log('AJAX load did not work');
            }
        });
    });
</script>

@endsection
