@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["service"]->getId() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('service.label.id') }}</b><br /> {{ $data["service"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('service.label.route_order') }}</b><br /> {{ $data["service"]->getRouteOrder() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('service.label.lower_time_window') }}</b><br /> {{ $data["service"]->getLowerTimeWindow() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('service.label.upper_time_window') }}</b><br /> {{ $data["service"]->getUpperTimeWindow() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('service.label.delivery_route_id') }}</b><br /> <a href="{{ route('delivery_route.show', ['id'=>$data['service']->getDeliveryRouteId()]) }}"><strong>{{ $data["service"]->getDeliveryRouteId() }} - {{ $data["service"]->deliveryRoute->getDate() }}</strong></a><br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('service.label.latitude') }}</b><br /> {{ $data["service"]->getLatitude() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('service.label.longitude') }}</b><br /> {{ $data["service"]->getLongitude() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('service.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['service']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('service.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>

                    @if($data["service"]->getStatus() == 'uncompleted')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('service.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['service']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('service.input.finish_it') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('service.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['service']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('service.input.reactivate') }}</button>
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
