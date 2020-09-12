@extends('layout.master')

@section('data')
<div>
    <h2>Books<h2>
    <ul>
        @foreach($books as $book)
        <li>
            <div>
                <h5>{{$book->name}}</h5>
                <p>{{$book->author}}</p>
                <span>{{$book->published_date}}</span>
                <a href="/books/{{$book->id}}/edit">Edit</a>
                <form action="{{action('BookController@destroy', $book->id)}}" method="post">
                    {{ csrf_field() }}
                    {{method_field('DELETE')}}
                    <input type="submit" value="Delete">
                </form>
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection