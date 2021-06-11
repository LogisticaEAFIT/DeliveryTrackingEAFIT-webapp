@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('bill.title_update') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('bill.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['bill']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-12">
                                <label for="observations"><strong>{{ __('bill.label.observations') }}</strong></label><br />
                                <textarea type="text" class="form-control" name="observations" required>{{ $data['bill']->getObservations() }}</textarea>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="amount_to_be_paid"><strong>{{ __('bill.label.amount_to_be_paid') }}</strong></label><br />
                                <input type="number" class="form-control" name="amount_to_be_paid" value="{{ $data['bill']->getAmountToBePaid() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="amount_paid"><strong>{{ __('bill.label.amount_paid') }}</strong></label><br />
                                <input type="number" class="form-control" name="amount_paid" value="{{ $data['bill']->getAmountPaid() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="paid_in_advance"><strong>{{ __('bill.label.paid_in_advance') }}</strong></label><br />
                                <select class="form-control" name="paid_in_advance" id="paid_in_advance" required>
                                    @if($data['bill']->getPaidInAdvance() == 1)
                                        <option value="1" selected>{{ __('bill.label.paid_in_advance_option_1') }}</option>
                                        <option value="0">{{ __('bill.label.paid_in_advance_option_2') }}</option>
                                    @else
                                        <option value="1">{{ __('bill.label.paid_in_advance_option_1') }}</option>
                                        <option value="0" selected>{{ __('bill.label.paid_in_advance_option_2') }}</option>
                                    @endif
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="payment_type"><strong>{{ __('bill.label.payment_type') }}</strong></label><br />
                                <select class="form-control" name="payment_type" id="payment_type" required>
                                    @if($data['bill']->getPaidInAdvance() == 'cash')
                                        <option value="cash" selected>{{ __('bill.label.payment_type_option_1') }}</option>
                                        <option value="card">{{ __('bill.label.payment_type_option_2') }}</option>
                                    @else
                                        <option value="cash">{{ __('bill.label.payment_type_option_1') }}</option>
                                        <option value="card" selected>{{ __('bill.label.payment_type_option_2') }}</option>
                                    @endif
                                </select>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('bill.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
