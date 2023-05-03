<?php  include(VIEWS.'template'.DS.'header.php');
    echo "<script src='https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js' integrity='sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p' crossorigin='anonymous'></script>
    <script src='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js' integrity='sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF' crossorigin='anonymous'></script>
    ";
?>

<div class="container">
<div class="row">

  
<div class="row">
    <?php foreach($user as $row):  ?>
        <div class="col-md-5 m-3">
            <div class="card p-4 rounded-5  border-dark" style="height:200px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 18%);
            ">
                <div class="row">
                     <div class="col-md-5 mt-3"  >
                     <img src="<?='data:image/jpeg;base64,'.base64_encode($row['picture'])?>"  height="50%" width="100px" />
                     <a  class="btn rounded-circle  border-dark mt-2 font-weight-bold" >-</a>
                     <span>1</span>
                     <a  class="btn rounded-circle  border-dark mt-2 font-weight-bold" >+</a>

                     </div>
                     <div class="col-md-7">
                            <div class="card-body">
                        <h4 class="card-title" style="color: rgb(112, 66, 50)"><?php echo $row['name']?></h4>
                        <p class="card-text " >Price:<span class="font-weight-bold" style="color:orange" ><?php echo $row["price"] ?></span>$</p>

                        <button href="#" class="btn rounded-pill"style="color:white;background-color:orange">Added To Cart</button>
                     </div>
                </div>
            </div>
            
           
        </div>
        </div>
        
        
    <?php  endforeach; ?>
    </div>
</div>

  <div class="row">

  
    <div class="col-md-12">
      <h1>latest Order</h1>
    </div>
  </div>
  
  <div class="row">
    <div class="col-md-8 ">
    <h1>My Cafeteria Menu</h1>
        <div class="row">
    <?php foreach($products as $row):  ?>
        <div class="col-md-5 m-3">
            <div class="card p-4 rounded-5  border-dark" style="height:200px; box-shadow: 0px 0px 10px 0px rgb(0 0 0 / 18%);
            ">
                <div class="row">
                     <div class="col-md-5 mt-3"  >
                     <img src="<?='data:image/jpeg;base64,'.base64_encode($row['picture'])?>"  height="50%" width="100px" />
                     <a  class="btn rounded-circle  border-dark mt-2 font-weight-bold" >-</a>
                     <span>1</span>
                     <a  class="btn rounded-circle  border-dark mt-2 font-weight-bold" >+</a>

                     </div>
                     <div class="col-md-7">
                            <div class="card-body">
                        <h4 class="card-title" style="color: rgb(112, 66, 50)"><?php echo $row['name']?></h4>
                        <p class="card-text " >Price:<span class="font-weight-bold" style="color:orange" ><?php echo $row["price"] ?></span>$</p>

                        <button href="#" class="btn rounded-pill"style="color:white;background-color:orange">Added To Cart</button>
                     </div>
                </div>
            </div>
            
           
        </div>
        </div>
        
        
    <?php  endforeach; ?>
    </div>
        
    
    </div>
    <div class="col-md-4" style="background-color:white;height: auto;">
        <H1 class="m-2" style="color: rgb(112, 66, 50)">Cart</H1>
        <div class="card border border-white ">
                <div class="row">
                     <div class="col-md-5 mt-3"  >
                     <img src="<?='data:image/jpeg;base64,'.base64_encode($row['picture'])?>"  height="100%" width="100px" />
                     
                     </div>
                     <div class="col-md-7">
                            <div class="card-body">
                        <h4 class="card-title" style="color: rgb(112, 66, 50)"><?php echo $row['name']?></h4>
                        <p class="card-text " >Price:<span class="font-weight-bold" style="color:orange" ><?php echo $row["price"] ?></span>$</p>
                        <a  class="btn rounded-circle  border-dark mt-2 font-weight-bold" >-</a>
                        <span>1</span>
                        <a  class="btn rounded-circle  border-dark mt-2 font-weight-bold" >+</a>

                        </div>
                </div>
        </div>
        <hr>
       
        <h3 style="color:orange">Notes</h3>
        <textarea name="notes" id="notes" cols="30" rows="5"></textarea>
        <div class="row">
            <div class="col-md-8 p-3">Total Price</div>
            <div class="col-md-4 p-3" style="color:orange">5.00$</div>
        </div>
        <button type="button" class="btn rounded-pill mb-3"style="background-color:orange">Place an Order</button>
    </div>
  </div>
</div>

<?php  include(VIEWS.'template'.DS.'footer.php'); ?>
