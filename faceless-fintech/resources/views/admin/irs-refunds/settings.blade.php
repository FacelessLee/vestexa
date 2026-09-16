@extends('layouts.app')
@section('content')
    @include('admin.topmenu')
    @include('admin.sidebar')
    <div class="main-panel">
        <div class="content">
            <div class="page-inner">
                <div class="mt-2 mb-4">
                    <h1 class="title1 text-center">IRS Refund Settings</h1>
                </div>
                
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                <div class="mb-5 row">
                    <div class="col-md-12">
                        <div class="card p-3 shadow">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h4 class="card-title">Refund Settings</h4>
                                    <a href="{{ route('admin.irs-refunds.index') }}" class="btn btn-primary btn-sm">
                                        <i class="fa fa-arrow-left"></i> Back to Refunds
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.irs-refunds.settings.update') }}" method="POST">
                                    @csrf
                                    
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Minimum Refund Amount ($)</label>
                                                <input type="number" name="min_amount" class="form-control" value="{{ old('min_amount', $irssettings->min_amount ?? 0) }}" step="0.01" required>
                                                @error('min_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Maximum Refund Amount ($)</label>
                                                <input type="number" name="max_amount" class="form-control" value="{{ old('max_amount', $irssettings->max_amount ?? 10000) }}" step="0.01" required>
                                                @error('max_amount')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Processing Fee (%)</label>
                                                <input type="number" name="processing_fee" class="form-control" value="{{ old('processing_fee', $irssettings->processing_fee ?? 0) }}" step="0.01" required>
                                                @error('processing_fee')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Processing Time (Days)</label>
                                                <input type="number" name="processing_time" class="form-control" value="{{ old('processing_time', $irssettings->processing_time ?? 5) }}" required>
                                                @error('processing_time')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Refund Instructions</label>
                                                <textarea name="instructions" class="form-control" rows="4" required>{{ old('instructions', $irssettings->instructions ?? '') }}</textarea>
                                                @error('instructions')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="enable_refunds" name="enable_refunds" {{ old('enable_refunds', $irssettings->enable_refunds ?? true) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="enable_refunds">Enable IRS Refund Service</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <div class="custom-control custom-switch">
                                                    <input type="checkbox" class="custom-control-input" id="require_verification" name="require_verification" {{ old('require_verification', $irssettings->require_verification ?? true) ? 'checked' : '' }}>
                                                    <label class="custom-control-label" for="require_verification">Require Filing ID Verification</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row mt-4">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-primary">
                                                <i class="fa fa-save"></i> Save Settings
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 