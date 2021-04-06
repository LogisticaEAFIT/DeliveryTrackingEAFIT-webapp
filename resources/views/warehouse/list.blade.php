@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="breadcrumb-item active">{{ __('warehouse.title_list') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card" align="center">
                <div class="card-header">{{ __('warehouse.title_list') }}</div>

                <table class="table table-striped">
                    <thead  align="center">
                        <tr>
                            <th scope="col">{{ __('warehouse.label.id') }}</th>
                            <th scope="col">{{ __('warehouse.label.description') }}</th>
                            <th scope="col">{{ __('warehouse.label.address') }}</th>
                            <th scope="col">{{ __('warehouse.label.latitude') }}</th>
                            <th scope="col">{{ __('warehouse.label.longitude') }}</th>
                            <th scope="col">{{ __('warehouse.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody  align="center">
                        @foreach($data["warehouses"] as $warehouse)
                        <tr>
                            <td>{{ $warehouse->getId() }}</td>
                            <td>{{ $warehouse->getDescription() }}</td>
                            <td>{{ $warehouse->getAddress() }}</td>
                            <td>{{ $warehouse->getLatitude() }}</td>
                            <td>{{ $warehouse->getLongitude() }}</td>
                            <td><a href="{{ route('warehouse.show', ['id'=>$warehouse->getId()]) }}"> {{ __('warehouse.label.info') }} <strong>{{ $warehouse->getId() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection