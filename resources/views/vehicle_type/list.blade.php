@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('pagination.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('vehicle_type.title_list') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
        <div class="align-right">
                <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('vehicle_type.red_info') }}</span>
            </div><br/>
            <div class="card center-info">
                <div class="card-header">{{ __('vehicle_type.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('vehicle_type.label.id') }}</th>
                            <th scope="col">{{ __('vehicle_type.label.capacity') }}</th>
                            <th scope="col">{{ __('vehicle_type.label.description') }}</th>
                            <th scope="col">{{ __('vehicle_type.label.volume') }}</th>
                            <th scope="col">{{ __('vehicle_type.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["vehicle_types"] as $vehicle_type)
                        <tr>
                            @if($vehicle_type->getIsActive() == '0')
                            <td class="red-option">{{ $vehicle_type->getId() }}</td>
                            <td class="red-option">{{ $vehicle_type->getCapacity() }}</td>
                            <td class="red-option">{{ $vehicle_type->getDescription() }}</td>
                            <td class="red-option">{{ $vehicle_type->getVolume() }}</td>
                            @else
                            <td>{{ $vehicle_type->getId() }}</td>
                            <td>{{ $vehicle_type->getCapacity() }}</td>
                            <td>{{ $vehicle_type->getDescription() }}</td>
                            <td>{{ $vehicle_type->getVolume() }}</td>
                            @endif
                            <td><a href="{{ route('vehicle_type.show', ['id'=>$vehicle_type->getId()]) }}"> {{ __('vehicle_type.label.info') }} <strong>{{ $vehicle_type->getId() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
