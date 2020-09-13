@extends('layout.master')

@section('data')
<div class="col s3"></div>
<div class="col s9">
    <div class="content">
        <ul class="collection">
            @foreach($books as $book)
            <li class="collection-item">
                <div class="row">
                    <div class="col s9">
                        <h5 class="title">{{$book->name}}</h5>
                        <p>{{$book->author}} <br>
                            <span>{{$book->published_date}}</span>
                        </p>
                    </div>
                    <div class="col s3 right-align">
                        <a class="btn-flat" href="/books/{{$book->id}}/edit"><i class="material-icons">edit</i></a>
                        <form style="display: inline-block" action="{{action('BookController@destroy', $book->id)}}" method="post">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button class="btn-flat" type="submit"><i class="material-icons">delete</i></button>
                        </form>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    {{ $books->links() }}
    </div>
</div>
@endsection