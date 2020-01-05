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



class Q3Controller extends Controller
{

	public function GetLongest($value)
	{	
            //remove ) at the beginning and ( at the end  
            $str = ltrim($value, ')');    
            $str = rtrim($str, '(');    
            $counter = strlen($str);   
            $getMax =0;  

            //fill the array with value 0 and size according to input length  
            $longest = array_fill(0, $counter, 0);

            for($i=1; $i < $counter; $i++)   
            {       
                //check if current position is ')'   
                //check if prev position has '('   
                if($str[$i] == ')' && $str[$i - $longest[$i - 1] - 1] == '(')   
                {   
                    //longest array value + 2 + if formula less than 0 then 0 (prevent offset by accessing negative in longest array)  
                    //formula i - prev value in longest array - 2 to cater for condition like (())(), where there is a 0 in between longest array  
                    $longest[$i] = $longest[$i - 1] + 2 + (($i - $longest[$i - 1] - 2 >= 0) ? $longest[$i - $longest[$i - 1] - 2] : 0);   
                    //compare and get max between curMax and value in longest array  
                    $getMax = max($longest[$i], $getMax);   
                }               
            }  
           return $getMax;                  
	}
	
	
}
