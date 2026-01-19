@extends('core::layouts.admin')

@section('content')
    <div class="row mt-3">
        <div class="col-md-12">
            {{--@component('components.datatables.filters')
                <div class="col-md-3 jw-datatable_filters">

                </div>
            @endcomponent--}}
        </div>

        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ __('contact::translation.contacts') }}</h3>
                </div>
                <div class="card-body">
                    {{ $dataTable->table() }}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    {{ $dataTable->scripts(null, ['nonce' => csp_script_nonce()]) }}
@endsection
