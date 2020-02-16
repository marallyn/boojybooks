@extends('layouts.app')

@section('content')
<div class="col-12">
    <div class="card">
        <h3 class="card-header bg-info">
            Your awesome book list
        </h3>

        <div class="card-body">

            @include('inc.status')

            @if (count($books) === 0)
                <p class="card-text">
                    ... is empty.
                </p>
            @else
                <p class="card-text">
                    Click a book for more details.
                </p>

                <table
                    class="table table-striped table-bordered"
                    cellspacing="0"
                    id="listTable"
                    width="100%"
                >
                    <thead>
                        <tr>
                            <th>Rank</th>
                            <th>Cover</th>
                            <th>ISBN</th>
                            <th>Title</th>
                            <th>Author</th>
                            <th>Pages</th>
                            <th>&nbsp;</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($books as $book)
                            <tr>
                                <td>
                                    <div class="row text-center">
                                        <div class="col">
                                            <a
                                                class="p-3"
                                                href="{{ route('list.move.up', $book->id) }}"
                                            >&utrif;</a>
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col p-3">
                                            {{ $book->rank }}
                                        </div>
                                    </div>
                                    <div class="row text-center">
                                        <div class="col">
                                            <a
                                                class="p-3"
                                                href="{{ route('list.move.down', $book->id) }}"
                                            >&dtrif;</a>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @if ($book->cover)
                                        <a class="btn-link" href="{{ route('book.show', $book->id) }}">
                                            <img src="{{ $book->cover }}" alt="" />
                                        </a>
                                    @endif
                                </td>
                                <td>
                                    <a class="btn-link" href="{{ route('book.show', $book->id) }}">
                                        {{ $book->isbn }}
                                    </a>
                                </td>
                                <td>
                                    <a class="btn-link" href="{{ route('book.show', $book->id) }}">
                                        {{ $book->title }}
                                    </a>
                                </td>
                                <td>{{ $book->author }}</td>
                                <td>{{ $book->pages }}</td>
                                <td>
                                    <form action="{{ route('list.remove') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <input name="id" type="hidden" value="{{ $book->id }}" />
                                        <button class="btn btn-danger" type="submit">
                                            Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @endif
        </div>

        <div class="card-footer">
            <a class="btn btn-primary" href={{ route('search') }}>
                Search for more books
            </a>
        </div>
    </div>
</div>
@endsection
