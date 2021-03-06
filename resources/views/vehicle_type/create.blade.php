@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('vehicle_type.title_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vehicle_type.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="capacity" class="col-md-4 col-form-label text-md-right" title="{{ __('vehicle_type.input.capacity') }}">{{ __('vehicle_type.label.capacity') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="capacity" type="text" class="form-control @error('capacity') is-invalid @enderror" title="{{ __('vehicle_type.input.capacity') }}" name="capacity" value="{{ old('capacity') }}" required autocomplete="capacity" aria-describedby="capacityHelpInline">
                                <span id="capacityHelpInline" class="form-text">
                                    {{ __('vehicle_type.input.capacity') }}
                                </span>
                                @error('capacity')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('vehicle_type.label.description') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <textarea id="description" type="text" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description" autofocus></textarea>

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="volume" class="col-md-4 col-form-label text-md-right" title="{{ __('vehicle_type.input.volume') }}">{{ __('vehicle_type.label.volume') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="volume" type="text" class="form-control @error('volume') is-invalid @enderror" title="{{ __('vehicle_type.input.volume') }}" name="volume" value="{{ old('volume') }}" required autocomplete="volume" aria-describedby="volumeHelpInline">
                                <span id="volumeHelpInline" class="form-text">
                                    {{ __('vehicle_type.input.volume') }}
                                </span>
                                @error('volume')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('vehicle_type.input.create') }}
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
