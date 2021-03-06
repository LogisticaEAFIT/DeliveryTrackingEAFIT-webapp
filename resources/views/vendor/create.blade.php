@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('vendor.title_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vendor.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('vendor.label.name') }} <b class="red-asterisk">*</b></label>

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
                            <label for="contact_info" class="col-md-4 col-form-label text-md-right">{{ __('vendor.label.contact_info') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="contact_info" type="text" class="form-control @error('contact_info') is-invalid @enderror" name="contact_info" value="{{ old('contact_info') }}" required autocomplete="contact_info">

                                @error('contact_info')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        @if(Auth::user()->getRole()=="super_admin")
                        <div class="form-group row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('vendor.label.company_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <select class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id" required>
                                    @foreach($data["companies"] as $company)
                                        @if($company->getIsActive() == '1')
                                        <option  value="{{$company->getId()}}"  selected> {{ $company->getId() }} ->
                                            <b>{{ __('company.label.name') }}:</b> {{ $company->getName() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @else
                        <div class="form-group row">
                            <label for="id_card_number" class="col-md-4 col-form-label text-md-right">{{ __('vendor.label.company_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input type="text" value="{{ Auth::user()->getCompanyId() }}" disabled/>
                                <input type="hidden" class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id" value="{{ Auth::user()->getCompanyId() }}"/>

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('vendor.input.create') }}
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
