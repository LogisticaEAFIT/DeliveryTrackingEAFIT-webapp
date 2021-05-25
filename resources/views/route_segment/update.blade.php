@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('route_segment.title_update') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('route_segment.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['route_segment']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="lower_time_window"><strong>{{ __('route_segment.label.lower_time_window') }}</strong></label><br />
                                <input type="text" class="form-control" name="lower_time_window" value="{{ $data['route_segment']->getLowerTimeWindow() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="upper_time_window"><strong>{{ __('route_segment.label.upper_time_window') }}</strong></label><br />
                                <input type="text" class="form-control" name="upper_time_window" value="{{ $data['route_segment']->getUpperTimeWindow() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-4">
                                <label for="route_order"><strong>{{ __('route_segment.label.route_order') }}</strong></label><br />
                                <input type="text" class="form-control" name="route_order" value="{{ $data['route_segment']->getRouteOrder() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="latitude"><strong>{{ __('route_segment.label.latitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="latitude" value="{{ $data['route_segment']->getLatitude() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="longitude"><strong>{{ __('route_segment.label.longitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="longitude" value="{{ $data['route_segment']->getLongitude() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('route_segment.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
