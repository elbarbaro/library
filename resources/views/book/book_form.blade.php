<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New book</title>
</head>
<body>
    <h2>New book</h2>
    @if(isset($book))
    <form action="{{action('BookController@update', $book->id)}}" method="post">
    @else
    <form action="{{action('BookController@store')}}" method="post">
    @endif
        {{ csrf_field() }}
        @isset($book)
        {{method_field('PUT')}}
        @endisset
        <div>
            <label for="name">Name</label>
            @if(isset($book))
            <input type="text" name="pname" value="{{$book->name}}">
            @else
            <input type="text" name="pname">
            @endif
        </div>
        <div>
            <label for="name">Author</label>
            @if(isset($book))
            <input id="name" type="text" name="pauthor" value="{{$book->author}}">
            @else
            <input id="name" type="text" name="pauthor">
            @endif
        </div>
        <div>
            <label for="category">Category</label>
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
        <input type="submit" value="Save">
        @else
        <input type="submit" value="Create">
        @endif
    </form>
</body>
</html>