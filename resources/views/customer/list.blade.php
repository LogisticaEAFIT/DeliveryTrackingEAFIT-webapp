@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="row padding-bottom-20">
                <div class="col-6">
                    <form method="GET" action="{{ route('customer.create') }}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('customer.input.create') }}</button>
                    </form>
                </div>
                <div class="col-6 text-right">
                    <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('customer.red_info') }}</span>
                </div>
            </div>
            <div class="card center-info">
                <div class="card-header">{{ __('customer.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('customer.label.id') }}</th>
                            <th scope="col">{{ __('customer.label.name') }}</th>
                            <th scope="col">{{ __('customer.label.phone_number') }}</th>
                            <th scope="col">{{ __('customer.label.address') }}</th>
                            <th scope="col">{{ __('customer.label.latitude') }}</th>
                            <th scope="col">{{ __('customer.label.longitude') }}</th>
                            <th scope="col">{{ __('customer.label.observations') }}</th>
                            <th scope="col">{{ __('customer.label.company_id') }}</th>
                            <th scope="col">{{ __('customer.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["customers"] as $customer)
                        <tr>
                            @if($customer->getIsActive() == '0')
                            <td class="red-option">{{ $customer->getId() }}</td>
                            <td class="red-option">{{ $customer->getName() }}</td>
                            <td class="red-option">{{ $customer->getPhoneNumber() }}</td>
                            <td class="red-option">{{ $customer->getAddress() }}</td>
                            <td class="red-option">{{ $customer->getLatitude() }}</td>
                            <td class="red-option">{{ $customer->getLongitude() }}</td>
                            <td class="red-option">{{ $customer->getObservations() }}</td>
                            <td class="red-option"><a href="{{ route('company.show', ['id'=>$customer->getCompanyId()]) }}"><strong>{{ $customer->getCompanyId() }} - {{ $customer->company->getName() }}</strong></a></td>
                            @else
                            <td>{{ $customer->getId() }}</td>
                            <td>{{ $customer->getName() }}</td>
                            <td>{{ $customer->getPhoneNumber() }}</td>
                            <td>{{ $customer->getAddress() }}</td>
                            <td>{{ $customer->getLatitude() }}</td>
                            <td>{{ $customer->getLongitude() }}</td>
                            <td>{{ $customer->getObservations() }}</td>
                            <td><a href="{{ route('company.show', ['id'=>$customer->getCompanyId()]) }}"><strong>{{ $customer->getCompanyId() }} - {{ $customer->company->getName() }}</strong></a></td>
                            @endif
                            <td><a href="{{ route('customer.show', ['id'=>$customer->getId()]) }}"> {{ __('customer.label.info') }} <strong>{{ $customer->getName() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br/>
            <nav class="center-info" aria-label="Page navigation example">
                {{$data["customers"]->links()}}
            </nav>
        </div>
    </div>
</div>
@endsection
