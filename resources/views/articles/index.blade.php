@extends('layouts.app')
@section('content')
    @foreach ($articles as $article)
        <div class="card my-2 mx-5">
            <img class="card-img-top" src="{{ asset('storage/uploads/' . $article->image_path) }}" alt="hehe">
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
            <a class="nav-link" href=""
                onclick="event.preventDefault();
            document.getElementById('delete-form-{{ $article->id }}').submit();">
                {{ __('Delete') }}
            </a>

            <form id="delete-form-{{ $article->id }}" action="/articles/{{ $article->id }}" method="post"
                class="d-none">
                @csrf
                @method('DELETE')

            </form>
        </div>
    @endforeach
    {{ $articles->links('pagination::bootstrap-4') }}
@endsection
