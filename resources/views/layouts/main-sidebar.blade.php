<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            <div class="scrollbar side-menu-bg">
                <ul class="nav navbar-nav side-menu" id="sidebarnav">
                    <!-- menu item Dashboard-->
                    <li>
                        <a href={{route('dashboard')}} >
                        <i class="ti-home"></i><span class="right-nav-text">{{__('sidebars.Dashboard')}}</span>
                        </a>
                    </li>
                    <!-- menu title -->
                    <li class="mt-10 mb-10 text-muted pl-4 font-medium menu-title">{{trans('sidebars.schoolSystem')}}</li>
                    <!-- menu item Elements-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#elements">
                            <div class="pull-left"><i class="ti-palette"></i><span
                                    class="right-nav-text">{{__('sidebars.Grades')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="elements" class="collapse" data-parent="#sidebarnav">
                            <li><a href={{route('Grades.index')}}>{{__('sidebars.Grades_list')}}</a></li>
                        </ul>
                    </li>
                    <!-- menu item calendar-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#calendar-menu">
                            <div class="pull-left"><i class="ti-calendar"></i><span
                                    class="right-nav-text">{{__('sidebars.classrooms')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="calendar-menu" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{route('Classrooms.index')}}>{{__('sidebars.list_classes')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item Charts-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#chart">
                            <div class="pull-left"><i class="ti-pie-chart"></i><span
                                    class="right-nav-text">{{trans('sidebars.sections')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="chart" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{route('Sections.index')}}>{{trans('sidebars.sections_menu')}}</a> </li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#fonts-icon">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('sidebars.student')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="fonts-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{route('Students.create')}}>{{trans('sidebars.add_student')}}</a> </li>
                            <li> <a href={{route('Students.index')}}>{{trans('sidebars.student_menu')}}</a> </li>
                        </ul>
                    <!-- menu item Form-->
                    <!-- menu font icon-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#font-icon">
                            <div class="pull-left"><i class="ti-home"></i><span class="right-nav-text">{{trans('sidebars.teachers')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="font-icon" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{route('Teachers.index')}}>{{trans('sidebars.teachers_menu')}}</a> </li>
                        </ul>
                    <!-- menu item Form-->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#Form">
                            <div class="pull-left"><i class="ti-files"></i><span class="right-nav-text">{{trans('sidebars.parents')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="Form" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{url('add_parent')}}>{{trans('sidebars.parents_menu')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item table -->
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#custom-page">
                            <div class="pull-left"><i class="ti-file"></i><span class="right-nav-text">{{ trans('subject.subject') }}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="custom-page" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{route('Subjects.index')}}>{{ trans('subject.subject') }}</a> </li>
                            <li> <a href={{route('Subjects.create')}}>{{ trans('subject.add') }}</a> </li>
                        </ul>
                    </li>
                    <li>
                        <a href="javascript:void(0);" data-toggle="collapse" data-target="#table">
                            <div class="pull-left"><i class="ti-layout-tab-window"></i><span class="right-nav-text">{{trans('sidebars.cun')}}</span></div>
                            <div class="pull-right"><i class="ti-plus"></i></div>
                            <div class="clearfix"></div>
                        </a>
                        <ul id="table" class="collapse" data-parent="#sidebarnav">
                            <li> <a href={{url('connect')}}>{{trans('sidebars.us')}}</a> </li>
                            <li> <a href={{url('connect')}}>{{trans('sidebars.who')}}</a> </li>
                        </ul>
                    </li>
                    <!-- menu item Custom pages-->
                </ul>
            </div>
        </div>

        <!-- Left Sidebar End-->

        <!--=================================
