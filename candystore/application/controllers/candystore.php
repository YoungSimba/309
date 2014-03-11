<?php

class CandyStore extends CI_Controller {
   
     
    function __construct() {
    		// Call the Controller constructor
	    	parent::__construct();
			session_start();
	    	
	    	
	    	$config['upload_path'] = './images/product/';
	    	$config['allowed_types'] = 'gif|jpg|png';
/*	    	$config['max_size'] = '100';
	    	$config['max_width'] = '1024';
	    	$config['max_height'] = '768';
*/
	    		    	
	    	$this->load->library('upload', $config);
	    	
    }

    function index() {
			
    		$this->load->model('product_model');
    		$products = $this->product_model->getAll();
    		$data['products']=$products;
    		$this->load->view('product/list.php',$data);
    }
    
    function newForm() {
	    	$this->load->view('product/newForm.php');
    }
    
	function create() {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required|is_unique[product.name]');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		$fileUploadSuccess = $this->upload->do_upload();
		
		if ($this->form_validation->run() == true && $fileUploadSuccess) {
			$this->load->model('product_model');

			$product = new Product();
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$data = $this->upload->data();
			$product->photo_url = $data['file_name'];
			
			$this->product_model->insert($product);

			//Then we redirect to the index page again
			redirect('candystore/index', 'refresh');
		}
		else {
			if ( !$fileUploadSuccess) {
				$data['fileerror'] = $this->upload->display_errors();
				$this->load->view('product/newForm.php',$data);
				return;
			}
			
			$this->load->view('product/newForm.php');
		}	
	}
	
	function read($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/read.php',$data);
	}
	
	function editForm($id) {
		$this->load->model('product_model');
		$product = $this->product_model->get($id);
		$data['product']=$product;
		$this->load->view('product/editForm.php',$data);
	}
	
	function update($id) {
		$this->load->library('form_validation');
		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('description','Description','required');
		$this->form_validation->set_rules('price','Price','required');
		
		if ($this->form_validation->run() == true) {
			$product = new Product();
			$product->id = $id;
			$product->name = $this->input->get_post('name');
			$product->description = $this->input->get_post('description');
			$product->price = $this->input->get_post('price');
			
			$this->load->model('product_model');
			$this->product_model->update($product);
			//Then we redirect to the index page again
			redirect('candystore/index', 'refresh');
		}
		else {
			$product = new Product();
			$product->id = $id;
			$product->name = set_value('name');
			$product->description = set_value('description');
			$product->price = set_value('price');
			$data['product']=$product;
			$this->load->view('product/editForm.php',$data);
		}
	}
    	
	function delete($id) {
		$this->load->model('product_model');
		
		if (isset($id)) 
			$this->product_model->delete($id);
		
		//Then we redirect to the index page again
		redirect('candystore/index', 'refresh');
	}
	
	function newCustomer(){
			$this->load->view('customer/newCustomer.php');
	}
	
	function createCustomer() {
		$this->load->model('product_model');
		$this->load->library('form_validation');
		$this->form_validation->set_rules('first','First','required');
		$this->form_validation->set_rules('last','Last','required');
	
		
		
		if ($this->form_validation->run() == true) {
			$this->load->model('customer_model');
			$customer = new Customer();
			$customer->first = $this->input->get_post('first');
			$customer->last = $this->input->get_post('last');
			$customer->login = $this->input->get_post('login');
			$customer->password = $this->input->get_post('password');
			$customer->email = $this->input->get_post('email');
			
			$this->customer_model->insert($customer);

			//Then we redirect to the index page again
			redirect('candystore/index', 'refresh');
		}
		else {
			
			$this->load->view('customer/newCustomer.php');
		}	
	}
	
	function listCustomer() {
			
    		$this->load->model('customer_model');
    		$customers = $this->customer_model->getAll();
    		$data['customers']=$customers;
    		$this->load->view('customer/list.php',$data);
    }
	

	
	function newOrder(){
			$this->load->model('customer_model');
	}
	
	function buy(){
		$this->load->model('product_model');
		$item = $this->product_model->get($this->input->get('var1'));
		$qty = $this->input->get('var2');
		
		$new_product = array(array('name'=>$item->name, 'code'=>$item->id, 'qty'=>$qty, 'price'=>$item->price));
        
		$qty = $this->input->get('var2');
		
		if(isset($_COOKIE["candystore"]))	{
			$found = false; //set found item to false
   
            foreach (unserialize($_COOKIE["candystore"]) as $cart_itm) //loop through session array
            {
                if($cart_itm["code"] == $item->id){ //the item exist in array

                    $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"] += $qty, 'price'=>$cart_itm["price"]);
                    $found = true;
					
					
					
                }else{
                    //item doesn't exist in the list, just retrive old info and prepare array for session var
                    $product[] = array('name'=>$cart_itm["name"], 'code'=>$cart_itm["code"], 'qty'=>$cart_itm["qty"], 'price'=>$cart_itm["price"]);
                }
            }
           
            if($found == false) //we didn't find item in array
            {
                //add new user item in array
                setcookie('candystore', serialize(array_merge($product, $new_product)), time()+(60*60*24*30), '/');
				
				redirect('candystore/index', 'refresh');
            }else{
                //found user item in array list, and increased the quantity
                setcookie('candystore', serialize($product), time()+(60*60*24*30), '/');
				redirect('candystore/index', 'refresh');
            }
			
			
		}
		
		else{

		setcookie('candystore', serialize($new_product), time()+(60*60*24*30), '/');
        
		redirect('candystore/index', 'refresh');	
		}

	}
	
	function clearCart(){
		setcookie('candystore', "", time()-(60*60*24*30), '/');
		redirect('candystore/index', 'refresh');
	}
	
	function logout(){
		clearCart();
		session_destroy();
		redirect('candystore/index', 'refresh');			
	}
	
	function login(){
		$this->load->view('customer/login.php');
	}
	
	function authenticate(){
		$this->load->model('customer_model');

    		if ($this->customer_model->authenticate($this->input->get_post('login'), $this->input->get_post('password')) ){
				
  				$_SESSION["loggedin"] = true;
				$_SESSION["username"] = $this->input->get_post('login');
				if ($_SESSION['loggedin'] == true){
					redirect('candystore/index', 'refresh');
				}
			}
			
			
		
	}


}

