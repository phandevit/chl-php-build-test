@extends('master')

@section('title', " - Add a Product")

@section('content')

  <h1>Add a Product</h1>

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
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" />
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="description">Description</label>
        <textarea class="form-control" rows="7" id="description" name="description">{{ old('description') }}</textarea>
      </div>
    </div>
    <div class="row">
      <div class="form-group col-md-6">
        <label for="photo">Photo URL</label>
        <input type="text" class="form-control" id="photo" name="photo" value="http://placehold.it/350x150" />
      </div>
    </div>
    <div class="row">
      <div class="col-md-12"><button type="submit" class="btn btn-default">Submit</button></div>
    </div>
  </form>
@endsection