@extends('layout.master')

@section('data')
    <div class="col s12">
        <a href="{{url()->previous()}}">Back</a>
        <div class="container">
            <h4>New book</h4>
            @if($errors->any())
            <span class="toast amber" style="top: 0">
                @foreach ($errors->all() as $error)
                    {{ $error }} <br>
                @endforeach
            </span>
            @endif
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
                    <input type="text" name="pname" value="{{$book->name}}" required>
                    @else
                    <input type="text" name="pname" required>
                    @endif
                </div>
                <div class="input-field">
                    <label for="name">Author</label>
                    @if(isset($book))
                    <input id="name" type="text" name="pauthor" value="{{$book->author}}" required>
                    @else
                    <input id="name" type="text" name="pauthor" required>
                    @endif
                </div>
                <div class="input-field">
                    <select id="category" name="pcategoryId" required>
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
                <div class="input-field">
                    <label for="publishedDate">Published Date</label>
                    @if(isset($book))
                    <input id="publishedDate" type="number" name="ppublishedDate" value="{{$book->published_date}}" required>
                    @else
                    <input id="publishedDate" type="number" name="ppublishedDate" placeholder="1994" required>
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