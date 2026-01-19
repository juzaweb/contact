@extends('core::layouts.admin')

@section('content')
    <form action="{{ $action }}" class="form-ajax" method="post">
        @if($model->exists)
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-12">
                <a href="{{ admin_url('contacts') }}" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> {{ __('contact::translation.back') }}
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('contact::translation.information') }}</h3>
                    </div>
                    <div class="card-body">
                        {{ __('contact::translation.name') }}: {{ $model->name }} <br>
                        {{ __('contact::translation.email') }}: {{ $model->email }} <br>

                        {{ __('contact::translation.phone') }}: {{ $model->phone }} <br>
                        {{ __('contact::translation.subject') }}: {{ $model->subject }} <br>
                        {{ __('contact::translation.message') }}: <br>

                        <div style="white-space: pre-line;">{{ $model->message }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">

                {{ Field::select($model, 'status')->dropDownList(\Juzaweb\Modules\Contact\Enums\ContactStatus::toArray()) }}

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('contact::translation.save') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript" nonce="{{ csp_script_nonce() }}">
        $(function () {

        });
    </script>
@endsection
