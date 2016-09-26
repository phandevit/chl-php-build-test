@extends('master')

@section('title', " - Products")

@section('content')
  <div class="row">
    <div class="col-md-4">
        <img src="{{ $product->photo }}">
    </div>
    <div class="col-md-8">
      <h2>{{ $product->title }}</h2>
      <p>{{ $product->description }}</p>
      @if ($rating > 0)
        <p>Average Rating: <span class="label label-info">{{ $rating }}</span></p>
      @endif
      <p><a class="btn btn-default" href="/review/add/{{ $product->id }}" role="button">Add a Review</a></p>
    </div>
  </div>
  <h1>Reviews</h1>
  <div class="row">
    @if (count($reviews) > 0)
      @foreach ($reviews as $review)
        <div class="col-md-2">
          <div class="alert alert-info" role="alert">
            Rating: {{ $review->rating }}
          </div>
        </div>
        <div class="col-md-10">
          <div class="alert alert-info" role="alert">
            {{ $review->comments }}
          </div>
        </div>
      @endforeach
    @else
      <div class="col-md-12">
        <div class="alert alert-info" role="alert">
          No reviews yet. <a href="/review/add/{{ $product->id }}">Be the first to review this product.</a>
        </div>
      </div>
    @endif
  </div>

  <hr>

  @if (Auth::check() && count($reviews_pending) > 0)
    <h1>Reviews Pending</h1>
    <div class="row">
      <form method="post">
        {{ csrf_field() }}
        @foreach ($reviews_pending as $review)
          <div class="col-md-1">
            <input role="form-group" type="checkbox" name="reviews[]" value="{{ $review->id }}">
          </div>
          <div class="col-md-2">
            <div class="alert alert-info" role="alert">
              Rating: {{ $review->rating }}
            </div>
          </div>
          <div class="col-md-9">
            <div class="alert alert-info" role="alert">
              {{ $review->comments }}
            </div>
          </div>
        @endforeach
        With checked: <button type="submit" class="btn btn-default">Approve</button>
      </form>
    </div>
  @endif
@endsection