<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function search(Request $request)
    {

        if ($request->fullname || $request->title){


            $arrNames = preg_split('/\s+/', trim($request->fullname));
            
            $firstname = $arrNames[0];
            $lastname = (count($arrNames) == 2)? $arrNames[1] : "";
    

            if ($request->has('title')) 
                $queryBuilder = Post::Where('title', 'LIKE', $request->title.'%');
            else
                $queryBuilder = Post::all();
            
            if ($firstname){
                $queryBuilder->whereHas("author", function($query) use ($firstname){
        
                    $query->where('first_name', 'LIKE', $firstname."%");
       
                });
            }        

            if($lastname){
                $queryBuilder->whereHas("author", function($query) use ($lastname){
        
                    $query->where('last_name', 'LIKE', $lastname."%");
       
                });
            }
           

        
            $posts = $queryBuilder->get();
/*            $posts = Post::orWhere('title', 'LIKE', $request->title.'%')
                ->with(["author" => function($query){
                    global $firstname, $lastname;

                    $query->orWhere('first_name', 'LIKE', $firstname."%")
                        ->orWhere('last_name','LIKE', $lastname."%");
                }])->get();*/
            return view('home', ['posts' => $posts]);

        } else{

            return redirect()->route('home');
        
        }

    }

    private function filterPost(Request $request){

    }
}
