<?php 
function get_cols_where_p($model=null,$columns=array(),$where=array(),$orderbyfiled='id',$orderbytype='ASC',$paginationcounter=11){
$data=$model::select($columns)->where($where)->orderby($orderbyfiled,$orderbytype)->paginate($paginationcounter);
return  $data; 
}


function insert($model=null,$dataToinsert=array()){
    $flag= $model::create($dataToinsert);
    return  $flag;
    }



function update($model=null,$dataToupdate=array(), $where=array()){
    $flag= $model::where($where)->update($dataToupdate);
    return $flag;
 }

 function get_cols_where_row($model=null,$columns=array(),$where=array()){
    $datarow= $model::select()->where($where)->first();
    return $datarow;
 }

 function delete($model=null,$where=array()){
    $flag= $model::where($where)->delete();
    return $flag;
 }

 function upload($folderStoringPath,$image){

  
      $extension=strtolower($image->extension());
      $filename=time().rand(1,1000).".".$extension;
      $image->move("uploads",$filename);
      return $filename;
 }

