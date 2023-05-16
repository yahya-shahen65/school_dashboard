@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col-xl-12 mb-30">
            <div class="card card-statistics h-100">
                <div class="card-body">
                    <div class="card-header">{{trans('header.profiledata') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ Auth::user()->name }}<br>
                    {{ Auth::user()->email }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
