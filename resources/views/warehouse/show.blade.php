@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["warehouse"]->getName() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('warehouse.label.id') }}</b><br /> {{ $data["warehouse"]->getId() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('warehouse.label.name') }}</b><br /> {{ $data["warehouse"]->getName() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('warehouse.label.address') }}</b><br /> {{ $data["warehouse"]->getAddress() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <b>{{ __('warehouse.label.description') }}</b><br /> {{ $data["warehouse"]->getDescription() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('warehouse.label.latitude') }}</b><br /> {{ $data["warehouse"]->getLatitude() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('warehouse.label.longitude') }}</b><br /> {{ $data["warehouse"]->getLongitude() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('warehouse.label.company_id') }}</b><br /> <a href="{{ route('company.show', ['id'=>$data['warehouse']->getCompanyId()]) }}"><strong>{{ $data["warehouse"]->getCompanyId() }} - {{ $data["warehouse"]->company->getName() }}</strong></a><br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('warehouse.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['warehouse']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('warehouse.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    @if($data["warehouse"]->getIsActive() == '1')
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('warehouse.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['warehouse']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-toggle-off"></i> {{ __('warehouse.input.deactivate') }}</button>
                            </form>
                        </div>
                    </div>
                    @else
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('warehouse.reactivate') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['warehouse']->getId() }}" />
                                <button type="submit" class="btn btn-success"><i class="fa fa-toggle-on"></i> {{ __('warehouse.input.reactivate') }}</button>
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
