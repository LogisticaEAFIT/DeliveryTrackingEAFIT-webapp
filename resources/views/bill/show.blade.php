@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["bill"]->getId() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('bill.label.id') }}</b><br /> {{ $data["bill"]->getId() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('bill.label.amount_to_be_paid') }}</b><br /> {{ $data["bill"]->getAmountToBePaid() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('bill.label.amount_paid') }}</b><br /> {{ $data["bill"]->getAmountPaid() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <b>{{ __('bill.label.observations') }}</b><br /> {{ $data["bill"]->getObservations() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('bill.label.paid_in_advance') }}</b><br /> {{ $data["bill"]->getPaidInAdvance() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('bill.label.payment_type') }}</b><br /> {{ $data["bill"]->getPaymentType() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('bill.label.customer_id') }}</b><br /> {{ $data["bill"]->getCustomerId() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('bill.label.service_id') }}</b><br /> {{ $data["bill"]->getServiceId() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('bill.label.vendor_id') }}</b><br /> {{ $data["bill"]->getVendorId() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('bill.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['bill']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('bill.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
