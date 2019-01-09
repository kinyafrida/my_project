<?php
require_once dirname(__FILE__) . '/include/WebConnect.php';
$connect = new WebConnect();
require_once dirname(__FILE__) . '/header.php';
?>
<!-- start: Content -->
            <div id="content">				
				<div class="panel">
                  <div class="panel-body">
                      <div class="col-md-12 col-sm-12">
                        <h3 class="animated fadeInLeft">Propertyfind - Properties</h3>
                        <ul class="nav navbar-nav">
                           <li><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">View Reports</button></li>
                        </ul>
                    </div>                   
                  </div>                    
                </div>
                 <!-- Modal -->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Loans</h4>
                </div>
                <form method="post" action="dashboard.php" enctype="multipart/form-data">		

                    <div class="form-group col-lg-6">
                        <label for="idnum"><font class="a">*</font></label> <input class="form-control " name="customer_id_number" type="text" id="customer_id_number" placeholder="Enter Id Number" required/>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-lg-8 ">

                            <label for="idnum">&nbsp;</label>

                            <input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit"> </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
            </div>

        </div>
    </div>
    <!-- End Modal -->
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>All Properties <a href="addProperty.php"><span class="icons icon-plus add-span" title="Add"></span></a></h3></div>
                    <div class="panel-body">
						<?php
						$customer_id_number = "26398092";
						$result = $connect -> callAPI('GET','http://104.248.118.5/task_manager/v1/ministatement/'.$customer_id_number,false);
						$response=json_decode($result,true);
						$loans=$response['loans'];
						//$customer_id_number=$response['loans']['id_number'];
						?>
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Date</th>
                          <th>Amount</th>
                          <th>Loan Status</th>
                        </tr>
                      </thead>
                      <tbody>
						  <?php
						  foreach($loans as $row){?>
						  <tr>
                          <td><?php echo($row['datetimeadded']) ?></td>
                          <td><?php echo($row['loan_amount'])?></td>
                          <td><?php echo($row['loan_status']) ?></td>
						 
                        </tr>
		<?php }	?>
                       
                      </tbody>
                        </table>
                      </div>
                  </div>
                </div>
              </div>  
              </div>
            </div>
          <!-- end: content -->
<!-- start: Javascript -->
<script src="asset/js/jquery.min.js"></script>
<script src="asset/js/jquery.ui.min.js"></script>
<script src="asset/js/bootstrap.min.js"></script>



<!-- plugins -->
<script src="asset/js/plugins/moment.min.js"></script>
<script src="asset/js/plugins/jquery.datatables.min.js"></script>
<script src="asset/js/plugins/datatables.bootstrap.min.js"></script>
<script src="asset/js/plugins/jquery.nicescroll.js"></script>


<!-- custom -->
<script src="asset/js/main.js"></script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#datatables-example').DataTable();
  });
</script>
<!-- end: Javascript -->
</body>
</html>
