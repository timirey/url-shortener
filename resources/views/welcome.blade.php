@extends('layouts.default')
@section('content')
    <div class="container mt-5 col-md-6">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h5 class="card-header-font">{{ __('Generate your shortened URL') }}</h5>
                    <hr>
                </div>
                <div>
                    <form id="url-shorten-form" action="{{ route('generate_shortened_url') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="url" class="form-control" placeholder="{{ __('Paste your url and shorten it') }}" aria-label="{{ __('Paste your url and shorten it') }}" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-primary" type="submit">{{ __('Shorten') }}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
