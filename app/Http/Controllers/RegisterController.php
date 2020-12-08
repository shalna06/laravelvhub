<?php


namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

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
     DB::insert('insert into registers (fname, lname, address, username, password, location) values(?, ?, ?, ?, ?, ?)',[$fname, $lname, $address, $username, $password, $location]);
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
	public function edited($id) { 
echo 'ok';
	      $data = DB::table('video')->select('*')->where('id', '=', $id)->first(); 
		 
	      //return redirect()->route('fav'); 
	}
}
