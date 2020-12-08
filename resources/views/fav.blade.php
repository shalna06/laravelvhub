
<!DOCTYPE html>
<html>

<head>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8' />
<meta name='robots' content='index,follow' />
<meta name='googlebot' content='index,follow,all' />
<meta name='distribution' content='global'/>
<meta name='coverage' content='worldwide'/>
<link rel='shortcut icon' href='http://localhost/vHub/uploads/logo.jpeg' rel='icon' type='image/x-icon'/ />
<meta name='identifier-url' content='index.html'/>
<meta name='revisit-after' content='4 days'>
<meta name='description' content='Keep user’s favourite YouTube videos />
<meta name='classification' content='' />
<meta name='keywords' content='keep user’s favourite YouTube videos'/>
<meta name='alexa' content='100' />
<meta name='viewport' content='width=device-width, initial-scale=1'>
<meta name="google-site-verification" content="RYO0S_PoEU6qmOhG4a_wkhm1eOXSi9oq-OhUdqml24s" />

<title>vHub</title> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head> 

<style> 

body  {
  background-image: url("http://localhost/vHub/uploads/wal1.jpg"); 

  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;

} 
.pos { 
  text-align:center; 
  position:relative;
} 
.button {
  padding: 15px 25px;
  font-size: 24px;
  text-align: center;
  cursor: pointer;
  outline: none;
  color: #fff;
  background-color: #4CAF50;
  border: none;
  border-radius: 15px;
  box-shadow: 0 9px white; 
  margin-left:40%;
}

.button:hover {background-color: #3e8e41}

.button:active {
  background-color: #3e8e41;
  box-shadow: 0 5px #666;
  transform: translateY(4px);
} 

</style>
<body> 
<div><h1 style='text-align:center;font-size: 100px;color: white;'>vHub</h1></div> 
<button class='button' data-toggle="modal" data-target="#myModal">Add your Favourite Video</button> 
  
        <a href="{{ route('logout') }}" class="btn btn-info btn-lg" style='margin-left: 1200px;margin-top: -288px;'>
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
     
</br></br></br>
<div class='pos'> 
@foreach($data as $key=>$val)  

 

<iframe width="320" height="240" src="{{ $val->url }}" frameborder="0" gesture="media" allow="encrypted-media" allowfullscreen></iframe>
<a href='{{ route('delete') }}' style='position:absolute;color:white;font-size:20px;' title='Remove your favourite video'><b>x</b></a>

@endforeach
</div>
 




  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style='text-align:center;color:white;background-color: #4CAF50;border-radius: 6px;'>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Add your Favourite Video</h4>
        </div>
        <div class="modal-body"> 
		 <form action="{{ route('addvideo') }}" method="post" enctype="multipart/form-data">
          <div class="form-group"> 
		  <input type="hidden" name="_token" id="csrf-token" value="{{ Session::token() }}" />
        	<input type="text" class="form-control" name="title" placeholder="Title" required="required">
        </div> 
		 <div class="form-group">
        	<input type="text" class="form-control" name="description" placeholder="Description" required="required">
        </div> 
		 <div class="form-group">
        	<input type="text" class="form-control" name="url" placeholder="VideoURL" data-toggle="modal" data-target="#notice" required="required">
        </div>
        </div>
        <div class="modal-footer"> 
		<div class="form-group">
            <button type="submit" class="btn btn-success">Submit</button> 
			<button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
        </div>
    </form>
        </div>
      </div>
      
    </div>
  </div>
  
  <!-- Modal -->
  <div class="modal fade" id="notice" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style='text-align:center;color:white;background-color: red;border-radius: 6px;'>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">How to copy youtube url</h4>
        </div>
        <div class="modal-body"> 
		 
          <div class="form-group">
        	1. On a computer, go to the YouTube video you want to copy.
        </div> 
		 <div class="form-group">
        	2. Under the video, click SHARE .
        </div> 
		 <div class="form-group">
        	3. Click Embed.
        </div> 
		<div class="form-group">
        	4. From the box that appears, copy the URL from HTML code.
        </div> 
		<div class="form-group">
        	5. Paste the URL into your form Submit.
        </div>
		
        </div>
        <div class="modal-footer"> 
		<div class="form-group">
          
			<button type="button" class="btn btn-success" data-dismiss="modal">Ok</button>
        </div>
    </form>
        </div>
      </div>
      
    </div>
  </div>

</body> 

</html>