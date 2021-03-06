@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="row padding-bottom-20">
                <div class="col-6">
                    <form method="GET" action="{{ route('company.create') }}">
                        <button type="submit" class="btn btn-success"><i class="fa fa-plus"></i> {{ __('company.input.create') }}</button>
                    </form>
                </div>
                <div class="col-6 text-right">
                    <span class="badge rounded-pill bg-danger font-white pad-10">{{ __('company.red_info') }}</span>
                </div>
            </div>
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
            </div><br/>
            <nav class="center-info" aria-label="Page navigation example">
                {{$data["companies"]->links()}}
            </nav>
        </div>
    </div>
</div>
@endsection
