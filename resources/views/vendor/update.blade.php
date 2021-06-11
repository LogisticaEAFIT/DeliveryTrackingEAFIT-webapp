@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('vendor.title_update') }}</div>

                <div class="card-body">

                    <form method="POST" action="{{ route('vendor.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['vendor']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="name"><strong>{{ __('vendor.label.name') }}</strong></label><br />
                                <input type="text" class="form-control" name="name" value="{{ $data['vendor']->getName() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="contact_info"><strong>{{ __('vendor.label.contact_info') }}</strong></label><br />
                                <input type="text" class="form-control" name="contact_info" value="{{ $data['vendor']->getContactInfo() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('vendor.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
