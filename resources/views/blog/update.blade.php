@extends('layouts.app')
@section('title', 'Tambah Blog')
@section('content')
    <section class="container">
        <div class="my-4">
            <h4 class="text-center mb-3">Tambah Data Blog</h4>
            <div class="row shadow p-3 mb-5 rounded-3 w-50 mx-auto">
                <form action="{{ route('blog.update', $blog->id) }}" method="POST">
                    @method('PUT')
                    @csrf
                    <div class="col p-3">
                        <div class="mb-3">
                            <label for="inputTitle" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" id="inputTitle"
                                placeholder="Input Title Here!" value="{{ $blog->title }}">
                        </div>
                        <div class="mb-3">
                            <label for="inputDescription" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="inputDescription" rows="5"
                                placeholder="Input Description Here!">{{ $blog->description }}</textarea>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
