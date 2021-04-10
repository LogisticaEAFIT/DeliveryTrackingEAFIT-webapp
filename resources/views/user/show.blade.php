@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.list') }}">{{ __('user.title_list') }}</a></li>
        <li class="breadcrumb-item active">{{ $data["user"]->getName() }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header"><i class="fa fa-info-circle"></i> {{ $data["user"]->getName() }}</div>

                <div class="card-body">
                    <div class="row center-info">
                        <div class="col-3">
                            <b>{{ __('user.label.id') }}</b><br /> {{ $data["user"]->getId() }}<br />
                        </div>
                        <div class="col-3">
                            <b>{{ __('user.label.name') }}</b><br /> {{ $data["user"]->getName() }}<br />
                        </div>
                        <div class="col-3">
                            @if($data["user"]->getCompanyId() != '')
                            <b>{{ __('user.label.company_id') }}</b><br /> {{ $data["user"]->getCompanyId() }}<br />
                            @else
                            <b>{{ __('user.label.company_id') }}</b><br /> N/A<br />
                            @endif
                        </div>
                        <div class="col-3">
                            @if($data["user"]->getWarehouseId() != '')
                            <b>{{ __('user.label.warehouse_id') }}</b><br /> {{ $data["user"]->getWarehouseId() }}<br />
                            @else
                            <b>{{ __('user.label.warehouse_id') }}</b><br /> N/A<br />
                            @endif
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-4">
                            <b>{{ __('user.label.email') }}</b><br /> {{ $data["user"]->getEmail() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('user.label.id_card_number') }}</b><br /> {{ $data["user"]->getIdCardNumber() }}<br />
                        </div>
                        <div class="col-4">
                            <b>{{ __('user.label.role') }}</b><br /> {{ $data["user"]->getRole() }}<br />
                        </div>
                    </div><hr/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="GET" action="{{ route('user.update') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['user']->getId() }}" />
                                <button type="submit" class="btn btn-primary"><i class="fa fa-pencil-alt"></i> {{ __('user.input.update') }}</button>
                            </form>
                        </div>
                    </div><br/>
                    <div class="row center-info">
                        <div class="col-12">
                            <form method="POST" action="{{ route('user.delete') }}">
                                @csrf
                                <input type="hidden" name="id" value="{{ $data['user']->getId() }}" />
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> {{ __('user.input.delete') }}</button>
                            </form>
                        </div>
                    </div> 
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
