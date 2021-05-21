@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["customer"]->getName() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('customer.label.id') }}</b><br /> {{ $data["customer"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('customer.label.name') }}</b><br /> {{ $data["customer"]->getName() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('customer.label.phone_number') }}</b><br /> {{ $data["customer"]->getPhoneNumber() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('customer.label.address') }}</b><br /> {{ $data["customer"]->getAddress() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('customer.label.company_id') }}</b><br /> <a href="{{ route('company.show', ['id'=>$data['customer']->getCompanyId()]) }}"><strong>{{ $data["customer"]->getCompanyId() }} - {{ $data["customer"]->company->getName() }}</strong></a><br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('customer.label.latitude') }}</b><br /> {{ $data["customer"]->getLatitude() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('customer.label.longitude') }}</b><br /> {{ $data["customer"]->getLongitude() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <b>{{ __('customer.label.observations') }}</b><br /> {{ $data["customer"]->getObservations() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('customer.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['customer']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('customer.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["customer"]->getIsActive() == '1')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('customer.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['customer']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('customer.input.deactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('customer.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['customer']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('customer.input.reactivate') }}</button>
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
