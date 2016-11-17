<?php
use Illuminate\Http\Request as Request;

class Home extends Controller{
	public function index($name = ''){
		/*$user = $this->model('User');
		$user->$name = $name;*/
		$this->view('home/index');//, ['name' => $user->$name]);
	}

	public function register($name = ''){
		/*$user = $this->model('User');
		$user->$name = $name;*/
		$this->view('home/register');//, ['name' => $user->$name]);
	}

    public function terms($name = ''){
		/*$user = $this->model('User');
		$user->$name = $name;*/
		$this->view('home/terms');//, ['name' => $user->$name]);
	}
    
        public function login($name = ''){
		/*$user = $this->model('User');
		$user->$name = $name;*/
		$this->view('home/login');//, ['name' => $user->$name]);
	}
    
    public function placeOrder(){
		$this->view('home/placeOrder');
	}
    
    public function shipping(){
		$this->view('home/shipping');
	}

    public function confirmOrder(){
		$this->view('home/confirmOrder');
	}
    
    public function insertOrder(){
        header("Location: http://localhost/pattywhack/mvc/public/home");	
		$this->view('home/index');
	}
    
    public function userAccount(){
		$this->view('home/userAccount');
	}
    
	public function logUser(){
		if(isset($_POST["UserLogin"])){

			$getUserByUsername = $this->model('user');
			if($getUserByUsername->where('username' , $_POST["UserLogin"])->exists()){

				$hash = $getUserByUsername->where('username' , $_POST["UserLogin"])->first()->password_hash;
				echo '<pre>';
				var_dump($getUserByUsername);
				echo '</pre>';
				$verify = password_verify($_POST["PasswordLogin"], $hash);
				if($verify){
					$_SESSION['user'] = $_POST["UserLogin"];
					header("Location: http://localhost/pattywhack/mvc/public/home");				
				}
				else{
					$this->view('home/login',['message'=>"Wrong password"]);
				}
			}
			else{
				$this->view('home/login',['message'=>"Wrong username"]);
			}
		}
	}

	public function logOut(){
		unset($_SESSION['user']);
		header("Location: http://localhost/pattywhack/mvc/public/home");	
	}

	public function parseAmazon( $url = ''){
		require_once 'core/simple_html_dom.php';
		if(isset($_POST['website']))
			$url = $_POST['website'];
		if($url != ''){
			libxml_use_internal_errors(true);
			$html = file_get_html($url);			
			$title = $html->find('span#productTitle')->plaintext;
			$price = $html->find('span#priceblock_ourprice')->plaintext;
			$category = $html->find('a.a-link-normal a-color-tertiary')->firstChild->plaintext;
			header("Location: http://localhost/pattywhack/mvc/public/home");
			var_dump($html);
		}
	}


	public function createUser(){
		if(isset($_POST)){
			$passHash = password_hash($_POST["PasswordBox"], PASSWORD_DEFAULT);
			$newguy = new User;
			$newguy->username = $_POST["UsernameBox"];
			$newguy->password_hash = $passHash;
			$newguy->address = $_POST["AddressBox"];
			$newguy->postal_code = $_POST["PostalCodeBox"];
			$newguy->email = $_POST["EmailBox"];// Hash::check($_POST["password"], $hashedPassword)
			/*$newguy = User::create([
					'username' => $_POST["UsernameBox"],
					'password_hash' => $passHash, 
					'address' => $_POST["AddressBox"],
					'postal_code'=> $_POST["PostalCodeBox"],
					'email'	=> $_POST['EmailBox']
				]);*/
			
			$getUserByEmail = User::where('username' , $_POST["UsernameBox"])->get();
			
			if($newguy->isValid() && ($getUserByEmail->count() == 0)){
				$newguy->save();
				header("Location: http://localhost/pattywhack/mvc/public/home");			

			}		
			else{
				if(isset($_POST["EmailBox"]) && isset($_POST["AddressBox"]) && isset($_POST["PostalCodeBox"]))
					$this->view('home/register',['message'=>"Username already in use.", 'email'=>$_POST["EmailBox"],'address'=>$_POST["AddressBox"],'pCode'=>$_POST["PostalCodeBox"]]);

			}
			
		}
	}


	
}
?>