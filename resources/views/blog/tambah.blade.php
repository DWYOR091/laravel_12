@extends('layouts.app')
@section('title', 'Tambah Blog')
@section('content')
    <section class="container">
        <div class="my-4">
            <h4 class="text-center mb-3">Tambah Data Blog</h4>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $err)
                            {{ $err }}
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row shadow p-3 mb-5 rounded-3 w-50 mx-auto">
                <form action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="col p-3">
                        <div class="mb-3">
                            <label for="inputTitle" class="form-label">Title</label>
                            <input name="title" type="text" class="form-control" id="inputTitle"
                                placeholder="Input Title Here!" value="{{ old('title') }}">
                        </div>
                        <div class="mb-3">
                            <label for="inputDescription" class="form-label">Description</label>
                            <textarea name="description" class="form-control" id="inputDescription" rows="5"
                                placeholder="Input Description Here!">{{ old('description') }}</textarea>
                        </div>
                        <label for="" class="form-label">Tags</label>
                        @foreach ($tags as $key => $tag)
                            <div class="form-check">
                                <input class="form-check-input" name="tags[]" type="checkbox" value="{{ $tag->id }}"
                                    id="tags{{ $key }}"
                                    {{ is_array(old('tags')) && in_array($tag->id, old('tags')) ? 'checked' : '' }}>
                                <label class="form-check-label" for="tags{{ $key }}">
                                    {{ $tag->name }}
                                </label>
                            </div>
                        @endforeach
                        <div class="mt-3">
                            <label for="inputImage" class="form-label">Image</label>
                            <input type="file" class="form-control" name="image" id="inputImage">
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
