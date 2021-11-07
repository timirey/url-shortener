<div class="alert alert-info mt-3">
    {{ __('Details about link: ') }}
    <strong>
        {{ $shortenedUrl->getShortenedUrl() }}
    </strong>
    <table class="table table-sm mt-4">
        <tr>
            <td>{{ __('Original URL') }}</td>
            <td>{{ $shortenedUrl->url }}</td>
        </tr>
        <tr>
            <td>{{ __('Created') }}</td>
            <td>{{ $shortenedUrl->created_at->diffForHumans() }}</td>
        </tr>
        <tr>
            <td>{{ __('Redirects') }}</td>
            <td>{{ $shortenedUrl->redirects->count() }} {{ __('time(s)') }}</td>
        </tr>
        <tr>
            <td>{{ __('Last redirect') }}</td>
            <td>{{ optional(optional($shortenedUrl->redirects->last())->created_at)->diffForHumans() }}</td>
        </tr>
    </table>
</div>
