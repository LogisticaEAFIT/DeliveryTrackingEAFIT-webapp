@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('pagination.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('vehicle.title_list') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
        <div class="align-right">
                <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('vehicle.red_info') }}</span>
            </div><br/>
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
                            <td class="red-option">{{ $vehicle->warehouse->getName() }}</td>
                            <td class="red-option">{{ $vehicle->getTypeId() }}</td>
                            @else
                            <td>{{ $vehicle->getId() }}</td>
                            <td>{{ $vehicle->getName() }}</td>
                            <td>{{ $vehicle->getObservations() }}</td>
                            <td>{{ $vehicle->warehouse->getName() }}</td>
                            <td>{{ $vehicle->getTypeId() }}</td>
                            @endif
                            <td><a href="{{ route('vehicle.show', ['id'=>$vehicle->getId()]) }}"> {{ __('vehicle.label.info') }} <strong>{{ $vehicle->getName() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
