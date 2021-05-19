@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["user"]->getName() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-3">
                            <b>{{ __('user.label.id') }}</b><br /> {{ $data["user"]->getId() }}<br />
                        </div>
                        <div class="col-3">
                            <b>{{ __('user.label.name') }}</b><br /> {{ $data["user"]->getName() }}<br />
                        </div>
                        <div class="col-3">
                            @if($data["user"]->getCompanyId() != '')
                            <b>{{ __('user.label.company_id') }}</b><br /> <a href="{{ route('company.show', ['id'=>$data['user']->getCompanyId()]) }}"> <strong>{{ $data["user"]->getCompanyId() }} - {{ $data["user"]->company->getName() }}</strong></a><br />
                            @else
                            <b>{{ __('user.label.company_id') }}</b><br /> N/A<br />
                            @endif
                        </div>
                        <div class="col-3">
                            @if($data["user"]->getWarehouseId() != '')
                            @if($data["user"]->warehouse->getName() != '')
                            <b>{{ __('user.label.warehouse_id') }}</b><br /> <a href="{{ route('warehouse.show', ['id'=>$data['user']->getWarehouseId()]) }}"> <strong>{{ $data["user"]->getWarehouseId() }} - {{ $data["user"]->warehouse->getName() }}</strong></a><br />
                            @else
                            <b>{{ __('user.label.warehouse_id') }}</b><br /> <a href="{{ route('warehouse.show', ['id'=>$data['user']->getWarehouseId()]) }}"> <strong>{{ $data["user"]->getWarehouseId() }}</strong></a><br />
                            @endif
                            @else
                            <b>{{ __('user.label.warehouse_id') }}</b><br /> N/A<br />
                            @endif
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('user.label.email') }}</b><br /> {{ $data["user"]->getEmail() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('user.label.id_card_number') }}</b><br /> {{ $data["user"]->getIdCardNumber() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('user.label.role') }}</b><br /> {{ $data["user"]->getRole() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('user.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['user']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('user.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["user"]->getIsActive() == '1')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('user.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['user']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('user.input.deactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('user.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['user']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('user.input.reactivate') }}</button>
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
