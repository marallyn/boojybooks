@extends('layouts.app')

@section('content')
<div class="card">
    <h3 class="card-header bg-info">Matching books</h3>

    <div class="card-body">

        @include('inc.status')


        <ul class="list-group">
            @foreach ($books as $book)
                {{-- 
                    the book query does not always return a consistent set of fields, so calculating the important ones in the php block, and the wrapping each reference to the others in an isset
                 --}}
                @php
                    $authors = '';
                    if (isset($book->authors)) {
                        foreach ($book->authors as $author) {
                            $authors .= $author->name . ', ';
                        }
                        $authors = rtrim($authors, ', ');
                    }
                    $cover = isset($book->cover) && isset($book->cover->medium)
                        ? $book->cover->medium
                        : '';
                    $coverHtml = $cover
                        ? "<img src=\"$cover\" class=\"float-left mr-3\">"
                        : '';
                    $pages = isset($book->number_of_pages) ? $book->number_of_pages : 0;
                    $title = isset($book->title) ? $book->title : '';
                @endphp

                <li class="list-group-item"> 
                    <div class="row">
                        <div class="col">
                            {!! $coverHtml !!}
                            {{ $title }}
                            @if(!empty($authors))
                                by {{ $authors }}
                            @endif
                            <br />
                            @isset($book->publishers)
                                @foreach ($book->publishers as $publisher)
                                    {{ $publisher->name}}, 
                                @endforeach
                            @endisset
                            @isset($book->publish_date)
                                {{ $book->publish_date }}, 
                            @endisset
                            {{ $pages }} pages
                        </div>
                        <div class="col-auto">
                            <form
                                action="{{ route('list.add') }}"
                                method="POST"
                            >
                                @csrf
                                <input name="author" type="hidden" value="{{ $authors }}" />
                                <input name="cover" type="hidden" value="{{ $cover }}" />
                                <input
                                    name="isbn"
                                    type="hidden"
                                    value="{{ $book->identifiers->isbn_13[0] }}"
                                />
                                <input name="pages" type="hidden" value="{{ $pages }}" />
                                <input name="title" type="hidden" value="{{ $title }}" />
                                <button
                                    class="btn btn-primary"
                                    type="submit"
                                >
                                    Add to my list
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
    </div>

    <div class="card-footer">
    </div>
</div>
@endsection
