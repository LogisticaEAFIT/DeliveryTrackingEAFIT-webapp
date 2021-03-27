@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('home.index') }}">Home</a></li>
        <li class="breadcrumb-item active">Companies list</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card" align="center">
                <div class="card-header">{{ __('company.title_list') }}</div>

                <table class="table table-striped">
                    <thead  align="center">
                        <tr>
                            <th scope="col">{{ __('company.label.id') }}</th>
                            <th scope="col">{{ __('company.label.name') }}</th>
                            <th scope="col">{{ __('company.label.contact_info') }}</th>
                            <th scope="col">{{ __('company.label.about') }} <i class="fa fa-info-circle"></i></th>
                        </tr>
                    </thead>
                    <tbody  align="center">
                        @foreach($data["companies"] as $company)
                        <tr>
                            <td>{{ $company->getId() }}</td>
                            <td>{{ $company->getName() }}</td>
                            <td>{{ $company->getContactInfo() }}</td>
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
