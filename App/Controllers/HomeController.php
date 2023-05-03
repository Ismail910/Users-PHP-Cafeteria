<?php



class HomeController extends Controller
{
    private $product;
    private $OrderDetails;
    private $user;

    private $userid;
    private $Order;
    private $orderid;
    public function __construct()
    {
        $this->product = new Products();
        $this->OrderDetails = new OrderDetails();
        $this->user = new User();
        $this->Order = new Order();


    }
    public function index()
    {
        $data['products'] = $this->product->getAllProducts();
        $data['user'] = $this->user->getUser(2);
        $data['orders'] = $this->OrderDetails->getORders();
       
        return $this->view('products/index', $data);
    }

    public function addCard($id)
    {

        $Product = $this->product->getProduct($id);
       

        session_start();
        if (!isset($_SESSION['card'])) {
            $_SESSION['card'] = array();
        }


        for ($i = 0; $i < count($_SESSION['card']); $i++) {
            if ($Product[0]["name"] == $_SESSION['card'][$i]['name']) {
                $_SESSION['card'][$i]['quantity'] += 1;
                $_SESSION['card'][$i] = [
                    'name' => $Product[0]["name"],
                    'price' => $Product[0]["price"] * $_SESSION['cart'][$i]['quantity'],
                    'quantity' => $_SESSION['cart'][$i]['quantity'],
                    'id' => $Product[0]["id"]
                ];
                echo json_encode($_SESSION['card'][$i]);
                return;
            }
        }

        try {
            $item = [
                "name" => $Product[0]["name"],
                "price" => $Product[0]["price"],
                "quantity" => 1
            ];
            $_SESSION['card'] =  $item;
            $data['success'] = "Product Have Been saved";
            $result = [
                'name' => $Product[0]["name"],
                'price' => $Product[0]["price"],
                'quantity' => 1,
                'id' =>$Product[0]["id"],


            ];
            echo json_encode($result);

        
        } catch (Exception $e) {
            $data['error'] = "'Caught exception: ',   $e->getMessage(), '\n'";    
        }
    }





    public function store()
    {
        if(isset($_POST['submit']))
        {
            $status = $_POST['status'];
            $date  = $_POST['date'];
            $notes = $_POST['notes'];
            $userID = $_POST['userID'];

            
            $dataInsert = Array ( "status" => $status ,
                            "date" => $date  ,
                            "notes" => $notes ,
                            "userID" => $userID
                            );

            if($this->Order->insertOrder($dataInsert))
            {
                $data['success'] = "Data Added Successfully";
                return $this->view('products/index',$data);
            }
            else 
            {
                $data['error'] = "Error";
                return $this->view('products/index',$data);
            }
        }
        return $this->view('products/index');
    }







}