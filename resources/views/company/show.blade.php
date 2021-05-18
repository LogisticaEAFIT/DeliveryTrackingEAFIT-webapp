@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["company"]->getName() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('company.label.id') }}</b><br /> {{ $data["company"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('company.label.name') }}</b><br /> {{ $data["company"]->getName() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('company.label.contact_info') }}</b><br /> {{ $data["company"]->getContactInfo() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('company.label.is_active') }}</b><br /> {{ $data["company"]->getIsActive() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('company.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['company']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('company.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["company"]->getIsActive() == '1')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('company.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['company']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('company.input.deactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('company.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['company']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('company.input.reactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
