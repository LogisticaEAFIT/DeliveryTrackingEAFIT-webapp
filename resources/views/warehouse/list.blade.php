@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('pagination.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('warehouse.title_list') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
        <div class="align-right">
                <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('warehouse.red_info') }}</span>
            </div><br/>
            <div class="card center-info">
                <div class="card-header">{{ __('warehouse.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('warehouse.label.id') }}</th>
                            <th scope="col">{{ __('warehouse.label.name') }}</th>
                            <th scope="col">{{ __('warehouse.label.description') }}</th>
                            <th scope="col">{{ __('warehouse.label.address') }}</th>
                            <th scope="col">{{ __('warehouse.label.latitude') }}</th>
                            <th scope="col">{{ __('warehouse.label.longitude') }}</th>
                            <th scope="col">{{ __('warehouse.label.company_id') }}</th>
                            <th scope="col">{{ __('warehouse.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["warehouses"] as $warehouse)
                        <tr>
                            @if($warehouse->getIsActive() == '0')
                            <td class="red-option">{{ $warehouse->getId() }}</td>
                            <td class="red-option">{{ $warehouse->getName() }}</td>
                            <td class="red-option">{{ $warehouse->getDescription() }}</td>
                            <td class="red-option">{{ $warehouse->getAddress() }}</td>
                            <td class="red-option">{{ $warehouse->getLatitude() }}</td>
                            <td class="red-option">{{ $warehouse->getLongitude() }}</td>
                            <td class="red-option"><a href="{{ route('company.show', ['id'=>$warehouse->getCompanyId()]) }}"><strong>{{ $warehouse->company->getName() }}</strong></a></td>
                            @else
                            <td>{{ $warehouse->getId() }}</td>
                            <td>{{ $warehouse->getName() }}</td>
                            <td>{{ $warehouse->getDescription() }}</td>
                            <td>{{ $warehouse->getAddress() }}</td>
                            <td>{{ $warehouse->getLatitude() }}</td>
                            <td>{{ $warehouse->getLongitude() }}</td>
                            <td><a href="{{ route('company.show', ['id'=>$warehouse->getCompanyId()]) }}"><strong>{{ $warehouse->company->getName() }}</strong></a></td>
                            @endif
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
