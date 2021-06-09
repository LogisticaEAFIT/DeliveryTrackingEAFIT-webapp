@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('service.title_update') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('service.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['service']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="lower_time_window"><strong>{{ __('service.label.lower_time_window') }}</strong></label><br />
                                <input type="text" class="form-control" name="lower_time_window" value="{{ $data['service']->getLowerTimeWindow() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="upper_time_window"><strong>{{ __('service.label.upper_time_window') }}</strong></label><br />
                                <input type="text" class="form-control" name="upper_time_window" value="{{ $data['service']->getUpperTimeWindow() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-4">
                                <label for="route_order"><strong>{{ __('service.label.route_order') }}</strong></label><br />
                                <input type="text" class="form-control" name="route_order" value="{{ $data['service']->getRouteOrder() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="latitude"><strong>{{ __('service.label.latitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="latitude" value="{{ $data['service']->getLatitude() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="longitude"><strong>{{ __('service.label.longitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="longitude" value="{{ $data['service']->getLongitude() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('service.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
