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
<h1>Category</h1>

<div>
    <a href="{{ Route('/') }}">Home</a> |
    <a href="{{ Route('/category') }}">Category</a> |
    <a href="{{ Route('/article') }}">Article</a> |
</div>
<hr/>
<h2>Add Category</h2>

<form method="POST" action="{{ Route('/addCategory') }}">
  Category:<br>
  <input type="text" name="category">

  <input type="submit" value="Submit">
  {{ csrf_field() }}
</form> 


<hr/>
<table>
  <tr>
    <th>ID</th>
    <th>Category</th>
    <th>Date</th>
	<th>Action</th>
  </tr>
  
@foreach($getCategory as $getCategorys)
  <tr>
    <td>{{$getCategorys->ID}}</td>
    <td>{{$getCategorys->Category}}</td>
    <td>{{$getCategorys->Date}}</td>
	<td>
	<a href="{{ Route('deleteCategoryByID/',['id'=> $getCategorys->ID]) }}" onclick="return confirmDelete();">Delete</a>
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
