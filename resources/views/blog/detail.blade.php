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
                <h3 class="fw-bold">Comments</h3>
                <ol class="mt-4">
                    <li>
                        <div>
                            <h5>Ahamad</h5>
                            <p>Kocak</p>
                        </div>
                    </li>
                    <li>
                        <div>
                            <h5>Rifqi</h5>
                            <p>Kocak gaming</p>
                        </div>
                    </li>
                </ol>
            </div>
        </div>
    </section>
@endsection
