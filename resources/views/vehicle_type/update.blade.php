@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('vehicle_type.title_update') }}</div>

                <div class="card-body">

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
