<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
use phpDocumentor\Reflection\Types\Object_;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats=Category::orderby('created_at','desc')->get();
        return view('cats.index')->with('cats', $cats);
    }
    public function indexApp(){
        return view('cats.app');
    }
    public function indexCat(Request $request){
        return view('cats.cat')->with('cats', $this->getCats('0'));
    }
    public function indexSub(Request $request){
        // $data = DB:: table('categories')
        // ->where('parent_id', $request->value)
        // ->get()->toArray();
        // return view('cats.sub')->with('cats', $data);
        $cats=Category::orderby('created_at','desc')->get();
        return view('cats.sub')->with('cats', $cats);
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         Log::info('Showing user profile for user: ');
         Log::channel('slack')->info('Something happened!');
        // Log::emergency("emergency");
        // Log::alert("alert");
        // Log::critical("critical");
        // Log::error("error");
        // Log::warning("warning");
        // Log::notice();
        // Log::info("info");
        // Log::debug("debug");
        $cats = Category::orderby('created_at','desc')->get();
        return view('cats.create')->with('cats', $cats);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
        ]);
        // Log::channel('stack')->info('name'.$request->name);
        // Log::channel('stack')->info('id'.$request->id);
        // $catExist = DB:: table('categories')
        // ->where('title', $request->name)
        // ->get()->first();
        // if ($catExist === null) {
        //     $cat = new Category();
        //     $cat->title = $request->input('name');
        //     $cat->parent_id = $request->input('parent_id');
        //     $cat->user_id=auth()->user()->id;
        //     $cat->save();
        //     return redirect(route('cats.app'))->with('success', 'App created successfully.');

        // }else{
        //     return redirect(route('cats.app'))->with('error', 'App already exists.');
        // }
    //     if($this->storeCategory($request->input('name'), $request->input('parent_id'))==1){
    //         return redirect(route('cats.app'))->with('success', 'App created successfully.');
    //     }else{
    //          return redirect(route('cats.app'))->with('error', 'App already exists.');
    // }
        
    }

    public function storeapp(Request $request){
        if($this->checkforExist($request)  !== null){
            $output = array("message"=>"This app name already exist", "status" => "403");
            return json_encode($output);
        }
        echo $this->storeCategory($request, "App");

    }

    public function storecat(Request $request){
        //return json_encode($request->hasFile('cover_image'));
        if($this->checkforExist($request)  !== null){
            $output = array("message"=>"This category name already exist", "status" => "403");
            return json_encode($output);
        }
        echo $this->storeCategory($request, "Category");

    }

    public function storesubcat(Request $request){
        //Log::channel('stack')->info('data'.$data->toString());
        if($this->checkforExist($request)  !== null){
            $output = array("message"=>"This subcategory name already exist", "status" => "403");
            return json_encode($output);
        }
        echo $this->storeCategory($request, "Subcategory");
    }

    public function storecontent(Request $request){

    }

    function checkforExist(Request $request){
            return DB:: table('categories')
            ->where('title',$request->title)
            ->get()->first();
    }
    function storeCategory(Request $request, $type){
        //return json_encode(getimagesize($request->cover_image));
        try{
            $fileNameToStore='no_image.jpg';
            if($request->hasFile('cover_image')){
                $this->validate($request,[
                    'cover_image'=>'image|nullable|max:1999'
                ]);
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $extension = $request->file('cover_image')->getClientOriginalExtension();
                $fileNameToStore=$fileName.'_'.time().'.'.$extension;
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);

            }
            $cat = new Category();
            $cat->title = $request->title;
            $cat->parent_id = $request->parent;
            $cat->cover_image=$fileNameToStore;
            $cat->user_id=auth()->user()->id;
            $cat->save();
            return json_encode(array("message"=>"This ".$type." successfully added", "status" => "200"));
              
        }catch(Exception $e){
            return  json_encode(array("message"=>$type." failed to insert: ".$e->getMessage(), "status" => "403"));
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return "edit".$id;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        return "update";
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return "deleted".$id;
    }

    
    public function fetch(Request $request)
    {
        Log::channel('stack')->info('data');

        $data = DB:: table('categories')
                ->where('parent_id', $request->value)
                ->get()->toArray();
        //Log::channel('stack')->info('data'.$data->toString());
        //echo '<pre>';
        //dd($data);
        //exit;
        // $output = '<option value="">Select '.ucfirst($request->dependent).'</option>';
        // foreach($data as $row){
        //     $output.= '<option value="'.$row->id.'">'.$row->title.'</option>';
        // }
        return response(json_encode($data), 200);
    }

    public function applist(Request $request){
        return view('cats.list.applist')->with('cats', $this->getCats("0"));
    }
    public function catlist(Request $request){
        
        return view('cats.list.catlist')->with('cats', 
        $this->getCats("0")); // loading catlist view with app list
    }
    public function subcatlist(Request $request){
        return view('cats.list.subcatlist')->with('cats', 
        $this->getCats("0")); // loading subcatlist view with applist
    }

    function getCats($parent_id){
        $cats = DB:: table('categories')
        ->where('parent_id', $parent_id)
        ->orderby('created_at','desc')
        ->get()->toArray();
        return $cats;
    }
   
    function log($tag, $log){
        Log::channel('stack')->info($tag.":".$log);
    }
}
