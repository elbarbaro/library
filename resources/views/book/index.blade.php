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
            </div>
        </li>
        @endforeach
    </ul>
</div>
@endsection