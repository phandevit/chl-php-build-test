@extends('master')

@section('title', " - Add a Review")

@section('content')

  <h1>Add a Review</h1>

  @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
  @endif

  <form method="post">
    {{ csrf_field() }}
    <div class="row">
      <div class="form-group col-md-6">
        <label for="product-comments">Comments</label>
        <textarea class="form-control" rows="7" id="product-comments" name="comments">{{ old('comments') }}</textarea>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-2">
        <label for="product-rating">Rating</label>
        <select class="form-control" id="product-rating" name="rating">
          <option>&mdash; Select &mdash;</option>
          <option value="5" @if (old('rating') == 5) selected="selected" @endif>5 - highest</option>
          <option value="4" @if (old('rating') == 4) selected="selected" @endif>4</option>
          <option value="3" @if (old('rating') == 3) selected="selected" @endif>3</option>
          <option value="2" @if (old('rating') == 2) selected="selected" @endif>2</option>
          <option value="1" @if (old('rating') == 1) selected="selected" @endif>1 - lowest</option>
        </select>
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"><button type="submit" class="btn btn-default">Submit</button></div>
    </div>
  </form>
@endsection