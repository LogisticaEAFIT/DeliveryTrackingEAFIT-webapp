@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["vendor"]->getName() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('vendor.label.id') }}</b><br /> {{ $data["vendor"]->getId() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('vendor.label.name') }}</b><br /> {{ $data["vendor"]->getName() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('vendor.label.contact_info') }}</b><br /> {{ $data["vendor"]->getContactInfo() }}<br />
                        </div>
                        <div class="col-6">
                            <b>{{ __('vendor.label.company_id') }}</b><br /> <a href="{{ route('company.show', ['id'=>$data['vendor']->getCompanyId()]) }}"><strong>{{ $data["vendor"]->getCompanyId() }} - {{ $data["vendor"]->company->getName() }}</strong></a><br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('vendor.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vendor']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('vendor.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["vendor"]->getIsActive() == '1')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('vendor.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vendor']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('vendor.input.deactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('vendor.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['vendor']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('vendor.input.reactivate') }}</button>
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
