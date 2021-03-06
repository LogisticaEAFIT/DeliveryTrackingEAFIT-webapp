@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('warehouse.title_update') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('warehouse.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['warehouse']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="name"><strong>{{ __('warehouse.label.name') }}</strong></label><br />
                                <input type="text" class="form-control" name="name" value="{{ $data['warehouse']->getName() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="description"><strong>{{ __('warehouse.label.description') }}</strong></label><br />
                                <textarea type="text" class="form-control" name="description">{{ $data['warehouse']->getDescription() }}</textarea>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-4">
                                <label for="address"><strong>{{ __('warehouse.label.address') }}</strong></label><br />
                                <input type="text" class="form-control" name="address" value="{{ $data['warehouse']->getAddress() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="latitude"><strong>{{ __('warehouse.label.latitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="latitude" value="{{ $data['warehouse']->getLatitude() }}" required/>
                            </div>
                            <div class="col-4">
                                <label for="longitude"><strong>{{ __('warehouse.label.longitude') }}</strong></label><br />
                                <input type="text" class="form-control" name="longitude" value="{{ $data['warehouse']->getLongitude() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('warehouse.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
