@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="row padding-bottom-20">
                <div class="col-6">
                    <form method="GET" action="{{ route('vehicle.create') }}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('vehicle.input.create') }}</button>
                    </form>
                </div>
                <div class="col-6 text-right">
                    <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('vehicle.red_info') }}</span>
                </div>
            </div>
            <div class="card center-info">
                <div class="card-header">{{ __('vehicle.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('vehicle.label.id') }}</th>
                            <th scope="col">{{ __('vehicle.label.name') }}</th>
                            <th scope="col">{{ __('vehicle.label.observations') }}</th>
                            <th scope="col">{{ __('vehicle.label.warehouse_id') }}</th>
                            <th scope="col">{{ __('vehicle.label.type_id') }}</th>
                            <th scope="col">{{ __('vehicle.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["vehicles"] as $vehicle)
                        <tr>
                            @if($vehicle->getIsActive() == '0')
                            <td class="red-option">{{ $vehicle->getId() }}</td>
                            <td class="red-option">{{ $vehicle->getName() }}</td>
                            <td class="red-option">{{ $vehicle->getObservations() }}</td>
                            <td class="red-option"><a href="{{ route('warehouse.show', ['id'=>$vehicle->getWarehouseId()]) }}"><strong>{{ $vehicle->getWarehouseId() }} - {{ $vehicle->warehouse->getName() }}</strong></a></td>
                            <td class="red-option"><a href="{{ route('vehicle_type.show', ['id'=>$vehicle->getTypeId()]) }}"><strong>{{ $vehicle->getTypeId() }}</strong></a></td>
                            @else
                            <td>{{ $vehicle->getId() }}</td>
                            <td>{{ $vehicle->getName() }}</td>
                            <td>{{ $vehicle->getObservations() }}</td>
                            <td><a href="{{ route('warehouse.show', ['id'=>$vehicle->getWarehouseId()]) }}"><strong>{{ $vehicle->getWarehouseId() }} - {{ $vehicle->warehouse->getName() }}</strong></a></td>
                            <td><a href="{{ route('vehicle_type.show', ['id'=>$vehicle->getTypeId()]) }}"><strong>{{ $vehicle->getTypeId() }}</strong></a></td>
                            @endif
                            <td><a href="{{ route('vehicle.show', ['id'=>$vehicle->getId()]) }}"> {{ __('vehicle.label.info') }} <strong>{{ $vehicle->getName() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br/>
            <nav class="center-info" aria-label="Page navigation example">
                {{$data["vehicles"]->links()}}
            </nav>
        </div>
    </div>
</div>
@endsection
