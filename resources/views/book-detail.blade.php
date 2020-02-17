@extends('layouts.app')

@section('content')
<div class="col-12 col-md-8 col-lg-6">
    <div class="card">
        @if ($book->cover)
            <img src="{{ $book->cover }}" class="card-img-top" alt="{{ $book->title }}">
        @endif

        <div class="card-body">
            <h3 class="card-title bg-info p-2 mb-0">
                {{ $book->title }}
            </h3>
            @isset($details->subtitle)
                <h5 class="card-title bg-info px-2 pb-2 pt-0 mt-0">
                    {{ $details->subtitle }}
                </h5>
            @endisset

            <table class="table">
                <tbody>
                    <tr>
                        <th>My rank</th>
                        <td>
                            {{ $book->listDetails->rank }}
                        </td>
                    </tr>
                    <tr>
                        <th>ISBN</th>
                        <td>{{ $book->isbn }}</td>
                    </tr>
                    <tr>
                        <th>Author</th>
                        <td>{{ $book->author }}</td>
                    </tr>
                    @if ($book->pages > 0)
                        <tr>
                            <th>Pages</th>
                            <td>{{ $book->pages }}</td>
                        </tr>
                    @endif
                    @include('inc.detail-array', ['field' => 'publishers', 'label' => 'Publishers'])
                    @include('inc.detail-array', ['field' => 'subjects', 'label' => 'Subjects'])
                    @include(
                        'inc.detail-array',
                        ['field' => 'subject_places', 'label' => 'Subject places']
                    )
                    @include(
                        'inc.detail-array',
                        ['field' => 'subject_people', 'label' => 'Subject people']
                    )
                    @isset ($details->weight)
                        <tr>
                            <th>Weight</th>
                            <td>{{ $details->weight }}</td>
                        </tr>
                    @endisset
                    @isset ($details->publish_date)
                        <tr>
                            <th>Publish date</th>
                            <td>{{ $details->publish_date }}</td>
                        </tr>
                    @endisset
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
