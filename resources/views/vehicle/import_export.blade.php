@extends('layouts.app')

@section('content')
<div class="container-fluid padding-20">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('vehicle.title_import_export') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vehicle.import_file') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group row">
                            <label class="col-md-4 col-form-label text-md-right" for="customFile">{{ __('vehicle.label.browse_file') }}</label>
                            <div class="col-md-6">
                                <input type="file" name="file" class="form-control @error('name') is-invalid @enderror" id="customFile">
                                @error('file')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-3"></div>
                            <div class="col-3">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-upload"></i> {{ __('vehicle.input.click_import') }}
                                </button>
                            </div>
                            <div class="col-3">
                                <a class="btn btn-primary" href="{{ route('vehicle.export_file') }}"><i class="fa fa-download"></i> {{ __('vehicle.input.click_export') }}</a>
                            </div>
                        </div><br/>
                        <div class="form-group row mb-0">
                            <div class="col-4"></div>
                            <div class="col-4">
                                <a class="btn btn-link" href="{{ route('vehicle.download_format') }}"><i class="fa fa-download"></i> {{ __('vehicle.input.click_format') }}</a>
                            </div>
                        </div><br/>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
