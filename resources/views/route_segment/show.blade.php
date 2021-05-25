@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["route_segment"]->getId() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('route_segment.label.id') }}</b><br /> {{ $data["route_segment"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('route_segment.label.route_order') }}</b><br /> {{ $data["route_segment"]->getRouteOrder() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('route_segment.label.lower_time_window') }}</b><br /> {{ $data["route_segment"]->getLowerTimeWindow() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('route_segment.label.upper_time_window') }}</b><br /> {{ $data["route_segment"]->getUpperTimeWindow() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('route_segment.label.delivery_route_id') }}</b><br /> <a href="{{ route('delivery_route.show', ['id'=>$data['route_segment']->getDeliveryRouteId()]) }}"><strong>{{ $data["route_segment"]->getDeliveryRouteId() }} - {{ $data["route_segment"]->deliveryRoute->getDate() }}</strong></a><br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('route_segment.label.latitude') }}</b><br /> {{ $data["route_segment"]->getLatitude() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('route_segment.label.longitude') }}</b><br /> {{ $data["route_segment"]->getLongitude() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('route_segment.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['route_segment']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('route_segment.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>

                    @if($data["route_segment"]->getStatus() == 'uncompleted')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('route_segment.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['route_segment']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('route_segment.input.finish_it') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('route_segment.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['route_segment']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('route_segment.input.reactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
