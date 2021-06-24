@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["vehicle"]->getName() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('vehicle.label.id') }}</b><br /> {{ $data["vehicle"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('vehicle.label.name') }}</b><br /> {{ $data["vehicle"]->getName() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <b>{{ __('vehicle.label.observations') }}</b><br /> {{ $data["vehicle"]->getObservations() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('vehicle.label.warehouse_id') }}</b><br /> <a href="{{ route('warehouse.show', ['id'=>$data['vehicle']->getWarehouseId()]) }}"><strong>{{ $data["vehicle"]->getWarehouseId() }} - {{ $data["vehicle"]->warehouse->getName() }}</strong></a><br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('vehicle.label.type_id') }}</b><br /> <a href="{{ route('vehicle_type.show', ['id'=>$data['vehicle']->getTypeId()]) }}"><strong>{{ $data["vehicle"]->getTypeId() }} - {{ $data["vehicle"]->type->getDescription() }}</strong></a><br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('vehicle.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vehicle']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('vehicle.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["vehicle"]->getIsActive() == '1')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('vehicle.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vehicle']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('vehicle.input.deactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('vehicle.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vehicle']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('vehicle.input.reactivate') }}</button>
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
