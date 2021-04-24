@extends('layouts.app')

@section('content')

<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">{{ __('pagination.home') }}</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
        {{ __('pagination.home') }}
        </div>
    </div>
</div>

@endsection
