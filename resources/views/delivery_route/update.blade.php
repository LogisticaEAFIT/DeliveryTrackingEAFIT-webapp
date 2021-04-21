@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin" || Auth::user()->getRole()=="warehouse_admin")
        <li class="breadcrumb-item"><a href="{{ route('delivery_route.list') }}">{{ __('delivery_route.title_list') }}</a></li>
        @endif
        <li class="breadcrumb-item"><a href="{{ route('delivery_route.show', ['id'=>$data['delivery_route']->getId()]) }}">{{ $data['delivery_route']->getId() }}</a></li>
        <li class="breadcrumb-item active">{{ __('delivery_route.title_update') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card center-info">
                <div class="card-header">{{ __('delivery_route.title_update') }}</div>

                <div class="card-body">
                    @if($errors->any())
                        @foreach($errors->all() as $error)
                            <div class="alert alert-danger alert-block">
                                <button type="button" class="close" data-dismiss="alert">x</button>
                                <strong>{{ $error }}</strong>
                            </div>
                        @endforeach
                    @endif

                    <form method="POST" action="{{ route('delivery_route.update_save') }}" enctype="multipart/form-data" class="center-info">
                        @csrf
                        <input type="hidden" name="id" value="{{ $data['delivery_route']->getId() }}" />
                        <div class="form-row col-12">
                            <div class="col-2"></div>
                            <div class="col-8">
                                <label for="date"><strong>{{ __('delivery_route.label.date') }}</strong></label><br />
                                <input type="text" class="form-control" name="date" value="{{ $data['delivery_route']->getDate() }}" required>
                            </div>
                        </div><br />
                        <div class="form-row col-12">
                            <div class="col-6">
                                <label for="number_of_deliveries"><strong>{{ __('delivery_route.label.number_of_deliveries') }}</strong></label><br />
                                <input type="text" class="form-control" name="number_of_deliveries" value="{{ $data['delivery_route']->getNumberOfDeliveries() }}" required/>
                            </div>
                            <div class="col-6">
                                <label for="completed_deliveries"><strong>{{ __('delivery_route.label.completed_deliveries') }}</strong></label><br />
                                <input type="text" class="form-control" name="completed_deliveries" value="{{ $data['delivery_route']->getCompletedDeliveries() }}" required/>
                            </div>
                        </div><br />
                        <div class="form-row justify-content-center">
                            <div class="col center-info">
                                <input type="submit" value="{{ __('delivery_route.input.update') }}" class="btn btn-primary"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
