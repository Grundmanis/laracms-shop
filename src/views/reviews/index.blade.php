@extends('laracms.dashboard::layouts.app', ['page' => 'Reviews'])

@section('content')

    @include('laracms.dashboard::partials.search')

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Comment</th>
                    <th>User</th>
                    <th>Model</th>
                    <th>Created at</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($reviews as $review)
                @continue(!$review->reviewable)
                <tr>
                    <td>{{ $review->id }}</td>
                    <td>{{ $review->text }}</td>
                    <td>
                        <a href="{{ route('laracms.sellers.edit', $review->user_id) }}">
                            {{ $review->user->fullName }}
                        </a>
                    </td>
                    <td>
                        @if ($review->reviewable->shop_id)
                            <a target="_blank" href="{{ route('product.show', [
                                $review->reviewable->shop->slug,
                                $review->reviewable->id,
                                $review->reviewable->name
                            ]) }}">
                                Product: {{ $review->reviewable->name }}
                            </a>
                        @else
                            <a target="_blank" href="{{ route('shop', $review->reviewable->slug) }}">
                                Shop: {{ $review->reviewable->name }}
                            </a>
                        @endif
                    </td>
                    <td>{{ $review->created_at }}</td>
                    <td>
                        <a href="{{ route('laracms.reviews.edit', $review->id) }}">Edit</a>
                        |
                        <a onclick="return confirm('Are you sure?')"
                           href="{{ route('laracms.reviews.destroy', $review->id) }}">Delete</a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $reviews->links() }}
    </div>
@endsection
