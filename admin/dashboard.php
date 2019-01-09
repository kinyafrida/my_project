<?php
require_once dirname(__FILE__) . '/include/WebConnect.php';
$connect = new WebConnect();
require_once dirname(__FILE__) . '/header.php';


if(isset($_POST['submit'])){   
	
	// save the details
	$customer_id_number =$connect -> test_input($_POST["customer_id_number"]);
}
?>
<!-- start: Content -->
            <div id="content">				
				<div class="panel">
                  <div class="panel-body">

					  
                      <div class="col-md-12 col-sm-12">
                        <h3 class="animated fadeInLeft">My Reports</h3>
                        <ul class="nav navbar-nav">
                            <li><a href ='loanstatus.php?customer_id_number=<?php echo $customer_id_number ?>' class='active'>Loan Status</a></li> &nbsp;
                           <li><a href ='ministatement.php?customer_id_number=<?php echo $customer_id_number ?>' class='active'>Mini Statement</a></li> &nbsp;
							<li><a href ='creditstatus.php?customer_id_number=<?php echo $customer_id_number ?>' class='active'>Credit Status</a></li> &nbsp;
                        </ul>
                    </div>                   
                  </div>                    
                </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>All Loans <a href="addProperty.php"><span class="icons icon-plus add-span" title="Add"></span></a></h3></div>
                    <div class="panel-body">
		    
						<?php
						//$customer_id_number = "26398092";
						$result = $connect -> callAPI('GET','http://104.248.118.5/my_app/v1/ministatement/'.$customer_id_number,false);
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
                          <td><?php echo($row['loan_amount']) ?></td>
                          <td><?php echo($row['loan_status'])?></td>
						 
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
