@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="/articles/{{ $article->id }}" method='post' class='p-3 bg-white shadow'>
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $article->id }}">
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" id="" class="form-control" placeholder=""
                    value="{{ $article->title }}" required aria-describedby="helpId">

            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" id="description" name='description' cols="30" rows="10">{{ $article->description }}</textarea>

            </div>
            <div class="form-group my-5">

                <button class="btn btn-primary" type="submit">SUBMIT</button>

            </div>
        </form>
    </div>
@endsection
