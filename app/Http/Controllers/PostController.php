<?php

namespace App\Http\Controllers;
use App\Post;

use Illuminate\Http\Request;
use function GuzzleHttp\json_encode;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function search(Request $request) {

        $arrNames = preg_split('/\s+/', trim($request->fullname));
        $firstname =(count($arrNames) >= 1)? $arrNames[0] : "";
        $lastname = (count($arrNames) == 2)? $arrNames[1] : "";
 
        if ($request->title){
            $queryBuilder = Post::Where('title', 'LIKE', $request->title.'%');
            if ($firstname){
                $queryBuilder->whereHas("author", function($query) use ($firstname, $lastname){
                     static::authorQuery($query,$firstname, $lastname);
                });
            }
        }else{
            if ($firstname){
                $queryBuilder = Post::whereHas("author", function($query) use ($firstname, $lastname){
                     static::authorQuery($query,$firstname, $lastname);
                });
            }
        }
        $offset = intval($request->start);
        $limit =  intval($request->length);
        
        if(isset($queryBuilder)){
            $recordsFiltered = $queryBuilder->count();
            $posts = $queryBuilder->offset($offset)
                                  ->limit($limit)
                                  ->get(); 
        }else{
            $recordsFiltered = DB::table('posts')->count();
            $posts = Post::offset($offset)
                         ->limit($limit)
                         ->get();
        }

        $posts_array = array();

        foreach($posts as $post){
            array_push($posts_array, array(
                        strval($post->author->id),
                        $post->author->first_name." ".$post->author->last_name,
                        '<a href=\'mailto://'.$post->author->email.'\'>'.
                            $post->author->email.
                        '</a>',
                        date('F m, Y',strtotime($post->author->birthdate)),
                        $post->title,
                        $post->description,
                        $post->date?date('F m, Y h:i A',strtotime($post->date)): 'N/A'));
        }
                

        $data = array(
                        "draw"=>$request->draw?intval($request->draw):0,
                        "recordsTotal" => Post::all()->count(),
                        "recordsFiltered"=>$recordsFiltered,
                        "data"=>$posts_array);
        
        return json_encode($data);       
//            return view('home', ['posts' => $posts, 'request' => $request]);
    }

    private static function authorQuery($query,$firstname, $lastname){
        if ($lastname)
            $query->where('first_name', 'LIKE', $firstname."%")
                    ->where('last_name', 'LIKE', $lastname."%");
        else
            $query->where('first_name', 'LIKE', $firstname."%")
                    ->orWhere('last_name', 'LIKE', $firstname."%");
    }

}
