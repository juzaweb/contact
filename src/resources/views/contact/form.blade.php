@extends('core::layouts.admin')

@section('content')
    <form action="{{ $action }}" class="form-ajax" method="post">
        @if($model->exists)
            @method('PUT')
        @endif

        <div class="row">
            <div class="col-md-12">
                <a href="{{ admin_url('contacts') }}" class="btn btn-warning">
                    <i class="fas fa-arrow-left"></i> {{ __('Back') }}
                </a>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-9">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{ __('Information') }}</h3>
                    </div>
                    <div class="card-body">
                        {{ __('Name') }}: {{ $model->name }} <br>
                        {{ __('Email') }}: {{ $model->email }} <br>

                        {{ __('Phone') }}: {{ $model->phone }} <br>
                        {{ __('Subject') }}: {{ $model->subject }} <br>
                        {{ __('Message') }}: <br>

                        <div style="white-space: pre-line;">{{ $model->message }}</div>
                    </div>
                </div>
            </div>

            <div class="col-md-3">

                {{ Field::select($model, 'status')->dropDownList(\Juzaweb\Modules\Contact\Enums\ContactStatus::toArray()) }}

                <button class="btn btn-primary">
                    <i class="fas fa-save"></i> {{ __('Save') }}
                </button>
            </div>
        </div>
    </form>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(function () {

        });
    </script>
@endsection
