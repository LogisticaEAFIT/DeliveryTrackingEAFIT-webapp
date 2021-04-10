@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('warehouse.list') }}">{{ __('warehouse.title_list') }}</a></li>
        <li class="breadcrumb-item active">{{ $data["warehouse"]->getId() }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["warehouse"]->getId() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-6">
                            <b>{{ __('warehouse.label.id') }}</b><br /> {{ $data["warehouse"]->getId() }}<br />
                        </div>
                        <div class="col-6">
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
                            <b>{{ __('warehouse.label.company_id') }}</b><br /> {{ $data["warehouse"]->getCompanyId() }}<br />
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
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('warehouse.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['warehouse']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> {{ __('warehouse.input.delete') }}</button>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
