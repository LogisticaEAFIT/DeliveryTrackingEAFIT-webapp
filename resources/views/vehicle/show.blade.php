@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('pagination.home') }}</a></li>
        @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
        <li class="breadcrumb-item"><a href="{{ route('vehicle.list') }}">{{ __('vehicle.title_list') }}</a></li>
        @endif
        <li class="breadcrumb-item active">{{ $data["vehicle"]->getName() }}</li>
    </ol>
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
                            <b>{{ __('vehicle.label.warehouse_id') }}</b><br /> {{ $data["vehicle"]->warehouse->getName() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('vehicle.label.type_id') }}</b><br /> {{ $data["vehicle"]->getTypeId() }}<br />
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
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> {{ __('vehicle.input.deactivate') }}</button>
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
