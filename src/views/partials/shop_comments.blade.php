@if (count($shop->reviews))
    <ul class="comment-list mt-30">
        @foreach($shop->reviews as $review)
            <li>
                <div class="comment-user">
                    <img src="{{ $review->user->avatar ?: asset('images/comment-user.jpg') }}" alt="ani">
                </div>
                <div class="comment-detail">
                    <div class="user-name">
                        {{ $review->user->first_name }}
                    </div>
                    <div class="post-info">
                        <ul>
                            <li>{{ $review->created_at }}</li>
                        </ul>
                    </div>
                    <p>{{ $review->text }}</p>
                    <small><a class="text-danger" href="{{ route('complain', $review->id) }}">{{ __('texts.comment_complain') }}</a></small> |
                    <small><a class="text-danger" href="{{ route('shop', $shop->slug) }}">{{ __('texts.comment_answer') }}</a></small>
                </div>
            </li>
        @endforeach
    </ul>
@else
    <p>
        {{ __('texts.no_comments') }}
    </p>
@endif