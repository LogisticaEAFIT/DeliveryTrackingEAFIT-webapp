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
                            <h4>{{ __('service.title_list') }}</h2>
                        </div>
                    </div>
                    <table class="table table-striped">
                        <thead class="center-info">
                            <tr>
                                <th scope="col">{{ __('service.label.id') }}</th>
                                <th scope="col">{{ __('service.label.lower_time_window') }}</th>
                                <th scope="col">{{ __('service.label.upper_time_window') }}</th>
                                <th scope="col">{{ __('service.label.route_order') }}</th>
                                <th scope="col">{{ __('service.label.status') }}</th>
                                <th scope="col">{{ __('service.label.latitude') }}</th>
                                <th scope="col">{{ __('service.label.longitude') }}</th>
                                <th scope="col">{{ __('service.label.about') }} <i class="fa fa-info-circle"></i></th>
                            </tr>
                        </thead>
                        <tbody class="center-info">
                            @foreach($data["services"] as $service)
                            <tr>
                                @if($service->getStatus() == 'completed')
                                <td class="green-option">{{ $service->getId() }}</td>
                                <td class="green-option">{{ $service->getLowerTimeWindow() }}</td>
                                <td class="green-option">{{ $service->getUpperTimeWindow() }}</td>
                                <td class="green-option">{{ $service->getRouteOrder() }}</td>
                                <td class="green-option">{{ $service->getStatus() }}</td>
                                <td class="green-option">{{ $service->getLatitude() }}</td>
                                <td class="green-option">{{ $service->getLongitude() }}</td>
                                @else
                                <td>{{ $service->getId() }}</td>
                                <td>{{ $service->getLowerTimeWindow() }}</td>
                                <td>{{ $service->getUpperTimeWindow() }}</td>
                                <td>{{ $service->getRouteOrder() }}</td>
                                <td>{{ $service->getStatus() }}</td>
                                <td>{{ $service->getLatitude() }}</td>
                                <td>{{ $service->getLongitude() }}</td>
                                @endif
                                <td><a href="{{ route('service.show', ['id'=>$service->getId()]) }}"> {{ __('service.label.info') }} <strong>{{ $service->getId() }}</strong></a></td>
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
