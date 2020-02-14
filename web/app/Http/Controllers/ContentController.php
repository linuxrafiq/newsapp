<?php

namespace App\Http\Controllers;

use App\Content;
use App\Category;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use phpDocumentor\Reflection\Types\Object_;
class ContentController extends Controller
{
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cats = DB:: table('categories')
        ->where('parent_id', "0")
        ->orderby('created_at','desc')
        ->get()->toArray();
        return view('contents.index')->with('cats', $cats); 
    }
    public function type(Request $request)
    {
        $this->log("type id", $request->input('type'));
        $output = view('contents.views.normaltext')->render();

        if($request->input('type')=='1'){
            $output = view('contents.views.normaltext')->render();
        }else if($request->input('type')=='2'){
            $output = view('contents.views.htmlview')->render();

        }else if($request->input('type')=='3'||$request->input('type')=='4'
        ||$request->input('type')=='5'){
            $output = view('contents.views.fileupload')->render();

        }else {
            $output = view('contents.views.normaltext')->render();
        }
       
        return response(json_encode($output), 200);
        

    }

    public function show($id)
    {
        $content = Content::find($id);
        return "abc";
        return view('contents.show')->with('content', $content);
    }

    public function contentsAll(){
        $contents= $this->getContents(null);
        return view('contents.list')->with('contents', $this->getContentList($contents));

    }
    public function contentlist($id){
        $contents= $this->getContents($id);
        return $this->getContentList($contents);
    }

    function getContentList($contents){
        $listItems = array(); 
        $length = count($contents);
        //$listItems = new Object_();
        for( $i=0; $i<$length; $i++){
            $item = new Object_();
            $content=$contents[$i];
            $item->content=$content;
            $item->app=Category::find($content->app_id);
            $item->category=Category::find($content->cat_id);
            $item->subcategory=Category::find($content->sub_cat_id);
            array_push($listItems, $item);
        }
        return $listItems;
    }

    public function getContents($subCatId){
        if ($subCatId==null){
           return Content::orderby('created_at','desc')->get();
        }else{
            return DB:: table('contents')
            ->where('sub_cat_id', $subCatId)
            ->orderby('created_at','desc')
            ->get()->toArray();
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $this->log("cat id", $request->cat);
        // $this->log("type", $request->type);
        // $this->log("content", $request->content);
       
        try {
            $anyFileNameToStore='';
            if($request->type==3||$request->type==4||$request->type==5){
                //return json_encode($request->hasFile('any_file'));
                if($request->hasFile('any_file')){
                    // $this->validate($request,[
                    //     'any_file'=>'max:10000'
                    // ]);
                    $fileNameWithExt = $request->file('any_file')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                    $extension = $request->file('any_file')->getClientOriginalExtension();
                    $anyFileNameToStore=$fileName.'_'.time().'.'.$extension;
                    //Storage::putFileAs('any_file', new File('public/files'), $anyFileNameToStore);
                    $path = $request->file('any_file')->storeAs('public/files', $anyFileNameToStore);
    
                }else{
                    $output = array("message"=>"Please upload a file  ", "status" => "403");
                    return json_encode($output);
                }
            }
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
           
            $content = new Content();
            $content->app_id=$request->app_cat;
            $content->cat_id=$request->category;
            $content->sub_cat_id=$request->subcategory;
            $content->title=$request->title;
            $content->content_type=$request->type;
            if($request->type==3||$request->type==4||$request->type==5){
                $content->content=$anyFileNameToStore;
            }else{
                $content->content=$request->content;
            }
            $content->cover_image=$fileNameToStore;
            $content->save();
            $output = array("message"=>"Content added successfully", "status" => "200");
            echo json_encode($output);
        } catch (Exception $e) {
            $output = array("message"=>"Content failed to insert: ".$e->getMessage(), "status" => "403");
            echo json_encode($output);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    // public function show(Content $content)
    // {
    //     //
    // }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Content $content)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Content  $content
     * @return \Illuminate\Http\Response
     */
    public function destroy(Content $content)
    {
        //
    }

    function log($tag, $log){
        Log::channel('stack')->info($tag.":".$log);
    }
}
