@extends('layout.master')

@section('data')
    <div class="col s12">
        <div class="container">
            <h4>New book</h4>
            @if(isset($book))
            <form action="{{action('BookController@update', $book->id)}}" method="post">
            @else
            <form action="{{action('BookController@store')}}" method="post">
            @endif
                {{ csrf_field() }}
                @isset($book)
                {{method_field('PUT')}}
                @endisset
                <div class="input-field">
                    <label for="name">Name</label>
                    @if(isset($book))
                    <input type="text" name="pname" value="{{$book->name}}">
                    @else
                    <input type="text" name="pname">
                    @endif
                </div>
                <div class="input-field">
                    <label for="name">Author</label>
                    @if(isset($book))
                    <input id="name" type="text" name="pauthor" value="{{$book->author}}">
                    @else
                    <input id="name" type="text" name="pauthor">
                    @endif
                </div>
                <div class="input-field">
                    <select id="category" name="pcategoryId">
                    @if(isset($book))
                        <option selected disabled>Choose a category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}" {{($category->id == $book->category_id)? 'selected': ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    @else
                        <option selected disabled>Choose a category</option>
                        @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                        @endforeach
                    </select>
                    @endif
                    <label for="category">Category</label>
                </div>
                <div>
                    <label for="publishedDate">Published Date</label>
                    @if(isset($book))
                    <input id="publishedDate" type="date" name="ppublishedDate" value="{{$book->published_date}}">
                    @else
                    <input id="publishedDate" type="date" name="ppublishedDate">
                    @endif
                </div>
                @if(isset($book))
                <input class="btn right" type="submit" value="Save">
                @else
                <input class="btn right" type="submit" value="Create">
                @endif
            </form>
        </div>
    </div>
@endsection('data')

@push('scripts')
    <script type="text/javascript">
        document.addEventListener('DOMContentLoaded', function() {
            var elems = document.querySelectorAll('select');
            var instances = M.FormSelect.init(elems);
        });
    </script>
@endpush