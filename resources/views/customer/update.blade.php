@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('customer.title_update') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('customer.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['customer']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="name"><strong>{{ __('customer.label.name') }}</strong></label><br />
                                <input type="text" class="form-control" name="name" value="{{ $data['customer']->getName() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="phone_number"><strong>{{ __('customer.label.phone_number') }}</strong></label><br />
                                <input type="text" class="form-control" name="phone_number" value="{{ $data['customer']->getPhoneNumber() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-4">
                                <label for="address"><strong>{{ __('customer.label.address') }}</strong></label><br />
                                <input type="text" class="form-control" name="address" value="{{ $data['customer']->getAddress() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="latitude"><strong>{{ __('customer.label.latitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="latitude" value="{{ $data['customer']->getLatitude() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="longitude"><strong>{{ __('customer.label.longitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="longitude" value="{{ $data['customer']->getLongitude() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="observations"><strong>{{ __('customer.label.observations') }}</strong></label><br />
                                <textarea type="text" class="form-control" name="observations" required>{{ $data['customer']->getObservations() }}</textarea>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('customer.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
