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
                    <div id="success-message"></div>
                </div>
            </div>
        </div>
        <div class="card mt-5">
            <div class="card-body">
                <div class="text-center">
                    <h5 class="card-header-font">{{ __('View information about shortened URL') }}</h5>
                    <hr>
                </div>
                <div>
                    <form id="url-info-form" action="{{ route('get_shorten_url_info') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="input-group">
                            <input type="text" name="url" class="form-control" placeholder="{{ __('Paste shortened URL') }}" aria-label="{{ __('Paste shortened URL') }}" required>
                            <div class="input-group-append">
                                <button class="btn btn-outline-info" type="submit">{{ __('View') }}</button>
                            </div>
                        </div>
                    </form>
                    <div id="info-message"></div>
                </div>
            </div>
        </div>
    </div>
@stop

@push('scripts')
    <script>
        const urlShortenForm = $('#url-shorten-form');
        const urlInfoForm = $('#url-info-form');

        urlShortenForm.on('submit',function(event){
            event.preventDefault();
            $.ajax({
                url: urlShortenForm.attr('action'),
                type:"POST",
                data: urlShortenForm.serialize(),
                success:function(response) {
                    $('#success-message').html(response.html);
                },
                error: function(response) {
                    alert(response.responseJSON.errors.url)
                },
                beforeSend: function() {
                    $('#success-message').html('');
                    $("#url-shorten-form input").attr("disabled", "disabled");
                },
                complete: function() {
                    $("#url-shorten-form").trigger('reset');
                    $("#url-shorten-form input").removeAttr("disabled");
                }
            });
        });

        urlInfoForm.on('submit',function(event){
            event.preventDefault();
            $.ajax({
                url: urlInfoForm.attr('action'),
                type:"POST",
                data: urlInfoForm.serialize(),
                success:function(response) {
                    if (response.text) {
                        alert(response.text);
                    }
                    $('#info-message').html(response.html);
                },
                error: function(response) {
                    alert(response.responseJSON.errors.url)
                },
                beforeSend: function() {
                    $('#info-message').html('');
                    $("#url-info-form input").attr("disabled", "disabled");
                },
                complete: function() {
                    $("#url-info-form").trigger('reset');
                    $("#url-info-form input").removeAttr("disabled");
                }
            });
        });
    </script>
@endpush
