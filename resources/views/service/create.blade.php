@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('service.title_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('service.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="lower_time_window" class="col-md-4 col-form-label text-md-right">{{ __('service.label.lower_time_window') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="lower_time_window" type="text" class="form-control @error('lower_time_window') is-invalid @enderror" name="lower_time_window" value="{{ old('lower_time_window') }}" required autocomplete="lower_time_window" aria-describedby="lowerTimeWindowHelpInline">
                                <span id="lowerTimeWindowHelpInline" class="form-text">
                                    {{ __('service.input.lower_time_window') }}
                                </span>
                                @error('lower_time_window')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="upper_time_window" class="col-md-4 col-form-label text-md-right">{{ __('service.label.upper_time_window') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="upper_time_window" type="text" class="form-control @error('upper_time_window') is-invalid @enderror" name="upper_time_window" value="{{ old('upper_time_window') }}" required autocomplete="upper_time_window" aria-describedby="upperTimeWindowHelpInline">
                                <span id="lowerTimeWindowHelpInline" class="form-text">
                                    {{ __('service.input.upper_time_window') }}
                                </span>
                                @error('upper_time_window')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="route_order" class="col-md-4 col-form-label text-md-right">{{ __('service.label.route_order') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="route_order" type="text" class="form-control @error('route_order') is-invalid @enderror" name="route_order" value="{{ old('route_order') }}" required autocomplete="route_order">

                                @error('route_order')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="latitude" class="col-md-4 col-form-label text-md-right">{{ __('service.label.latitude') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="latitude" type="text" class="form-control @error('latitude') is-invalid @enderror" name="latitude" value="{{ old('latitude') }}" required autocomplete="latitude">

                                @error('latitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="longitude" class="col-md-4 col-form-label text-md-right">{{ __('service.label.longitude') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="longitude" type="text" class="form-control @error('longitude') is-invalid @enderror" name="longitude" value="{{ old('longitude') }}" required autocomplete="longitude">

                                @error('longitude')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="delivery_route_id" class="col-md-4 col-form-label text-md-right">{{ __('service.label.delivery_route_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                            @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin")
                                <select class="form-control @error('delivery_route_id') is-invalid @enderror" name="delivery_route_id" id="delivery_route_id" required>
                                    @foreach($data["delivery_routes"] as $delivery_route)
                                        @if($delivery_route->getState() == 'started')
                                        <option  value="{{$delivery_route->getId()}}"  selected> {{ $delivery_route->getId() }} ->
                                            <b>{{ __('delivery_route.label.date') }}:</b> {{ $delivery_route->getDate() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                            @elseif(Auth::user()->getRole()=="warehouse_admin")
                                <select class="form-control @error('delivery_route_id') is-invalid @enderror" name="delivery_route_id" id="delivery_route_id" required>
                                    @foreach($data["delivery_routes"] as $delivery_route)
                                        @if($delivery_route->getState() == 'started')
                                        @if($delivery_route->getWarehouseId() == Auth::user()->getWarehouseId())
                                        <option  value="{{$delivery_route->getId()}}"  selected> {{ $delivery_route->getId() }} ->
                                            <b>{{ __('delivery_route.label.date') }}:</b> {{ $delivery_route->getDate() }}
                                        </option>
                                        @endif
                                        @endif
                                    @endforeach
                                </select>
                            @endif

                                @error('delivery_route_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('service.input.create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
