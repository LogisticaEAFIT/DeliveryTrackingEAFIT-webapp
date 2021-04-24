@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('pagination.home') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('vehicle_type.list') }}">{{ __('vehicle_type.title_list') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('vehicle_type.show', ['id'=>$data['vehicle_type']->getId()]) }}">{{ $data['vehicle_type']->getId() }}</a></li>
        <li class="breadcrumb-item active">{{ __('vehicle_type.title_update') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('vehicle_type.title_update') }}</div>

                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('vehicle_type.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['vehicle_type']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="capacity"><strong>{{ __('vehicle_type.label.capacity') }}</strong></label><br />
                                <input type="text" class="form-control" name="capacity" value="{{ $data['vehicle_type']->getCapacity() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="volume"><strong>{{ __('vehicle_type.label.volume') }}</strong></label><br />
                                <input type="text" class="form-control" name="volume" value="{{ $data['vehicle_type']->getVolume() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="description"><strong>{{ __('vehicle_type.label.description') }}</strong></label><br />
                                <textarea type="text" class="form-control" name="description" required>{{ $data['vehicle_type']->getDescription() }}</textarea>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('vehicle_type.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
