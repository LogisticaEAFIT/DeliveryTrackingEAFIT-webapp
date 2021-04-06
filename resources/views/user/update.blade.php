@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.list') }}">{{ __('user.title_list') }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.show', ['id'=>$data['user']->getId()]) }}">{{ $data['user']->getName() }}</a></li>
        <li class="breadcrumb-item active">{{ __('user.title_update') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card" align="center">
                <div class="card-header">{{ __('user.title_update') }}</div>

                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('user.update_save') }}" enctype="multipart/form-data" align="center">
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
                            <div class="col" align="center">
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
