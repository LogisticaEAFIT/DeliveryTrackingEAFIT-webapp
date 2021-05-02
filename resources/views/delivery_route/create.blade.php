@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('delivery_route.title_create') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('delivery_route.save') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('delivery_route.label.date') }} <b class="red-asterisk">*</b></label>
                            <div class="col-md-6">
                                <div class='input-group'>
                                    <input type='date' class="form-control @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}" required autocomplete="date" autofocus/>
                                </div>
                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number_of_deliveries" class="col-md-4 col-form-label text-md-right">{{ __('delivery_route.label.number_of_deliveries') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="number_of_deliveries" type="text" class="form-control @error('number_of_deliveries') is-invalid @enderror" name="number_of_deliveries" value="{{ old('number_of_deliveries') }}" required autocomplete="number_of_deliveries">

                                @error('number_of_deliveries')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="completed_deliveries" class="col-md-4 col-form-label text-md-right">{{ __('delivery_route.label.completed_deliveries') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="completed_deliveries" type="text" class="form-control @error('completed_deliveries') is-invalid @enderror" name="completed_deliveries" value="{{ old('completed_deliveries') }}" required autocomplete="completed_deliveries">

                                @error('completed_deliveries')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="courier_id" class="col-md-4 col-form-label text-md-right">{{ __('delivery_route.label.courier_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <select class="form-control @error('courier_id') is-invalid @enderror" name="courier_id" id="courier_id" required>
                                    @if(Auth::user()->getRole()=="super_admin")
                                        @foreach($data["couriers"] as $courier)
                                            @if($courier->getIsActive() == '1')
                                            <option  value="{{ $courier->getWarehouseId() }}-{{ $courier->getId() }}"  selected> 
                                                {{ $courier->getWarehouseId() }} -> {{ $courier->warehouse->getName() }} --- {{ $courier->getId() }} -> {{ $courier->getName() }}
                                            </option>
                                            @endif
                                        @endforeach
                                    @elseif(Auth::user()->getRole()=="company_admin")
                                        @foreach($data["couriers"] as $courier)
                                            @if($courier->getIsActive() == '1')
                                                @if($courier->getCompanyId() == Auth::user()->getCompanyId())
                                            <option  value="{{ $courier->getWarehouseId() }}-{{ $courier->getId() }}"  selected> 
                                                {{ $courier->getWarehouseId() }} -> {{ $courier->warehouse->getName() }} --- {{ $courier->getId() }} -> {{ $courier->getName() }}
                                            </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    @elseif(Auth::user()->getRole()=="warehouse_admin")
                                        @foreach($data["couriers"] as $courier)
                                            @if($courier->getIsActive() == '1')
                                                @if($courier->getWarehouseId() == Auth::user()->getWarehouseId())
                                            <option  value="{{ $courier->getWarehouseId() }}-{{ $courier->getId() }}"  selected> 
                                                {{ $courier->getWarehouseId() }} -> {{ $courier->warehouse->getName() }} --- {{ $courier->getId() }} -> {{ $courier->getName() }}
                                            </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </select>

                                @error('courier_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vehicle_id" class="col-md-4 col-form-label text-md-right">{{ __('delivery_route.label.vehicle_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <select class="form-control @error('vehicle_id') is-invalid @enderror" name="vehicle_id" id="vehicle_id" required>
                                    @if(Auth::user()->getRole()=="super_admin")
                                        @foreach($data["vehicles"] as $vehicle)
                                            @if($vehicle->getIsActive() == '1')
                                            <option  value="{{ $vehicle->getWarehouseId() }}-{{ $vehicle->getId() }}"  selected> 
                                                {{ $vehicle->getWarehouseId() }} -> {{ $vehicle->warehouse->getName() }} --- {{ $vehicle->getId() }} -> {{ $vehicle->getName() }}
                                            </option>
                                            @endif
                                        @endforeach
                                    @elseif(Auth::user()->getRole()=="company_admin")
                                        @foreach($data["vehicles"] as $vehicle)
                                            @if($vehicle->getIsActive() == '1')
                                                @if($vehicle->warehouse->getCompanyId() == Auth::user()->getCompanyId())
                                            <option  value="{{ $vehicle->getWarehouseId() }}-{{ $vehicle->getId() }}"  selected> 
                                                {{ $vehicle->getWarehouseId() }} -> {{ $vehicle->warehouse->getName() }} --- {{ $vehicle->getId() }} -> {{ $vehicle->getName() }}
                                            </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    @elseif(Auth::user()->getRole()=="warehouse_admin")
                                        @foreach($data["vehicles"] as $vehicle)
                                            @if($vehicle->getIsActive() == '1')
                                                @if($vehicle->getWarehouseId() == Auth::user()->getWarehouseId())
                                            <option  value="{{ $vehicle->getWarehouseId() }}-{{ $vehicle->getId() }}"  selected> 
                                                {{ $vehicle->getWarehouseId() }} -> {{ $vehicle->warehouse->getName() }} --- {{ $vehicle->getId() }} -> {{ $vehicle->getName() }}
                                            </option>
                                                @endif
                                            @endif
                                        @endforeach
                                    @endif
                                </select>

                                @error('vehicle_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('delivery_route.input.create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        $(document).ready(function () {
            $('.datepicker').datetimepicker({
                format: "dd/mm/yyyy",
                language: "es",
                autoclose: true
            });
        });
    </script>
</div>
@endsection
