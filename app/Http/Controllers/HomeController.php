<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CategoryModel;
use App\CategoryDetails;
use App\ParticipantsModel;
use App\ParentModel;
use App\ReplyModel;
use View;

class HomeController extends Controller
{

	public function index(){
		$category=CategoryModel::all();

		$Participants=ParticipantsModel::all();

  //       $array=array();
		// foreach ($Participants as $key => $value) {
		// 	$array[$value->groups][]=$value;
		// }
 		
		//$data['array']=$array;
		$data['category']=CategoryModel::all();
	    
	
		return view('index')->with($data);
	}

	public function show_frm(Request $request){
		$data['id']=$request->input('id');
		$data['exist']=$iex=CategoryDetails::where(array('p_id'=>$request->input('id')))->first();
		$view = View::make('add_message',$data);
		//return view('add_message')->with($data);
		if(!empty($iex)){
			$exi='1';
		}else{
			$exi='0';
		}
		$view = View::make('add_message', $data);
          
        $html = $view->render(); 
         return response()->json(array('htmls'=>$html,'av'=>$exi));
	
	}

	public function addComment(Request $request){
		
		$request->validate([
            'message' => 'required',
            
        ]);
        $dataa = $request->except([
            '_token',
          ]);
          $id=$request->input('id');
          $message=$request->input('message');
          $f_name=$request->input('f_name');
          // $l_name=$request->input('l_name');

          $type=$request->input('type');
          $imageName='';
       if(!empty($_FILES['file'])){
        if(!empty($request->file)){
        $imageName = time().'.'.$request->file->extension();  
     
        $request->file->move('public/uploads/', $imageName);
        $data['file']=$imageName;
        }
        }
        
        $data['p_id']=$id;
        $data['message']=$message;
        $data['type']=$type;
        $data['created_at']=date('Y-m-d');
        $data['updated_at']=date('Y-m-d');
        $data['name']=$f_name;

        $result=CategoryDetails::insert($data);
        if($result){
          echo json_encode(array('sucess'=>true,'message'=>'Form Submitted Successfully'));

        }else{

           echo json_encode(array('sucess'=>false,'message'=>'Something went wrong')); 
        }
	}


	public function participants(){
		$data['ring']=ParentModel::all();
		return view('participants')->with($data);
	}


	public function add_particpant(Request $request){
		$request->validate([
            'participant' => 'required',
            
        ]);
        $data = $request->except([
            '_token',
          ]);
       
        	$array=array();
      
        $Participants=ParticipantsModel::all();
        if(!empty($Participants)){
        $array=array();
        $i=0;
        $group_id=0;
			foreach ($Participants as $key => $value) {
				$i=0;
				$array[$value->groups][]=$value;
				$group_id=$value->groups;
			}
 			$j=1;
	     foreach($array as $key=> $rows){
	    

	     	if(count($rows)<$j){
	     		$keys=$key;
	     		
	     	}else{
	     		$keys=$group_id+1;
	     		
	     	}
	     	$j=$j+6;
	     }

	     }else{
	     	$keys=1;
	     } 
	     //echo $keys;
	     ParticipantsModel::insert(array('groups'=>$keys,'participants_name'=>$request->input('participant'),'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')));
   	
	}
	
	public function showGraph(){
		$category=CategoryModel::all();

		$Participants=ParticipantsModel::all();

        $array=array();
		foreach ($Participants as $key => $value) {
			$array[$value->groups][]=$value;
		}
 		
		$data['array']=$array;
		$data['category']=CategoryModel::all();

	
		return view('index_load')->with($data);
	}


	public function submit_reply(Request $request){
		$request->validate([
            'message' => 'required',
            
        ]);
        $dataa = $request->except([
            '_token',
          ]);
        $id=$request->input('id');
        $replier_name=$request->input('reply_name');
        $replier_message=$request->input('message');
        $result=ReplyModel::insert(array('frm_id'=>$id,'replier_name'=>$replier_name,'message'=>$replier_message,'created_at'=>date('Y-m-d'),'updated_at'=>date('Y-m-d')));
        if($result){
        	echo json_encode(array('response'=>true,'msg'=>'success'));
        }else{
        	echo json_encode(array('response'=>false,'msg'=>'faild'));
        }

	}

	public function upload_file(Request $request){
		print_r($_FILES);

	}
}

?>