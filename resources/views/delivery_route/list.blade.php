@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ __('delivery_route.title_list') }}</li>
    </ol>
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
                            <th scope="col">{{ __('delivery_route.label.about') }} <i class="fa fa-info-circle"></i></th>
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
                            <td class="green-option">{{ $delivery_route->getWarehouseId() }}</td>
                            <td class="green-option">{{ $delivery_route->getCourierId() }}</td>
                            @else
                            <td>{{ $delivery_route->getId() }}</td>
                            <td>{{ $delivery_route->getDate() }}</td>
                            <td>{{ $delivery_route->getNumberOfDeliveries() }}</td>
                            <td>{{ $delivery_route->getCompletedDeliveries() }}</td>
                            <td>{{ $delivery_route->getState() }}</td>
                            <td>{{ $delivery_route->getWarehouseId() }}</td>
                            <td>{{ $delivery_route->getCourierId() }}</td>
                            @endif
                            <td><a href="{{ route('delivery_route.show', ['id'=>$delivery_route->getId()]) }}"> {{ __('delivery_route.label.info') }} <strong>{{ $delivery_route->getId() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection