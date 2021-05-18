@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["vehicle_type"]->getId() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('vehicle_type.label.id') }}</b><br /> {{ $data["vehicle_type"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('vehicle_type.label.capacity') }}</b><br /> {{ $data["vehicle_type"]->getCapacity() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <b>{{ __('vehicle_type.label.description') }}</b><br /> {{ $data["vehicle_type"]->getDescription() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-3"></div>
                        <div class="col-6">
                            <b>{{ __('vehicle_type.label.volume') }}</b><br /> {{ $data["vehicle_type"]->getVolume() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('vehicle_type.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vehicle_type']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('vehicle_type.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["vehicle_type"]->getIsActive() == '1')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('vehicle_type.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vehicle_type']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('vehicle_type.input.deactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('vehicle_type.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vehicle_type']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('vehicle_type.input.reactivate') }}</button>
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
