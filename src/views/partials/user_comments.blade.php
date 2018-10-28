@if (count($user->reviews))
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th>{{ __('texts.review') }}</th>
                    <th>{{ __('texts.date') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($user->reviews as $review)
                    <tr>
                        <td>
                            {{ $review->text }}
                        </td>
                        <td>
                            {{ $review->created_at }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p>
        {{ __('texts.no_comments') }}
    </p>
@endif