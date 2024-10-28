<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\job;
use App\Http\Requests\CreateJobsRequest;
use App\Http\Requests\UpdateJobsRequest;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\DB;
class JobsController extends Controller
{
   public function index(){
     
      //elquent model
       // $data=job::select("*")->orderby("id","ASC")->paginate(10);
        //query builder
        //$data=DB::table('jobs')->paginate(2);
        $data=get_cols_where_p(new job(),array("*"),array(),'id','ASC',11);
        return view('index',['data'=>$data]);
    }

    public function create(){
       return view('create');
    }

    public function store(CreateJobsRequest $request){
    $datatoinsert['name']=$request->job_name;
    $datatoinsert['active']=$request->job_active;
    $datatoinsert['created_at']=now();
    if($request->has('photo')){

   $datatoinsert['photo']=upload("uploads",$request->photo);
      //$image=$request->photo;
      //$extension=strtolower($image->extension());
      //$filename=time().rand(1,1000).".".$extension;
     // $image->move("uploads",$filename);
     // $datatoinsert['photo']=$filename;
    }
    
    
    insert(new job(),$datatoinsert);
    //elquent model  
    //job::create($datatoinsert);
    //query builder
    //DB::table('jobs')->insert($datatoinsert);

    return redirect()->route('jobindex')->with(['success'=>'Job Added Succesfully']);

    }

   public function edit($id){
      //elquent model
      //$data=job::select("*")->find($id);
      //query builder
      //$data=DB::table('jobs')->find($id);
     $data=get_cols_where_row(   new job(),array('*'),array('id'=>$id));
      return view('edit',['data'=>$data]);
   }

   public function update($id ,UpdateJobsRequest $request){
    $datatoupdate['name']=$request->job_name;
    $datatoupdate['active']=$request->job_active;
    $datatoupdate['updated_at']=date("y-m-d H:i:s");
    //elquent model
    //job::where(['id'=>$id])->update($datatoupdate);
     //query builder
     //DB::table('jobs')->where("id",$id)->update($datatoupdate);
     update(new job(),$datatoupdate,array("id"=>$id));
    return redirect()->route('jobindex')->with(['success'=>'Job Updated Succesfully']);

   }
   public function destroy($id ){
      //elquent model
      //job::where(['id',$id])->delete();
      //query builder
      //DB::table('jobs')->where('id',$id)->delete();
      
     delete(new job(),array("id"=>$id));
      return redirect()->route('jobindex')->with(['success'=>'Job Deleted Succesfully']);
   }

   public function ajax_search(Request $request){
   if ($request->ajax()){
      $searchbyjobname=$request->searchbyjobname;
      $data=job::where("name","like","%{$searchbyjobname}%")->orderby("id","ASC")->paginate(1);
      return view('ajax_search',['data'=>$data]);

   }

   }




   

}
