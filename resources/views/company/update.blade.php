@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('company.list') }}">{{ __('company.title_list') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('company.show', ['id'=>$data['company']->getId()]) }}">{{ $data['company']->getName() }}</a></li>
        <li class="breadcrumb-item active">{{ __('company.title_update') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('company.title_update') }}</div>

                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('company.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['company']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <label for="name"><strong>{{ __('company.label.name') }}</strong></label><br />
                                <input type="text" class="form-control" name="name" value="{{ $data['company']->getName() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <label for="contact_info"><strong>{{ __('company.label.contact_info') }}</strong></label><br />
                                <input type="text" class="form-control" name="contact_info" value="{{ $data['company']->getContactInfo() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('company.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
