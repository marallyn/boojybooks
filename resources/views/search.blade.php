@extends('layouts.app')

@section('content')
<div class="col-12 col-md-8 col-lg-6">
    <div class="card">
        <h3 class="card-header bg-info">Find some books</h3>

        <form
            action="{{ route('search.do') }}"
            class="needs-validation"
            method="POST"
        >
            @csrf
            <input name="page" type="hidden" value="1" />
            
            <div class="card-body">

                @include('inc.status')

                <div class="form-group input-group">
                    <label class="form-inline" for="name">Search term:</label>
                    <input
                        autofocus
                        class="form-control ml-3"
                        name="term"
                        required
                        type="text"
                        value="{{ old('term', '') }}"
                    />
                    <select class="custom-select" name="field">
                        <option value="">-- search by --</option>
                        <option value="subject">Subject</option>
                        <option value="title">Title</option>
                        <option value="author">Author</option>
                    </select>
                </div>
            </div>

            <div class="card-footer">
                <button class="btn btn-primary">
                    Find me some books
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
