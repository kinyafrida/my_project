<?php
require_once dirname(__FILE__) . '/include/WebConnect.php';
$connect = new WebConnect();
require_once dirname(__FILE__) . '/header.php';

	
	// save the details
	$customer_id_number =$_REQUEST["customer_id_number"];
}
?>
<!-- start: Content -->
            <div id="content">				
				<div class="panel">
                  <div class="panel-body">
                      <div class="col-md-12 col-sm-12">
                        <h3 class="animated fadeInLeft">Response</h3> 
                        <ul class="nav navbar-nav">
                            
                        </ul>
                    </div>                   
                  </div>                    
                </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Report <a href="add.php"><span class="icons icon-plus add-span" title="Add"></span></a></h3></div>
                    <div class="panel-body">
						<?php
						//$customer_id_number = "26398092";
						
						$result = $connect -> callAPI('GET','http://104.248.118.5/my_app/v1/loanstatus/'.$customer_id_number,false);
						$response=json_decode($result,true);
						//$loans=$response['loans'];
						//$customer_id_number=$response['loans']['id_number'];
						?>
						Customer ID : <?php echo $customer_id_number ?>;
						<div>
						<p><b>Message: <?php echo($response['message']) ?></b></p>
						</div>
						<div>
						<p><b>Loan Status: <?php echo($response['loan_status']) ?></b></p></div>
                      
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
