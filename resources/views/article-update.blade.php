<!DOCTYPE html>

<html>
<head>
<title>Blog</title>
       <!-- Styles -->
        <style>
table, th, td {
  border: 1px solid black;
}
        </style>
</head>
<body>
<h1>Article</h1>

<div>
    <a href="{{ Route('/') }}">Home</a> |
    <a href="{{ Route('/category') }}">Category</a> |
    <a href="{{ Route('/article') }}">Article</a> |
</div>
<hr/>
<h2>Update Article</h2>

<form method="POST" action="{{ Route('postUpdateArticleByID/',['id'=> $selectedArticle->ID]) }}">
  Title:<br>
  <input type="text" name="title" value ="{{ $selectedArticle->Title }}"><br>
  Description:<br>
  <input type="text" name="description" value ="{{ $selectedArticle->Description }}"><br>
  Category:<br>
  @foreach($getCategory as $getCategorys)
  <input type="checkbox" name={{ 'addcategory-'.$getCategorys->ID }} {{ $getCategorys['checked'] }} id={{ 'addcategory-'.$getCategorys->ID }}> {{ $getCategorys->Category }}<br>
  @endforeach
  Author:<br>
  <input type="text" name="author" value ="{{ $selectedArticle->Author }}"> <br>
  
  <input type="submit" value="Submit">
  {{ csrf_field() }}
</form> 

<hr/>

</body>
</html>
