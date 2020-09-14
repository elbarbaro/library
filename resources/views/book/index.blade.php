@extends('layout.master')

@section('data')
<div class="col s3">
    <form action="{{action('BookController@search', ['page' => $books->currentPage()])}}">
        <h5 class="title">Filters</h5>
        <button class="btn" type="submit">Search</button>
        <ul class="collapsible">
            <li>
                <div class="collapsible-header">Category</div>
                <ul class="collection collapsible-body">
                @foreach($categories as $cat)
                    <li class="collection-item">
                        <label>
                            <input type="checkbox" class="filled-in" name="categoryId[]" value="{{$cat->id}}"/>
                            <span>{{$cat->name}}</span>
                        </label>
                    </li>
                @endforeach
                </ul>
            </li>
            <li>
                <div class="collapsible-header">Authors</div>
                <ul class="collection collapsible-body">
                @foreach($authors as $author)
                    <li class="collection-item">
                        <label>
                            <input type="checkbox" class="filled-in" name="author[]" value="{{$author}}"/>
                            <span>{{$author}}</span>
                        </label>
                    </li>
                @endforeach
                </ul>
            </li>
        </ul>
    </form>
</div>
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
                        <span class="new badge left" style="margin-left:0" data-badge-caption="{{$book->category->name}}"></span>
                    </div>
                    <div class="col s3 right-align">
                        <a class="btn-flat" href="/books/{{$book->id}}/edit"><i class="material-icons">edit</i></a>
                        <form style="display: inline-block" action="{{action('BookController@destroy', $book->id)}}" method="post">
                            {{ csrf_field() }}
                            {{method_field('DELETE')}}
                            <button class="btn-flat" type="submit"><i class="material-icons">delete</i></button>
                        </form>
                        <div class="input-field">
                            <span class="bagde">{{$book->status?'Available':'Not available'}}</span>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    {{ $books->links() }}
    </div>
</div>
@endsection
@push('scripts')
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', function() {
        var elems = document.querySelectorAll('.collapsible');
        var instances = M.Collapsible.init(elems, { accordion: false });
    });
</script>
@endpush