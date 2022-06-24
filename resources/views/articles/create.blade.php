@extends('layouts.app')
@section('content')
    <div class="container">
        <form action="{{ route('articles.store') }}" method='post' class='p-3 bg-white shadow'>
            @csrf
            <div class="form-group">
                <label for="">Title</label>
                <input type="text" name="title" id="" class="form-control" placeholder=""
                    aria-describedby="helpId">

            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" class="form-control" id="description" cols="30" rows="10"></textarea>

            </div>
            <div class="form-group my-5">

                <button class="btn btn-primary" type="submit">SUBMIT</button>

            </div>
        </form>
    </div>
@endsection
