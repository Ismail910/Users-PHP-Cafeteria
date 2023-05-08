<?php 



class OrdersController extends Controller 
{
    private $conn;

    public function __construct()
    {
        $this->conn = new Orders();


    }


    public function index()
    {
        $id=$_POST['userID'];
        $data['orders'] = $this->conn->getUserOrder($userID);
        // var_dump($data);

        return $this->view('OrderUser/index',$data,$id);
    }


 
    public function store()
    {
        if(isset($_POST['notes']))
        {
            $notes = $_POST['notes'];
            $userID = $_POST['id_user'];
            $totalPriceOrder = $_POST['totalPriceOrder'];
            $userroomNumber = $_POST['userroomNumber'];
            $dataInsert = Array ( 
                            "notes" => $notes ,
                            "userID" => $_SESSION["id"]
                            ,
                            );
            if(!isset($userID) and empty($userID)){
                $data['erroruserid'] = "Please Select User";
                return $this->view('home/index',$data);
            }
            if(!isset($userroomNumber) and empty($userroomNumber)){
                $data['errorroom'] = "Please Select Room";
                return $this->view('home/index',$data);
            }
            $this->conn = new Products();
            $data['products'] = $this->conn->getAllProducts();
            $this->conn = new Users();
            $data['users']=$this->conn->getAllUsersByRole(0); 
        $this->conn = new Orders();


        // Create a database connection using PDO
$dsn = "mysql:host=127.0.0.1;dbname=cafeteria;port=3306;";
$username = "root";
$password = "";
$pdo = new PDO($dsn, $username, $password);

// Prepare the INSERT SQL statement
$sql = "INSERT INTO `order` (userID, notes,totalPrice,roomNumber ) VALUES (:userID, :notes,:totalPrice,:roomNumber )";
$stmt = $pdo->prepare($sql);

    if(!$userID){
        $data['error'] = "not Found user";
        return $this->view('home/index',$data);
    }
    $stmt->bindParam(':userID', $userID,PDO::PARAM_INT);
    $stmt->bindParam(':notes', $notes,PDO::PARAM_STR);
    $stmt->bindParam(':totalPrice', $totalPriceOrder,PDO::PARAM_INT);
    $stmt->bindParam(':roomNumber', $userroomNumber,PDO::PARAM_INT);


   $res= $stmt->execute();
       
if ($res === false) {
    $errorInfo = $stmt->errorInfo();
    $errorCode = $errorInfo[1];
    $errorMessage = $errorInfo[2];
    echo "SQL error (code $errorCode): $errorMessage";
    return;
}                
   $orderId = $pdo->lastInsertId();
            if($orderId)
            {
               
                // Insert each order item into the database
                if (isset($_SESSION['cart'])) {
                    foreach ($_SESSION['cart'] as $item) {
                        $pdo = new PDO($dsn, $username, $password);
                         // Prepare the INSERT SQL statement
                        $sql = "INSERT INTO `orderdetails` (productID, orderID,quantity,totalPriceProduct) VALUES (:productID, :orderID,:quantity,:totalPriceProduct)";
                        $stmt = $pdo->prepare($sql);
                        $stmt->bindParam(':productID', $item['id'],PDO::PARAM_INT);
                        $stmt->bindParam(':orderID', $orderId,PDO::PARAM_INT);
                        $stmt->bindParam(':quantity',  $item['quantity'],PDO::PARAM_INT);
                        $stmt->bindParam(':totalPriceProduct',  $item['price'],PDO::PARAM_INT);
                        $res= $stmt->execute();
                    }
                    
                    if($res){
                        $data['success'] = "Order Added Successfully";
                        unset($_SESSION["cart"]);
                        return $this->view('home/index',$data);
                    }
                }
            }
            else 
            {
                $data['error'] = "Error happened";
                return $this->view('home/index',$data);
            }
        }
    }
}