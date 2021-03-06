@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="row padding-bottom-20">
                <div class="col-6">
                    <form method="GET" action="{{ route('delivery_route.create') }}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('delivery_route.input.create') }}</button>
                    </form>
                </div>
                <div class="col-6 text-right">
                    <span class="badge rounded-pill bg-success font-white pad-10">{{ __('delivery_route.green_info') }}</span>
                </div>
            </div>
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
            </div><br/>
            <nav class="center-info" aria-label="Page navigation example">
                {{$data["delivery_routes"]->links()}}
            </nav>
            <div class="row">
                <div class="col-6 offset-3">
                    <form method="POST" action="{{ route('delivery_route.import_file_delivery_service_bill') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="customFile">{{ __('delivery_route.label.browse_file') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="file" class="form-control @error('name') is-invalid @enderror" id="customFile">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row mb-0">
                            <div class="col-3"></div>
                            <div class="col-6">
                            <button type="submit" class="btn btn-info"><i class="fa fa-upload"></i> {{ __('delivery_route.input.import_2') }}</button>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
