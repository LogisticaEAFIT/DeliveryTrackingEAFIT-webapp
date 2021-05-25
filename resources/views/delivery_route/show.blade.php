@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["delivery_route"]->getId() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.id') }}</b><br /> {{ $data["delivery_route"]->getId() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.date') }}</b><br /> {{ $data["delivery_route"]->getDate() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.state') }}</b><br /> {{ $data["delivery_route"]->getState() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('delivery_route.label.number_of_deliveries') }}</b><br /> {{ $data["delivery_route"]->getNumberOfDeliveries() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('delivery_route.label.completed_deliveries') }}</b><br /> {{ $data["delivery_route"]->getCompletedDeliveries() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            @if($data["delivery_route"]->warehouse->getName() != '')
                            <b>{{ __('delivery_route.label.warehouse_id') }}</b><br /> <a href="{{ route('warehouse.show', ['id'=>$data['delivery_route']->getWarehouseId()]) }}"><strong>{{ $data["delivery_route"]->getWarehouseId() }} - {{ $data["delivery_route"]->warehouse->getName() }}</strong></a><br />
                            @else
                            <b>{{ __('delivery_route.label.warehouse_id') }}</b><br /> <a href="{{ route('warehouse.show', ['id'=>$data['delivery_route']->getWarehouseId()]) }}"><strong>{{ $data["delivery_route"]->getWarehouseId() }}</strong></a><br />
                            @endif
                        </div>
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.courier_id') }}</b><br /> <a href="{{ route('user.show', ['id'=>$data['delivery_route']->getCourierId()]) }}"><strong>{{ $data["delivery_route"]->getCourierId() }} - {{ $data["delivery_route"]->courier->getName() }}</strong></a><br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.vehicle_id') }}</b><br /> <a href="{{ route('vehicle.show', ['id'=>$data['delivery_route']->getVehicleId()]) }}"><strong>{{ $data["delivery_route"]->getVehicleId() }} - {{ $data["delivery_route"]->vehicle->getName() }}</strong></a><br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <h4>{{ __('route_segment.title_list') }}</h2>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead class="center-info">
                            <tr>
                                <th scope="col">{{ __('route_segment.label.id') }}</th>
                                <th scope="col">{{ __('route_segment.label.lower_time_window') }}</th>
                                <th scope="col">{{ __('route_segment.label.upper_time_window') }}</th>
                                <th scope="col">{{ __('route_segment.label.route_order') }}</th>
                                <th scope="col">{{ __('route_segment.label.status') }}</th>
                                <th scope="col">{{ __('route_segment.label.latitude') }}</th>
                                <th scope="col">{{ __('route_segment.label.longitude') }}</th>
                                <th scope="col">{{ __('route_segment.label.about') }} <i class="fa fa-info-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody class="center-info">
                            @foreach($data["route_segments"] as $route_segment)
                            <tr>
                                @if($route_segment->getStatus() == 'completed')
                                <td class="green-option">{{ $route_segment->getId() }}</td>
                                <td class="green-option">{{ $route_segment->getLowerTimeWindow() }}</td>
                                <td class="green-option">{{ $route_segment->getUpperTimeWindow() }}</td>
                                <td class="green-option">{{ $route_segment->getRouteOrder() }}</td>
                                <td class="green-option">{{ $route_segment->getStatus() }}</td>
                                <td class="green-option">{{ $route_segment->getLatitude() }}</td>
                                <td class="green-option">{{ $route_segment->getLongitude() }}</td>
                                @else
                                <td>{{ $route_segment->getId() }}</td>
                                <td>{{ $route_segment->getLowerTimeWindow() }}</td>
                                <td>{{ $route_segment->getUpperTimeWindow() }}</td>
                                <td>{{ $route_segment->getRouteOrder() }}</td>
                                <td>{{ $route_segment->getStatus() }}</td>
                                <td>{{ $route_segment->getLatitude() }}</td>
                                <td>{{ $route_segment->getLongitude() }}</td>
                                @endif
                                <td><a href="{{ route('route_segment.show', ['id'=>$route_segment->getId()]) }}"> {{ __('route_segment.label.info') }} <strong>{{ $route_segment->getId() }}</strong></a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('delivery_route.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['delivery_route']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('delivery_route.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["delivery_route"]->getState() == 'started')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('delivery_route.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['delivery_route']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> {{ __('delivery_route.input.finish_it') }}</button>
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
