@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="row padding-bottom-20">
                <div class="col-6">
                    <form method="GET" action="{{ route('vendor.create') }}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('vendor.input.create') }}</button>
                    </form>
                </div>
                <div class="col-6 text-right">
                    <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('vendor.red_info') }}</span>
                </div>
            </div>
            <div class="card center-info">
                <div class="card-header">{{ __('vendor.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('vendor.label.id') }}</th>
                            <th scope="col">{{ __('vendor.label.name') }}</th>
                            <th scope="col">{{ __('vendor.label.contact_info') }}</th>
                            <th scope="col">{{ __('vendor.label.company_id') }}</th>
                            <th scope="col">{{ __('vendor.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["vendors"] as $vendor)
                        <tr>
                            @if($vendor->getIsActive() == '0')
                            <td class="red-option">{{ $vendor->getId() }}</td>
                            <td class="red-option">{{ $vendor->getName() }}</td>
                            <td class="red-option">{{ $vendor->getContactInfo() }}</td>
                            <td class="red-option"><a href="{{ route('company.show', ['id'=>$vendor->getCompanyId()]) }}"><strong>{{ $vendor->getCompanyId() }} - {{ $vendor->company->getName() }}</strong></a></td>
                            @else
                            <td>{{ $vendor->getId() }}</td>
                            <td>{{ $vendor->getName() }}</td>
                            <td>{{ $vendor->getContactInfo() }}</td>
                            <td><a href="{{ route('company.show', ['id'=>$vendor->getCompanyId()]) }}"><strong>{{ $vendor->getCompanyId() }} - {{ $vendor->company->getName() }}</strong></a></td>
                            @endif
                            <td><a href="{{ route('vendor.show', ['id'=>$vendor->getId()]) }}"> {{ __('vendor.label.info') }} <strong>{{ $vendor->getId() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div><br/>
            <nav class="center-info" aria-label="Page navigation example">
                {{$data["vendors"]->links()}}
            </nav>
        </div>
    </div>
</div>
@endsection
