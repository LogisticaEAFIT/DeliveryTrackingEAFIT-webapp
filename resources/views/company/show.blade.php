@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        @if(Auth::user()->getRole()=="super_admin")
        <li class="breadcrumb-item"><a href="{{ route('company.list') }}">{{ __('company.title_list') }}</a></li>
        @endif
        <li class="breadcrumb-item active">{{ $data["company"]->getName() }}</li>
    </ol>
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
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-alt"></i> {{ __('company.input.deactivate') }}</button>
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
