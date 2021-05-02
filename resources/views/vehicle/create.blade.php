@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('vehicle.title_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vehicle.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('vehicle.label.name') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name">

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="observations" class="col-md-4 col-form-label text-md-right">{{ __('vehicle.label.observations') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <textarea id="observations" type="text" class="form-control @error('observations') is-invalid @enderror" name="observations" value="{{ old('observations') }}" required autocomplete="observations" autofocus></textarea>

                                @error('observations')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        
                        <div class="form-group row">
                            <label for="warehouse_id" class="col-md-4 col-form-label text-md-right">{{ __('vehicle.label.warehouse_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                            @if(Auth::user()->getRole()=="super_admin")
                                <select class="form-control @error('warehouse_id') is-invalid @enderror" name="warehouse_id" id="warehouse_id" required>
                                    @foreach($data["warehouses"] as $warehouse)
                                        @if($warehouse->getIsActive() == '1')
                                        <option  value="{{$warehouse->getId()}}"  selected> {{ $warehouse->getId() }} ->
                                            <b>{{ __('warehouse.label.name') }}:</b> {{ $warehouse->getName() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>
                            @elseif(Auth::user()->getRole()=="company_admin")
                                <select class="form-control @error('warehouse_id') is-invalid @enderror" name="warehouse_id" id="warehouse_id" required>
                                    @foreach($data["warehouses"] as $warehouse)
                                        @if($warehouse->getIsActive() == '1')
                                        @if($warehouse->getCompanyId() == Auth::user()->getCompanyId())
                                        <option  value="{{$warehouse->getId()}}"  selected> {{ $warehouse->getId() }} ->
                                            <b>{{ __('warehouse.label.name') }}:</b> {{ $warehouse->getName() }}
                                        </option>
                                        @endif
                                        @endif
                                    @endforeach
                                </select>
                            @else
                                <input type="text" value="{{ Auth::user()->getWarehouseId() }}" disabled/>
                                <input type="hidden" class="form-control @error('warehouse_id') is-invalid @enderror" name="warehouse_id" id="warehouse_id" value="{{ Auth::user()->getWarehouseId() }}"/>
                            @endif

                                @error('warehouse_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="type_id" class="col-md-4 col-form-label text-md-right">{{ __('vehicle.label.type_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <select class="form-control @error('type_id') is-invalid @enderror" name="type_id" id="type_id" required>
                                    @foreach($data["vehicle_types"] as $vehicle_type)
                                        @if($vehicle_type->getIsActive() == '1')
                                        <option value="{{$vehicle_type->getId()}}"  selected> {{ $vehicle_type->getId() }} ->
                                            <b>{{ __('vehicle_type.label.capacity') }}:</b> {{ $vehicle_type->getCapacity() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('type_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                       
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('vehicle.input.create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
