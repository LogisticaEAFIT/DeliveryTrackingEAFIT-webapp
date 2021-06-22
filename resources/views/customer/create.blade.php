@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('customer.title_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('customer.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('customer.label.name') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="phone_number" class="col-md-4 col-form-label text-md-right">{{ __('customer.label.phone_number') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <div class="input-group">
                                    <span class="input-group-text">Prefix</span>
                                    <input id="phone_number_prefix" type="text" class="form-control @error('phone_number_prefix') is-invalid @enderror col-1" name="phone_number_prefix" value="{{ old('phone_number_prefix') }}" required autocomplete="phone_number_prefix">
                                    <input id="phone_number" type="text" class="form-control @error('phone_number') is-invalid @enderror col-11" name="phone_number" value="{{ old('phone_number') }}" required autocomplete="phone_number">
                                </div>

                                @error('phone_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                                @error('phone_number_prefix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('customer.label.address') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="latitude" class="col-md-4 col-form-label text-md-right">{{ __('customer.label.latitude') }} <b class="red-asterisk">*</b></label>

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
                            <label for="longitude" class="col-md-4 col-form-label text-md-right">{{ __('customer.label.longitude') }} <b class="red-asterisk">*</b></label>

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
                            <label for="observations" class="col-md-4 col-form-label text-md-right">{{ __('customer.label.observations') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <textarea id="observations" type="text" class="form-control @error('observations') is-invalid @enderror" name="observations" value="{{ old('observations') }}" required autocomplete="observations" autofocus></textarea>

                                @error('observations')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('customer.label.company_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                            @if(Auth::user()->getRole()=="super_admin")
                                <select class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id" required>
                                    @foreach($data["companies"] as $company)
                                        @if($company->getIsActive() == '1')
                                        <option  value="{{$company->getId()}}"  selected> {{ $company->getId() }} ->
                                            <b>{{ __('company.label.name') }}:</b> {{ $company->getName() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                            @elseif(Auth::user()->getRole()=="company_admin")
                                <input type="text" value="{{ Auth::user()->getCompanyId() }}" disabled/>
                                <input type="hidden" class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id" value="{{ Auth::user()->getCompanyId() }}"/>
                            @endif

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('customer.input.create') }}
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
