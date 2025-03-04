@extends('layouts.app')

@section('title', 'Detail Blog')

@section('content')
    <section class="my-5">
        <div class="row">
            <div class="col-6">
                <h3 class="fw-bold">Post Blog</h3>
                <div class="card shadow mt-4" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{ $blog->title }}</h5>
                        <hr>
                        {{-- <h6 class="card-subtitle mb-2 text-body-secondary">Card subtitle</h6> --}}
                        <p class="card-text">{{ $blog->description }}</p>
                    </div>
                </div>
            </div>
            <div class="col-6">
                @if ($errors->any())
                    <div class="alert alert-danger" id="flas-msg">
                        <ul>
                            @foreach ($errors->all() as $e)
                                <li>{{ $e }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- success --}}
                @if (session('message'))
                    <div class="alert alert-success" id="flash-msg">
                        <p>{{ session('message') }}</p>
                    </div>
                @endif
                <form action="{{ url('comment/' . $blog->id) }}" method="POST" class="mb-5">
                    @method('POST')
                    @csrf
                    <label for="commentInput" class="form-label fw-medium">Comment</label>
                    <textarea name="comment" class="form-control" id="commentInput" cols="50" rows="5"
                        placeholder="input comment here!"></textarea>
                    <button class="btn btn-info my-3" type="submit">Save</button>
                </form>
                <h3 class="fw-bold">Comments:</h3>
                <ol class="mt-4">
                    @foreach ($blog->comments as $b)
                        <li>
                            <div>
                                <h5>{{ $b->comment_text }}</h5>
                            </div>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>
    </section>
@endsection
