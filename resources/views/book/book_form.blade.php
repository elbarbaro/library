<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books</title>
</head>
<body>
    <h2>New book</h2>
    <form>
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
                <option selected>Elige la categoria</option>
            </select>
        </div>
        <div>
            <label for="publishedDate">Published Date</label>
            <input id="publishedDate" type="text">
        </div>
        <input type="submit" value="Create">
    </form>
</body>
</html>