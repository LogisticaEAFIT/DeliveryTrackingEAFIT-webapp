@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
        <div class="align-right">
                <span class="badge rounded-pill bg-success font-white pad-10">{{ __('delivery_route.green_info') }}</span>
            </div><br/>
            <div class="card center-info">
                <div class="card-header">{{ __('delivery_route.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('delivery_route.label.id') }}</th>
                            <th scope="col">{{ __('delivery_route.label.date') }}</th>
                            <th scope="col">{{ __('delivery_route.label.number_of_deliveries') }}</th>
                            <th scope="col">{{ __('delivery_route.label.completed_deliveries') }}</th>
                            <th scope="col">{{ __('delivery_route.label.state') }}</th>
                            <th scope="col">{{ __('delivery_route.label.warehouse_id') }}</th>
                            <th scope="col">{{ __('delivery_route.label.courier_id') }}</th>
                            <th scope="col">{{ __('delivery_route.label.vehicle_id') }}</th>
                            @if(Auth::user()->getRole()!="courier")
                            <th scope="col">{{ __('delivery_route.label.about') }} <i class="fa fa-info-circle"></i></th>
                            @endif
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["delivery_routes"] as $delivery_route)
                        <tr>
                            @if($delivery_route->getState() == 'finished')
                            <td class="green-option">{{ $delivery_route->getId() }}</td>
                            <td class="green-option">{{ $delivery_route->getDate() }}</td>
                            <td class="green-option">{{ $delivery_route->getNumberOfDeliveries() }}</td>
                            <td class="green-option">{{ $delivery_route->getCompletedDeliveries() }}</td>
                            <td class="green-option">{{ $delivery_route->getState() }}</td>
                            @if($delivery_route->warehouse->getName() != '')
                            <td class="green-option"><a href="{{ route('warehouse.show', ['id'=>$delivery_route->getWarehouseId()]) }}"><strong>{{ $delivery_route->getWarehouseId() }} - {{ $delivery_route->warehouse->getName() }}</strong></a></td>
                            @else
                            <td class="green-option"><a href="{{ route('warehouse.show', ['id'=>$delivery_route->getWarehouseId()]) }}"><strong>{{ $delivery_route->getWarehouseId() }}</strong></a></td>
                            @endif
                            <td class="green-option"><a href="{{ route('user.show', ['id'=>$delivery_route->getCourierId()]) }}"><strong>{{ $delivery_route->getCourierId() }} - {{ $delivery_route->courier->getName() }}</strong></a></td>
                            <td class="green-option"><a href="{{ route('vehicle.show', ['id'=>$delivery_route->getVehicleId()]) }}"><strong>{{ $delivery_route->getVehicleId() }} - {{ $delivery_route->vehicle->getName() }}</strong></a></td>
                            @else
                            <td>{{ $delivery_route->getId() }}</td>
                            <td>{{ $delivery_route->getDate() }}</td>
                            <td>{{ $delivery_route->getNumberOfDeliveries() }}</td>
                            <td>{{ $delivery_route->getCompletedDeliveries() }}</td>
                            <td>{{ $delivery_route->getState() }}</td>
                            @if($delivery_route->warehouse->getName() != '')
                            <td><a href="{{ route('warehouse.show', ['id'=>$delivery_route->getWarehouseId()]) }}"><strong>{{ $delivery_route->getWarehouseId() }} - {{ $delivery_route->warehouse->getName() }}</strong></a></td>
                            @else
                            <td><a href="{{ route('warehouse.show', ['id'=>$delivery_route->getWarehouseId()]) }}"><strong>{{ $delivery_route->getWarehouseId() }}</strong></a></td>
                            @endif
                            <td><a href="{{ route('user.show', ['id'=>$delivery_route->getCourierId()]) }}"><strong>{{ $delivery_route->getCourierId() }} - {{ $delivery_route->courier->getName() }}</strong></a></td>
                            <td><a href="{{ route('vehicle.show', ['id'=>$delivery_route->getVehicleId()]) }}"><strong>{{ $delivery_route->getVehicleId() }} - {{ $delivery_route->vehicle->getName() }}</strong></a></td>
                            @endif
                            @if(Auth::user()->getRole()!="courier")
                            <td><a href="{{ route('delivery_route.show', ['id'=>$delivery_route->getId()]) }}"> {{ __('delivery_route.label.info') }} <strong>{{ $delivery_route->getId() }}</strong></a></td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
