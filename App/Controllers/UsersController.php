<?php

class UsersController extends Controller
{
    private $conn;
    private $connProduct;
    public function __construct()
    {
        $this->conn = new Users();
        $this->connProduct=new Products();
    }
    public function index()
    {
        $data['users'] = $this->conn->getAllUsers();
        return $this->view('users/index',$data);
    }
    public function add()
    {
        return $this->view('users/add');
    }
    public function store()
    {
        if(isset($_POST)&&isset($_FILES))
        {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $tmp_img = $_FILES['picture']['tmp_name'];
            $picture= file_get_contents($tmp_img);
            $isAdmin = 0;
            $roomNumber	= $_POST['roomNumber'];

            $this->conn = new Users();
            $dataInsert = Array (
                "name" => $name ,
                "email" => $email  ,
                "password" => $password ,
                "phone"=>$phone,
                // "picture" => $picture,
                "isAdmin" => $isAdmin,
                "roomNumber" => $roomNumber
            );

            if($this->conn->insertUsers($_FILES,$dataInsert))
            {
                $data['success'] = "User Added Successfully";
                return $this->index();
            }
            else
            {
                $data['error'] = "Error";
                return $this->view('users/add',$data);
            }
        }
        return $this->view('users/add');



    }
    public function edit($id)
    {
        $data['user'] = $this->conn->getUser($id);
        return $this->view('users/edit',$data);
    }

    public function update()
    {
        if(isset($_FILES))
        {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $tmp_img = $_FILES['picture']['tmp_name'];
            $picture= file_get_contents($tmp_img);
            $isAdmin = 0;
            $roomNumber	= $_POST['roomNumber'];

            $this->conn = new Users();
            $dataInsert = Array (
                "name" => $name ,
                "picture" => $picture,
            );
            if($this->conn->updateUser($id,$dataInsert))
            {
                $data['success'] = "Updated Successfully";
                $data['users'] = $this->conn->getAllUsers();
                return $this->view('users/index',$data);

            }
            else
            {
                $data['error'] = "Error";
                $data['user'] = $this->conn->getUser($id);
                return $this->view('users/edit',$data);
            }
        }
        redirect('users/index');
    }

    public function delete($id)
    {
        if($this->conn->deleteUser($id))
        {
            $data['success'] = "User Have Been Deleted";
            return $this->index();
        }
        else
        {
            $data['error'] = "Error";
            return $this->view('users/delete',$data);
        }
        return $this->view('users/delete');

    }
    ////////////

    public function login(){
        return $this->view('users/login');
    
    }
    public function validationlogin(){
        try{
            $data =  $this->conn->getAllUsers();
            
        foreach ($data as $row){
            // var_dump($_POST['email'],$_POST['password']);
            if(isset($_POST['email']) && isset($_POST['password'])){
            if ($row['email'] == $_POST['email'] and $row['password'] == $_POST['password'] ){
                
                    if($row['isAdmin']==true){
                        $data['errorLogin']="this user not User";
                
                        if(isset($_POST['email'])){
                        $data['oldDataEmail']=$_POST['email'];}
                        // header($url);
                        return $this->view('users/login',$data);
                    }
                    session_start();    
                    $_SESSION["email"]=$row["email"];
                    unset($_SESSION["cart"]);
                     
                $data['users']=$this->conn->getAllUsersByRole(0);  
                $data['products'] = $this->connProduct->getAllProducts();
                    $dsn = "mysql:host=127.0.0.1;dbname=cafeteria;port=3306;";
                    $username = "root";
                    $password = "";
                    $pdo = new PDO($dsn, $username, $password);
            
                    $query = "select * from `room`";
                    $select_stmt = $pdo->prepare($query);
                    $res=$select_stmt->execute();
                    $dataroom = $select_stmt->fetchAll(PDO::FETCH_ASSOC);
                    $data['rooms']=$dataroom;
                    return $this->view('home/index',$data);
                }
            }
            }
                $data['errorLogin']="invalid email or password";
                
                if(isset($_POST['email'])){
                $data['oldDataEmail']=$_POST['email'];}
                // header($url);
                return $this->view('users/login',$data);
        
    }catch (Exception $e) {
        echo $e->getMessage();
    }
    }

    public function logout(){
        session_start();
        unset($_SESSION["email"]);
        unset($_SESSION["cart"]);

        session_destroy();
        return $this->view('users/login');
    
    }
}


