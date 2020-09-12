<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New book</title>
</head>
<body>
    <h2>New book</h2>
    <form action="/books" method="post">
        {{ csrf_field() }}
        <div>
            <label for="name">Name</label>
            <input type="text" name="pname">
        </div>
        <div>
            <label for="name">Author</label>
            <input id="name" type="text" name="pauthor">
        </div>
        <div>
            <label for="category">Category</label>
            <select id="category" name="pcategoryId">
                <option selected disabled>Choose a category</option>
                @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="publishedDate">Published Date</label>
            <input id="publishedDate" type="date" name="ppublishedDate">
        </div>
        <input type="submit" value="Create">
    </form>
</body>
</html>