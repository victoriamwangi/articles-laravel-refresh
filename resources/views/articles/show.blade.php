@extends('layouts.app')
@section('content')
    <div class="card my-2 mx-5">
        <img class="card-img-top" src="holder.js/100x180/" alt="">
        <div class="card-body">
            <h4 class="card-title">{{ $article->title }}</h4>
            <p class="card-text">{{ $article->description }}</p>

        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="small">
                {{ $article->author }}
                <br />

                {{ Date('l, jS F Y \a\t h:i a', strtotime($article->created_at)) }}

            </p>
        </div>
    </div>
@endsection
