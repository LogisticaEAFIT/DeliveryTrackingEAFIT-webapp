@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('delivery_route.title_update') }}</div>

                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('delivery_route.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['delivery_route']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="date"><strong>{{ __('delivery_route.label.date') }}</strong></label><br />
                                <input type="text" class="form-control" name="date" value="{{ $data['delivery_route']->getDate() }}" required>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="number_of_deliveries"><strong>{{ __('delivery_route.label.number_of_deliveries') }}</strong></label><br />
                                <input type="text" class="form-control" name="number_of_deliveries" value="{{ $data['delivery_route']->getNumberOfDeliveries() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="completed_deliveries"><strong>{{ __('delivery_route.label.completed_deliveries') }}</strong></label><br />
                                <input type="text" class="form-control" name="completed_deliveries" value="{{ $data['delivery_route']->getCompletedDeliveries() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('delivery_route.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
