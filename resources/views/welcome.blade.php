<!DOCTYPE html>

<html>
<head>
<title>Blog</title>
</head>
<body>
<h1>Blog Content</h1>

<div>
    <a href="{{ Route('/') }}">Home</a> |
    <a href="{{ Route('/category') }}">Category</a> |
    <a href="{{ Route('/article') }}">Article</a> |
</div>
<hr/>
<form method="POST" action="{{ Route('/') }}">
Sort Date: 
<select name="sorting" id="sorting">
  <option value="asc" {{ $sort == 'asc' ? 'selected' : ''}}>Ascending Order</option>
  <option value="desc" {{ $sort == 'desc' ? 'selected' : ''}}>Descending Order</option>
</select>
  <input type="submit" value="Submit">
  {{ csrf_field() }}
</form>
<hr/>

<div class="row">
@foreach($getArticle as $getArticles)
  <div class="leftcolumn">
    <div class="card">
      <h2>Title: {{ $getArticles->Title }}</h2>
      <h3>By:{{ $getArticles->Author }}, {{ $getArticles->Date }}</h5>
      <p>{{ $getArticles->Description }}</p>
    </div>
  </div>
  <hr/>
@endforeach
</div>
{{ $getArticle->links() }}

</body>

</html>
