@extends('layouts.app')
@section('title', 'List Blog')
@section('content')
    <section>
        <div class="mt-4">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" id="flash-msg" role="alert">
                    <p>{!! session('success') !!}</p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="d-flex justify-content-between">
                <h3>List Blog</h3>
                <a href="{{ route('blog.tambah') }}" class="btn btn-info">Tambah Data</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <th>No</th>
                    <th>Title</th>
                    <th>Tags</th>
                    <th>Image</th>
                    <th>Rating</th>
                    <th>Kategori</th>
                    <th>Description</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($blogs as $b)
                        <tr>
                            <td>{{ $blogs->firstItem() + $loop->index }}</td>
                            {{-- <td>{{ $loop->index + 1 }}</td> --}}
                            <td>{{ $b->title }}</td>
                            <td>
                                @foreach ($b->tags as $tag)
                                    {{ $tag->name }} {{ $loop->last ? '.' : ', ' }}
                                @endforeach
                            </td>
                            <td>{{ $b->image ? $b->image->url : '' }}</td>
                            <td>
                                {{ $b->rating->pluck('rating_value')->avg() }}
                            </td>
                            <td>
                                @foreach ($b->categories as $c)
                                    {{ $c->count() < 1 ? 'kosong' : $c->name }}{{ $loop->last ? '' : ',' }}
                                @endforeach
                            </td>
                            <td>{{ $b->description }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('blog.destroy', $b->id) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin?')">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('blog.edit', $b->id) }}" class="btn btn-info">Update</a>
                                    <a href="{{ route('blog.show', $b->id) }}" class="btn btn-warning">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{{ $blogs->onEachSide(1)->links() }}</div>
        </div>
    </section>
@endsection
