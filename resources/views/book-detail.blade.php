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
                        <th>Rank</th>
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
                    @isset ($details->publishers)
                        @php
                            $publishers = '';
                            foreach($details->publishers as $publisher) {
                                $publishers .= $publisher->name . ', ';
                            }
                            $publishers = rtrim($publishers, ', ');
                        @endphp
                        <tr>
                            <th>Publisher</th>
                            <td>{{ $publishers }}</td>
                        </tr>
                    @endisset
                    @isset ($details->subjects)
                        @php
                            $subjects = '';
                            foreach($details->subjects as $subject) {
                                $subjects .= $subject->name . ', ';
                            }
                            $subjects = rtrim($subjects, ', ');
                        @endphp
                        <tr>
                            <th>Subjects</th>
                            <td>{{ $subjects }}</td>
                        </tr>
                    @endisset
                    @isset ($details->subject_places)
                        @php
                            $subject_places = '';
                            foreach($details->subject_places as $subject_place) {
                                $subject_places .= $subject_place->name . ', ';
                            }
                            $subject_places = rtrim($subject_places, ', ');
                        @endphp
                        <tr>
                            <th>Subject places</th>
                            <td>{{ $subject_places }}</td>
                        </tr>
                    @endisset
                    @isset ($details->subject_people)
                        @php
                            $subject_people = '';
                            foreach($details->subject_people as $person) {
                                $subject_people .= $person->name . ', ';
                            }
                            $subject_people = rtrim($subject_people, ', ');
                        @endphp
                        <tr>
                            <th>Subject people</th>
                            <td>{{ $subject_people }}</td>
                        </tr>
                    @endisset
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
