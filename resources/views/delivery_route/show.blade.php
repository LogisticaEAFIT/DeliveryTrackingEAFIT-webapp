@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
        <li class="breadcrumb-item"><a href="{{ route('delivery_route.list') }}">{{ __('delivery_route.title_list') }}</a></li>
        @endif
        <li class="breadcrumb-item active">{{ $data["delivery_route"]->getId() }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["delivery_route"]->getId() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('delivery_route.label.id') }}</b><br /> {{ $data["delivery_route"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('delivery_route.label.date') }}</b><br /> {{ $data["delivery_route"]->getDate() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('delivery_route.label.number_of_deliveries') }}</b><br /> {{ $data["delivery_route"]->getNumberOfDeliveries() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('delivery_route.label.completed_deliveries') }}</b><br /> {{ $data["delivery_route"]->getCompletedDeliveries() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.state') }}</b><br /> {{ $data["delivery_route"]->getState() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.warehouse_id') }}</b><br /> {{ $data["delivery_route"]->getWarehouseId() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('delivery_route.label.courier_id') }}</b><br /> {{ $data["delivery_route"]->getCourierId() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('delivery_route.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['delivery_route']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('delivery_route.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["delivery_route"]->getState() == 'started')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('delivery_route.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['delivery_route']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> {{ __('delivery_route.input.finish_it') }}</button>
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
