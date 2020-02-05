<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use DB;
use phpDocumentor\Reflection\Types\Object_;
use Illuminate\Support\Facades\Log;
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
        $data = DB:: table('categories')
        ->where('parent_id', '0')
        ->get()->toArray();
        return view('cats.cat')->with('cats', $data);
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
        if ($this-> storeCategory($request->input('title'), $request->parent_id)==1){
            $output = array("message"=>"App added successfully", "status" => "200");
            echo json_encode($output);
        }else{
            $output = array("message"=>"This name already exist", "status" => "403");
            echo json_encode($output);
        }

    }

    public function storecat(Request $request){
        if ($this-> storeCategory($request->input('title'), $request->appcat)==1){
            $output = array("message"=>"Category added successfully", "status" => "200");
            echo json_encode($output);
        }else{
            $output = array("message"=>"This name already exist", "status" => "403");
            echo json_encode($output);
        }

    }

    public function storesubcat(Request $request){
        //Log::channel('stack')->info('data'.$data->toString());
        
        if ($this-> storeCategory($request->input('title'), $request->cat)==1){
           
            $output = array("message"=>"Subcategory added successfully", "status" => "200");
            echo json_encode($output);
            //exit;
           // return response(" Subcategory added successfully", 200, null);
        }else{
            $output = array("message"=>"This name already exist", "status" => "403");
            echo json_encode($output);
            //return response("This name already exist", 403, null);
        }
    }

    public function storecontent(Request $request){

    }

    function storeCategory($catname, $parent_id){
        $catExist = DB:: table('categories')
        ->where('title',$catname)
        ->get()->first();
        if ($catExist === null) {
            $cat = new Category();
            $cat->title = $catname;
            $cat->parent_id = $parent_id;
            $cat->user_id=auth()->user()->id;
            $cat->save();
            return 1;
        }else{
            return 0;
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
    public function edit(Category $category)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
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
        $output = '<option value="">Select '.ucfirst($request->dependent).'</option>';
        foreach($data as $row){
            $output.= '<option value="'.$row->id.'">'.$row->title.'</option>';
        }
        return response($output, 200);
    }

    function log($tag, $log){
        Log::channel('stack')->info($tag.":".$log);
    }
}
