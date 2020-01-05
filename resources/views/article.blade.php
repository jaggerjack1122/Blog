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
<h2>Add Article</h2>

<form method="POST" action="{{ Route('/addArticle') }}">
  Title:<br>
  <input type="text" name="title"><br>
  Description:<br>
  <input type="text" name="description"><br>
  Category:<br>
  @foreach($getCategory as $getCategorys)
  <input type="checkbox" name={{ 'addcategory-'.$getCategorys->ID }} id={{ 'addcategory-'.$getCategorys->ID }}> {{ $getCategorys->Category }}<br>
  @endforeach
  Author:<br>
  <input type="text" name="author"> <br>
  
  <input type="submit" value="Submit">
  {{ csrf_field() }}
</form> 


<hr/>
<table>
  <tr>
    <th>ID</th>
    <th>Title</th>
    <th>Description</th>
    <th>Category</th>
    <th>Author</th>
    <th>Date</th>	
	<th>Action</th>
  </tr>
  
@foreach($getArticle as $getArticles)
  <tr>
    <td>{{$getArticles->ID}}</td>
    <td>{{$getArticles->Title}}</td>
    <td>{{$getArticles->Description}}</td>
    <td>
	@foreach($getArticleCategory as $getArticleCategorys)
		@if($getArticles->ID == $getArticleCategorys->ArticleID)
			[{{ $getArticleCategorys->Category }}]
		@endif
	@endforeach
	</td>
    <td>{{$getArticles->Author}}</td>
    <td>{{$getArticles->Date}}</td>	
	<td>
	<a href="{{ Route('deleteArticleByID/',['id'=> $getArticles->ID]) }}" onclick="return confirmDelete();">Delete</a>
	<a href="{{ Route('getUpdateArticleByID/',['id'=> $getArticles->ID]) }}">Update</a>
	</td>
  </tr>
@endforeach
</table>

</body>

<script>
function confirmDelete(){
	var result = confirm('Are you sure you want to delete?');
	if(result) {
		return true;
	} else {
		return false;
	}
}
</script>
</html>
