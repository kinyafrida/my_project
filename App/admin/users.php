<?php
require_once dirname(__FILE__) . '/../include/webHandler.php';
$db = new DbHandler();
require_once dirname(__FILE__) . '/header.php';
?>
<!-- start: Content -->
            <div id="content">				
				<div class="panel">
                  <div class="panel-body">
                      <div class="col-md-12 col-sm-12">
                        <h3 class="animated fadeInLeft">Propertyfind - Users</h3>
                        <ul class="nav navbar-nav">
                            <li><a href="" class="active">Lesama Users</a></li>
							<li><a href="contactPersons.php" >Contact Persons</a></li>
                            <li><a href="viewTechnicians.php" >Service Providers</a></li>
                        </ul>
                    </div>                   
                  </div>                    
                </div>
              <div class="col-md-12 top-20 padding-0">
                <div class="col-md-12">
                  <div class="panel">
                    <div class="panel-heading"><h3>Lesama Users <a href="addUser.php"><span class="icons icon-plus add-span" title="Add"></span></a></h3></div>
                    <div class="panel-body">
						<?php
						$lesama_users = $db -> getLesamaUsers();
						?>
                      <div class="responsive-table">
                      <table id="datatables-example" class="table table-striped table-bordered" width="100%" cellspacing="0">
                      <thead>
                        <tr>
                          <th>Name</th>
                          <th>Phone Number</th>
                          <th>Email</th>
						  <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
						  <?php
						  foreach($lesama_users as $row){?>
						  <tr>
                          <td><?php echo($row['name']) ?></td>
                          <td><?php echo($row['phone_number']) ?></td>
                          <td><?php echo($row['email_address'])?></td>
						  <td><a href="editUsers.php?userId=<?php echo($row['userId']) ?> "><span class="icons icon-pencil" title="Edit"></span></a>
							  <a href="deleteUsers.php?userId=<?php echo($row['userId']) ?> " onClick="return confirm_delete('Are you sure you want to delete?')"><span style="float: right" class="icons icon-ban" title="Delete"></span></a>
						  </td>
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