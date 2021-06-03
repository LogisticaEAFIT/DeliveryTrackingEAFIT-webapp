@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="row padding-bottom-20">
                <div class="col-6">
                    <form method="GET" action="{{ route('register') }}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('user.input.create') }}</button>
                    </form>
                </div>
                <div class="col-6 text-right">
                    <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('user.red_info') }}</span>
                </div>
            </div>
            <div class="card center-info">
                <div class="card-header">{{ __('user.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('user.label.id') }}</th>
                            <th scope="col">{{ __('user.label.name') }}</th>
                            <th scope="col">{{ __('user.label.email') }}</th>
                            <th scope="col">{{ __('user.label.id_card_number') }}</th>
                            <th scope="col">{{ __('user.label.role') }}</th>
                            <th scope="col">{{ __('user.label.company_id') }}</th>
                            <th scope="col">{{ __('user.label.warehouse_id') }}</th>
                            <th scope="col">{{ __('user.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["users"] as $user)
                        <tr>
                            @if($user->getIsActive() == '0')
                            <td class="red-option">{{ $user->getId() }}</td>
                            <td class="red-option">{{ $user->getName() }}</td>
                            <td class="red-option">{{ $user->getEmail() }}</td>
                            <td class="red-option">{{ $user->getIdCardNumber() }}</td>
                            <td class="red-option">{{ $user->getRole() }}</td>
                                @if($user->getCompanyId() != '')
                            <td class="red-option"><a href="{{ route('company.show', ['id'=>$user->getCompanyId()]) }}"> <strong>{{ $user->getCompanyId() }} - {{ $user->company->getName() }}</strong></a></td>
                                @else
                            <td class="red-option">N/A</td>
                                @endif
                                @if($user->getWarehouseId() != '')
                                @if($user->warehouse->getName() != '')
                            <td class="red-option"><a href="{{ route('warehouse.show', ['id'=>$user->getWarehouseId()]) }}"> <strong>{{ $user->getWarehouseId() }} - {{ $user->warehouse->getName() }}</strong></a></td>
                                @else
                            <td class="red-option"><a href="{{ route('warehouse.show', ['id'=>$user->getWarehouseId()]) }}"> <strong>{{ $user->getWarehouseId() }}</strong></a></td>
                                @endif
                                @else
                            <td class="red-option">N/A</td>
                                @endif
                            @else
                            <td>{{ $user->getId() }}</td>
                            <td>{{ $user->getName() }}</td>
                            <td>{{ $user->getEmail() }}</td>
                            <td>{{ $user->getIdCardNumber() }}</td>
                            <td>{{ $user->getRole() }}</td>
                                @if($user->getCompanyId() != '')
                            <td><a href="{{ route('company.show', ['id'=>$user->getCompanyId()]) }}"> <strong>{{ $user->getCompanyId() }} - {{ $user->company->getName() }}</strong></a></td>
                                @else
                            <td>N/A</td>
                                @endif
                                @if($user->getWarehouseId() != '')
                                @if($user->warehouse->getName() != '')
                            <td><a href="{{ route('warehouse.show', ['id'=>$user->getWarehouseId()]) }}"> <strong>{{ $user->getWarehouseId() }} - {{ $user->warehouse->getName() }}</strong></a></td>
                                @else
                            <td><a href="{{ route('warehouse.show', ['id'=>$user->getWarehouseId()]) }}"> <strong>{{ $user->getWarehouseId() }}</strong></a></td>
                                @endif
                                @else
                            <td>N/A</td>
                                @endif
                            @endif
                            <td><a href="{{ route('user.show', ['id'=>$user->getId()]) }}"> {{ __('user.label.info') }} <strong>{{ $user->getName() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br/>
            <nav class="center-info" aria-label="Page navigation example">
                {{$data["users"]->links()}}
            </nav>
        </div>
    </div>
</div>
@endsection
