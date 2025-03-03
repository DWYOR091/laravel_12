@extends('layouts.app')
@section('title', 'List User')
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
                <h3>List User</h3>
                <a href="" class="btn btn-info">Tambah Data</a>
            </div>
            <table class="table table-hover">
                <thead>
                    <th>No</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone Number</th>
                    <th>Action</th>
                </thead>
                <tbody>
                    @foreach ($users as $u)
                        <tr>
                            <td>{{ $users->firstItem() + $loop->index }}</td>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td>{{ $u->phone ? $u->phone->number : '-' }}</td>
                            <td>
                                <div class="d-flex gap-2">
                                    <form action="{{ route('blog.destroy', $u->id) }}" method="POST"
                                        onsubmit="return confirm('Anda yakin?')">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-danger">Delete</button>
                                    </form>
                                    <a href="{{ route('blog.edit', $u->id) }}" class="btn btn-info">Update</a>
                                    <a href="{{ route('blog.show', $u->id) }}" class="btn btn-warning">Detail</a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{{ $users->onEachSide(1)->links() }}</div>
        </div>
    </section>
@endsection
