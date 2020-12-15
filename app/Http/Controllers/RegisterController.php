<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB; 
use App\Models\Picture;

use Session;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule; 
class RegisterController extends Controller
{ 

    public function view(){
	return view('register');
}
 public function login(){
	return view('login');
} 

 public function doregister(Request $request){ 
    
	 $fname = $request->input('fname');
	 $lname = $request->input('lname');
	 $address = $request->input('address');
	 $username = $request->input('username');
	 $password = $request->input('password'); 
	 $location = $request->input('location'); 
     $fileName = time().'.'.$request->file->extension();  
   
        $request->file->move(public_path('uploads'), $fileName);
   
     
	 
	 
	 $image = $fileName;
     DB::insert('insert into registers (fname, lname, address, username, password, location, image) values(?, ?, ?, ?, ?, ?, ?)',[$fname, $lname, $address, $username, $password, $location, $image]);
     $data = DB::table('registers')->get()->last()->id;  
	 Session::put('userid', $data);

			return view('register');
		    }  
	
	public function fav(){ 
	$userid = Session::get('userid'); 
	$data = DB::table('video')->where('userid', '=', $userid)->get(); 
	
	return view('fav', ['data' => $data]);
	} 
	public function addvideo(Request $request) { 
	 $title = $request->input('title'); 
	 
	 $description = $request->input('description');
     $url = $request->input('url'); 
	 $userid = Session::get('userid'); 
	   DB::insert('insert into video (userid, title, description, url) values(?, ?, ?, ?)',[$userid, $title, $description, $url]);
                
			return redirect()->route('fav'); 
	}
	public function logincheck(Request $request) { 
     $user = $request->input('username');
	 $password = $request->input('password'); 
	$us =  DB::table('registers') 
	       ->select('id')
	       ->where('username', '=', $user)
		   ->where('password', '=', $password)
		   ->first(); 
		
	 if ($us){ 
	 $userid = $us->id; 
     Session::put('userid', $userid);
	 return redirect()->route('fav'); 
	 }
        else {
            return redirect()->route('login'); 
		}
        
        die;  
		
		
	} 
	public function logout() { 
	 Session::forget('userid');
	return redirect()->route('login');
	
	} 
	public function deleted($id) { 

	      DB::table('video')->where('id', '=', $id)->delete();
	      return redirect()->route('fav'); 
	} 
	public function edited(Request $request) { 
echo $request->id;
	      $data = DB::table('video')->select('*')->where('id', '=', $id)->first(); 
		 
	      //return redirect()->route('fav'); 
	} 
	public function updated(Request $request) { 
	 $id = $request->input('id'); 
	 $title = $request->input('title'); 
	 
	 $description = $request->input('description');
     $url = $request->input('url'); 
	 $userid = Session::get('userid'); 
	   DB::update('update into video (userid, title, description, url) values(?, ?, ?, ?)',[$userid, $title, $description, $url])->where('id', '=', $id);
                
			return redirect()->route('fav'); 
	} 
	  public function crop()
    {
        return view('crop');
    }
	public function uploadCropImage(Request $request)
    {
        $folderPath = public_path('uploads/');
 
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
 
        file_put_contents($imageFullPath, $image_base64);
 
         $saveFile = new Picture;
         $saveFile->name = $imageName;
         $saveFile->save();
    
        return response()->json(['success'=>'Crop Image Uploaded Successfully']);
    }
}
