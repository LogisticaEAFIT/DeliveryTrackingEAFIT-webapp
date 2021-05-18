@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('user.title_update') }}</div>

                <div class="card-body">
        
                    <form method="POST" action="{{ route('user.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['user']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="name"><strong>{{ __('user.label.name') }}</strong></label><br />
                                <input type="text" class="form-control" name="name" value="{{ $data['user']->getName() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="email"><strong>{{ __('user.label.email') }}</strong></label><br />
                                <input type="text" class="form-control" name="email" value="{{ $data['user']->getEmail() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-3"></div>
                            <div class="col-6">
                                <label for="id_card_number"><strong>{{ __('user.label.id_card_number') }}</strong></label><br />
                                <input type="text" class="form-control" name="id_card_number" value="{{ $data['user']->getIdCardNumber() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('user.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
