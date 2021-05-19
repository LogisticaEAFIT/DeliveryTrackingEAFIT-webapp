@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('vehicle.title_update') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('vehicle.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['vehicle']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="name"><strong>{{ __('vehicle.label.name') }}</strong></label><br />
                                <input type="text" class="form-control" name="name" value="{{ $data['vehicle']->getName() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="observations"><strong>{{ __('vehicle.label.observations') }}</strong></label><br />
                                <textarea type="text" class="form-control" name="observations" required>{{ $data['vehicle']->getObservations() }}</textarea>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('vehicle.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
