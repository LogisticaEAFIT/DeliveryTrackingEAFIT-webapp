@extends('layouts.app')

@section('content')
<head>
    <script type="text/javascript">

        function roleSelected(){
            var role = document.getElementById("role").value;
            if(role == "super_admin"){
                document.getElementById("company_id_block").style.display = 'none';
                document.getElementById("warehouse_id_block").style.display = 'none';

                document.getElementById("company_id").value = 'null';
                document.getElementById("warehouse_id").value = 'null';
            }else if(role == "company_admin"){
                document.getElementById("company_id_block").style.display = 'flex';
                document.getElementById("warehouse_id_block").style.display = 'none';

                document.getElementById("warehouse_id").value = 'null';
            }else if(role == "warehouse_admin"){
                document.getElementById("company_id_block").style.display = 'none';
                document.getElementById("warehouse_id_block").style.display = 'flex';
            }else{
                document.getElementById("company_id_block").style.display = 'none';
                document.getElementById("warehouse_id_block").style.display = 'flex';
            }
        }
    </script>
</head>
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">{{ __('pagination.home') }}</a></li>
        <li class="breadcrumb-item active">{{ __('Register') }}</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('user.label.name') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('user.label.email') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="id_card_number" class="col-md-4 col-form-label text-md-right">{{ __('user.label.id_card_number') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="id_card_number" type="text" class="form-control @error('id_card_number') is-invalid @enderror" name="id_card_number" value="{{ old('id_card_number') }}" required autocomplete="id_card_number">

                                @error('id_card_number')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="role" class="col-md-4 col-form-label text-md-right">{{ __('Role') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <select id="role" name="role" class="form-control @error('role') is-invalid @enderror" required autocomplete="role" onchange="roleSelected()">
                                    @if(Auth::user()->getRole()=="super_admin")
                                    <option value="super_admin" selected>{{ __('Super Admin') }}</option>
                                    @endif
                                    @if(Auth::user()->getRole()=="super_admin" || Auth::user()->getRole()=="company_admin")
                                    <option value="company_admin">{{ __('Company Admin') }}</option>
                                    <option value="warehouse_admin">{{ __('Warehouse Admin') }}</option>
                                    @endif
                                    <option value="courier">{{ __('Courier') }}</option>
                                </select><br />

                                @error('role')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @if(Auth::user()->getRole()=="super_admin")
                        <div class="form-group row display-block-none" id="company_id_block">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('user.label.company_id') }} <b class="red-asterisk">*</b></label>
                            
                            <div class="col-md-6">
                                <select class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id" required>
                                    <option value="null">N/A</option>
                                    @foreach($data["companies"] as $company)
                                        @if($company->getIsActive() == '1')
                                        <option  value="{{$company->getId()}}"  selected> {{ $company->getId() }} ->
                                            <b>{{ __('company.label.name') }}:</b> {{ $company->getName() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @else
                        <div class="form-group row" id="company_id_block">
                            <label for="company_id" class="col-md-4 col-form-label text-md-right">{{ __('user.label.company_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('company_id') is-invalid @enderror" value="{{ Auth::user()->getCompanyId() }}" disabled/>
                                <input type="hidden" class="form-control @error('company_id') is-invalid @enderror" name="company_id" id="company_id" value="{{ Auth::user()->getCompanyId() }}"/>

                                @error('company_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        @endif
                        @if(Auth::user()->getRole()=="company_admin")
                        <div class="form-group row display-block-none" id="warehouse_id_block">
                            <label for="warehouse_id" class="col-md-4 col-form-label text-md-right">{{ __('user.label.warehouse_id') }} <b class="red-asterisk">*</b></label>
                            
                            <div class="col-md-6">
                                <select class="form-control @error('warehouse_id') is-invalid @enderror" name="warehouse_id" id="warehouse_id" required>
                                    <option value="null" selected>N/A</option>
                                    @foreach($data["warehouses"] as $warehouse)
                                        @if($warehouse->getIsActive() == '1')
                                        <option  value="{{$warehouse->getCompanyId()}}-{{$warehouse->getId()}}">
                                        {{ $warehouse->getCompanyId() }} - {{ $warehouse->company->getName() }} - {{ $warehouse->getId() }} - {{ $warehouse->getAddress() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('warehouse_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @elseif(Auth::user()->getRole()=="super_admin")
                        <div class="form-group row display-block-none" id="warehouse_id_block">
                            <label for="warehouse_id" class="col-md-4 col-form-label text-md-right">{{ __('user.label.warehouse_id') }} <b class="red-asterisk">*</b></label>
                            
                            <div class="col-md-6">
                                <select class="form-control @error('warehouse_id') is-invalid @enderror" name="warehouse_id" id="warehouse_id" required>
                                    <option value="null">N/A</option>
                                    @foreach($data["warehouses"] as $warehouse)
                                        @if($warehouse->getIsActive() == '1')
                                        <option  value="{{$warehouse->getCompanyId()}}-{{$warehouse->getId()}}"  selected>
                                        {{ $warehouse->getCompanyId() }} - {{ $warehouse->company->getName() }} - {{ $warehouse->getId() }} - {{ $warehouse->getAddress() }}
                                        </option>
                                        @endif
                                    @endforeach
                                </select>

                                @error('warehouse_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @else
                        <div class="form-group row" id="warehouse_id_block">
                            <label for="warehouse_id" class="col-md-4 col-form-label text-md-right">{{ __('user.label.warehouse_id') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control @error('warehouse_id') is-invalid @enderror" value="{{ Auth::user()->getCompanyId() }} - {{ Auth::user()->company->getName() }} - {{ Auth::user()->getWarehouseId() }} - {{ Auth::user()->warehouse->getAddress() }}" disabled/>
                                <input type="hidden" class="form-control @error('warehouse_id') is-invalid @enderror" name="warehouse_id" id="warehouse_id" value="{{ Auth::user()->getCompanyId() }}-{{ Auth::user()->getWarehouseId() }}"/>

                                @error('warehouse_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        @endif
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }} <b class="red-asterisk">*</b></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
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
