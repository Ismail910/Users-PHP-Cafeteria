<?php  include(VIEWS.'template'.DS.'header.php');
echo "
<script src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js' integrity='sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN' crossorigin='anonymous'></script>
    ";
?>
    <link rel="stylesheet" href="<?=BURL.'css/styleTable.css'?>"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

    <div class="container">
        <div class="row">
            <div class="col-10 mx-auto p-4 mb-5">
                <?php $i=1; ?>
                <?php  foreach($orders as $row):  ?>
                    <table  class="table  table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th >Order Date</th>
                            <th >Status</th>
                            <th >Amount</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td> <?php echo $i; $i++; ?></td>
                            <td><?php echo $row['date']; ?>
                                <p>
<!--                                    <a class="btn btn-primary" data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">-->
<!--                                        Link with href-->
<!--                                    </a>-->

                                    <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" aria-label="Toggle navigation">
                                        Button with data-bs-target
                                    </button>
                                </p>
                                <div class="collapse" id="collapseExample">
                                    <div class="card card-body">
                                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                                    </div>
                                </div>


                            </td>
                            <td><?php echo $row['status']; ?></td>
                            <td class="text-center"><?php echo $row['totalPrice']; ?></td>
                            <td>
                                <a href="#" class="btn btn-danger">
                                    <i>deliver</i>
                                </a>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                <?php  endforeach; ?>
            </div>
        </div>
    </div>

<?php  include(VIEWS.'template'.DS.'footer.php'); ?>