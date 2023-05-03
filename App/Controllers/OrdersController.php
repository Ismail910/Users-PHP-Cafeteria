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
        $data['products'] = $this->conn->getAllProducts();
        return $this->view('products/index',$data);
    }


 
    public function store()
    {
        if(isset($_POST['submit']))
        {
            $status = $_POST['status'];
            $date  = $_POST['date'];
            $notes = $_POST['notes'];
            $userID = $_POST['userID'];

            $this->conn = new Orders();
            $dataInsert = Array ( "status" => $status ,
                            "date" => $date  ,
                            "notes" => $notes ,
                            "userID" => $userID
                            );

            if($this->conn->insertOrder($dataInsert))
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