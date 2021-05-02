@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
        <div class="align-right">
                <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('user.red_info') }}</span>
            </div><br/>
            <div class="card center-info">
                <div class="card-header">{{ __('company.title_list') }}</div>

                <table class="table table-striped">
                    <thead class="center-info">
                        <tr>
                            <th scope="col">{{ __('company.label.id') }}</th>
                            <th scope="col">{{ __('company.label.name') }}</th>
                            <th scope="col">{{ __('company.label.contact_info') }}</th>
                            <th scope="col">{{ __('company.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody class="center-info">
                        @foreach($data["companies"] as $company)
                        <tr>
                            @if($company->getIsActive() == '0')
                            <td class="red-option">{{ $company->getId() }}</td>
                            <td class="red-option">{{ $company->getName() }}</td>
                            <td class="red-option">{{ $company->getContactInfo() }}</td>
                            @else
                            <td>{{ $company->getId() }}</td>
                            <td>{{ $company->getName() }}</td>
                            <td>{{ $company->getContactInfo() }}</td>
                            @endif
                            <td><a href="{{ route('company.show', ['id'=>$company->getId()]) }}"> {{ __('company.label.info') }} <strong>{{ $company->getName() }}</strong></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
