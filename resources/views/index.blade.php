@extends('master')

@section('content')
  @if ($products)
    @foreach ($products as $product)
      <div class="row">
        <div class="col-md-4">
            <img src="{{ $product->photo }}">
        </div>
        <div class="col-md-8">
          <h2>{{ $product->title }}</h2>
          <p>{{ $product->description }}</p>
          <p><a class="btn btn-default" href="/product/{{ $product->id }}" role="button">View details &raquo;</a></p>
        </div>
      </div>
    @endforeach
  @endif
@endsection