@extends('layouts.app')

@section('content')
<div class="card">
    <h3 class="card-header bg-info">Look at all these books</h3>

    <div class="card-body">

        @include('inc.status')

        <p class="card-text">
            Your seach for
            <span class="font-weight-bold font-italic">{{ $field }}s</span>
            matching
            <span class="font-weight-bold font-italic">{{ $term }}</span>
            yielded {{ number_format($books->num_found) }} books!
        </p>

        @if ($books->num_found > count($books->docs))
            {{-- lot's of books in this search --}}
            <div class="row">
                <div class="col text-left">
                    @if ($books->start > 0)
                        <form action="{{ route('search.do') }}" method="POST">
                            @csrf
                            <input name="page" type="hidden" value="{{ $page - 1 }}" />
                            <input name="field" type="hidden" value="{{ $field }}" />
                            <input name="term" type="hidden" value="{{ $term }}" />

                            <button class="btn btn-link" type="submit">
                                &lt;&lt; prev
                            </button>
                        </form>
                    @endif        
                </div>
                <div class="col text-center">
                    Page {{ $page }} of {{ $num_pages }}
                </div>
                <div class="col text-right">
                    @if ($books->start + count($books->docs) < $books->num_found)
                        <form action="{{ route('search.do') }}" method="POST">
                            @csrf
                            <input name="page" type="hidden" value="{{ $page + 1 }}" />
                            <input name="field" type="hidden" value="{{ $field }}" />
                            <input name="term" type="hidden" value="{{ $term }}" />

                            <button class="btn btn-link" type="submit">
                                next &gt;&gt;
                            </button>
                        </form>
                    @endif        
                </div>
            </div>
        @endif

        <ul class="list-group">
            @foreach ($books->docs as $book)
                @php
                    // we need to find all the isbn's that are 13 chars long
                    $isbnList = '';
                    if (isset($book->isbn)) {
                        foreach ($book->isbn as $isbn) {
                            $isbn = preg_replace("/[^0-9]/", "", $isbn);
                            if (strlen($isbn) === 13) {
                                $isbnList .= "$isbn,";
                            }
                        }
                        $isbnList = rtrim($isbnList, ',');
                    }
                @endphp
                @if (!empty($isbnList))
                    <li class="list-group-item">
                        <a href="{{ route('search.isbn', ['isbn' => $isbnList]) }}">
                            @isset($book->title)
                                {{ $book->title }}
                            @endisset
                            @isset($book->author_name)
                                by {{ \implode(', ', $book->author_name) }}
                            @endisset
                            @isset($book->edition_count)
                                <br /> {{ $book->edition_count }} editions
                            @endisset
                        </a>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <div class="card-footer">
    </div>
</div>
@endsection
