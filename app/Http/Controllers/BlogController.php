<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Log; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use App\Model\Category;
use App\Model\Article;
use App\Model\ArticleCategory;



class BlogController extends Controller
{

	public function ShowHome()
	{	
	$data = \Request::all();
	$data['sort'] = '';
	if(isset($data['sorting'])){
		$getArticle = Article::orderBy('Date', $data['sorting'])->paginate(5);	
		$getCategory = Category::get();
		
		$getArticleCategory = DB::table('article_category as a') 
			->select('a.ID','a.ArticleID','a.CategoryID','b.Category')
			->leftjoin('category as b','a.CategoryID','=','b.ID')
			->get();
		$data['sort'] =	$data['sorting'];		
	}else{
		$getArticle = Article::paginate(5);	
		$getCategory = Category::get();
		
		$getArticleCategory = DB::table('article_category as a') 
			->select('a.ID','a.ArticleID','a.CategoryID','b.Category')
			->leftjoin('category as b','a.CategoryID','=','b.ID')
			->get();			
	}
		$data['getArticle'] = $getArticle;			
		$data['getCategory'] = $getCategory;
		$data['getArticleCategory'] = $getArticleCategory;
		return view('welcome',$data);
	}	
	
	public function ShowCategory()
	{	
		$getCategory = Category::get();
			
		$data['getCategory'] = $getCategory;
		
		return view('category',$data);
	}

	public function AddCategory()
	{	
		$data = \Request::all();
		$category = $data['category'];
		
		$addCategory = new Category();
		$addCategory->Category = $category;
		$addCategory->save();

		return redirect()->route('/category');
	}

	public function deleteCategoryByID($id)
	{
		$Category = Category::find($id);
		$Category->delete();
		
		return redirect()->route('/category');
	}	
	
	public function ShowArticle()
	{	
		$getArticle = Article::get();	
		$getCategory = Category::get();
		
		$getArticleCategory = DB::table('article_category as a') 
			->select('a.ID','a.ArticleID','a.CategoryID','b.Category')
			->leftjoin('category as b','a.CategoryID','=','b.ID')
			->get();		
					
		$data['getArticle'] = $getArticle;			
		$data['getCategory'] = $getCategory;
		$data['getArticleCategory'] = $getArticleCategory;
		
		return view('article',$data);
	}
	
	public function AddArticle()
	{	
		$data = \Request::all();
		
		$addArticle = new Article();
		$addArticle->Title = $data['title'];
		$addArticle->Description = $data['description'];
		$addArticle->Author = $data['author'];	
		$addArticle->save();
		
		$articleID = DB::getPDo()->lastInsertID();
		
		foreach ($data as $key => $value) {
			if(strpos($key, 'addcategory-')===false){
				continue;
			} else {
				$array = explode('-', $key, 2);
				$addCategory = new ArticleCategory();
				$addCategory->ArticleID = $articleID;
				$addCategory->CategoryID = $array[1];
				$addCategory->save();				
			}
		}
		
		return redirect()->route('/article');
	}	
	
	public function deleteArticleByID($id)
	{
		$Article = Article::find($id);
		$Article->delete();
		
		ArticleCategory::where('ArticleID', $id)->delete();
		$deleteArticleCategory = ArticleCategory::where('ArticleID',$id)->delete();

		return redirect()->route('/article');		
	}	
	
	public function getUpdateArticleByID($id)
	{
		$selectedArticle = Article::where('ID',$id)->first();	
		$getCategory = Category::get();
		
		$getArticleCategory = DB::table('article_category as a') 
			->select('a.ID','a.ArticleID','a.CategoryID','b.Category')
			->leftjoin('category as b','a.CategoryID','=','b.ID')
			->where('a.ArticleID',$id)
			->get();			
			
		$data['selectedArticle'] = $selectedArticle;			
		$data['getCategory'] = $getCategory;
		$data['getArticleCategory'] = $getArticleCategory;
		
		foreach ($data['getArticleCategory'] as $getArticleCategorys){
			foreach($data['getCategory'] as $getCategorys)
			if($getArticleCategorys->CategoryID==$getCategorys->ID){
				$getCategorys['checked'] = "checked";
			}
		}
		
		
		return view('article-update',$data);
	}
	
	public function postUpdateArticleByID($id)
	{
		$data = \Request::all();
		
		$updArticle = Article::where('ID',$id)->first();
		$updArticle->Title = $data['title'];
		$updArticle->Description = $data['description'];
		$updArticle->Author = $data['author'];	
		$updArticle->save();
		
		$deleteArticleCategory = ArticleCategory::where('ArticleID',$id)->delete();
		
		foreach ($data as $key => $value) {
			if(strpos($key, 'addcategory-')===false){
				continue;
			} else {
				$array = explode('-', $key, 2);
				$addCategory = new ArticleCategory();
				$addCategory->ArticleID = $id;
				$addCategory->CategoryID = $array[1];
				$addCategory->save();				
			}
		}
		
		return redirect()->route('/article');		
	}
	
	
}
