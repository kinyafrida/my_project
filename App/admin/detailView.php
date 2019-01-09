<?php
require_once dirname(__FILE__) . '/../include/webHandler.php';
$db = new DbHandler();
require_once dirname(__FILE__) . '/header.php';
$propertyId = $_REQUEST['propertyId'];
$getProperty = $db -> getProperty($propertyId);
$uploads = $db -> getPropertyUploads($propertyId);
$propertyStatus = $db -> getPropertyStatus();

if(isset($_REQUEST['submit']))
    {
      $updatedStatus = $_POST['property_status'];
	  $update = $db ->update_property_status($propertyId,$updatedStatus);
	
	if($update > 0){
	    echo ('<script language="javascript">;');
		echo ('alert("Message: Updated");');
		echo ('window.location.reload();');
		echo ('</script>');
     }
  }
?>
  		
          <!-- start: content -->
            <div id="content">
                <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h3 class="nav animated fadeInDown">
							<a href="index.php">Properties</a>
							<span class="fa-angle-right fa"></span> 
							Detailed View
							<a href="editProperty.php?propertyId=<?php echo($propertyId) ?>"><span class="icons icon-pencil add-span" title="Edit"></span></a>
						</h3>                        
                    </div>
                  </div>
              </div>
                <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-6 padding-0">
						<div class="w3-content w3-display-container">
							
						  <img class="mySlides detail-image" src="<?php echo("../".$getProperty['propertyUrl']) ?>">
							<?php
						foreach($uploads as $upload){?>
						<img class="mySlides detail-image" src="<?php echo("../".$upload['imageUrl']) ?>">
						<?php }	?>
							
						  <div class="w3-center w3-container w3-section w3-large w3-text-white w3-display-bottommiddle" style="width:100%">
							<div class="w3-left w3-hover-text-khaki" onclick="plusDivs(-1)">&#10094;</div>
							<div class="w3-right w3-hover-text-khaki" onclick="plusDivs(1)">&#10095;</div>
							  <?php
							  for($i=1; $i <= count($uploads)+1;$i++){?>
								  <span class="w3-badge demo w3-border w3-transparent w3-hover-white" onclick="currentDiv( <?php echo($i); ?> )"></span>
							  <?php
							  }
							  ?>
						  </div>
						  </div>
					</div>
					
					<div class="col-md-6 padding-0">
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Property Type:</strong></label>
							<?php echo($getProperty['type']); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Property Listing:</strong></label>
							<?php echo($getProperty['listing']); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Location:</strong></label>
							<?php echo($getProperty['location']); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Amount:</strong></label>
							<?php echo("KES ".number_format($getProperty['amount'])); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Bedrooms:</strong></label>
							<?php echo($getProperty['bedrooms']); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Showers:</strong></label>
							<?php echo($getProperty['showers']); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Car Parks:</strong></label>
							<?php echo($getProperty['carParks']); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Manager:</strong></label>
							<?php echo($getProperty['name']); ?>
						</div>
						<div class="form-group col-lg-6">
							<label class="detail-label"><strong>Approval Status:</strong></label>
							<?php echo($getProperty['status']); ?>
						</div>
						<div class="form-group col-lg-12">
							<label class="detail-label"><strong>Description:</strong></label>
							<?php echo($getProperty['description']); ?>
						</div>
						
						<div class="col-lg-12 "><hr class="border-line"></div>
						
						<div class=" col-lg-12">
							<form action="" method="POST">
							<div class="form-group col-lg-12">	
							<label class="detail-label">Change Approval Status</label>
							<select class="form-control " name="property_status" id="property_status" required>
								<option value="">Select Status</option>
								<?php
								foreach($propertyStatus as $row){?>
								<option value="<?php echo($row['id']) ?>"><?php echo($row['action']) ?></option>
								<?php }	?>
							</select>
							</div>
							<div class="form-group col-lg-12 ">
								<input type="submit" class="btn btn-success" name="submit" id="submit" value="Update">
							</div>
							</form>
					    </div>						
					</div>                       
                </div>

                </div>
      		  </div>
          <!-- end: content -->
          
      </div>


    <!-- start: Javascript -->
    <script src="asset/js/jquery.min.js"></script>
    <script src="asset/js/jquery.ui.min.js"></script>
    <script src="asset/js/bootstrap.min.js"></script>
   
    
    <!-- plugins -->
    <script src="asset/js/plugins/moment.min.js"></script>
    <script src="asset/js/plugins/fullcalendar.min.js"></script>
    <script src="asset/js/plugins/jquery.nicescroll.js"></script>
    <script src="asset/js/plugins/jquery.vmap.min.js"></script>
    <script src="asset/js/plugins/maps/jquery.vmap.world.js"></script>
    <script src="asset/js/plugins/jquery.vmap.sampledata.js"></script>
    <script src="asset/js/plugins/chart.min.js"></script>


    <!-- custom -->
     <script src="asset/js/main.js"></script>
		<script>
		var slideIndex = 1;
		showDivs(slideIndex);

		function plusDivs(n) {
		  showDivs(slideIndex += n);
		}

		function currentDiv(n) {
		  showDivs(slideIndex = n);
		}

		function showDivs(n) {
		  var i;
		  var x = document.getElementsByClassName("mySlides");
		  var dots = document.getElementsByClassName("demo");
		  if (n > x.length) {slideIndex = 1}    
		  if (n < 1) {slideIndex = x.length}
		  for (i = 0; i < x.length; i++) {
			 x[i].style.display = "none";  
		  }
		  for (i = 0; i < dots.length; i++) {
			 dots[i].className = dots[i].className.replace(" w3-white", "");
		  }
		  x[slideIndex-1].style.display = "block";  
		  dots[slideIndex-1].className += " w3-white";
		}
		</script>
     <script type="text/javascript">
      (function(jQuery){

        

        // start: Calendar =========
         $('.dashboard .calendar').fullCalendar({
            header: {
                left: 'prev,next today',
                center: 'title',
                right: 'month,agendaWeek,agendaDay'
            },
            defaultDate: '2015-02-12',
            businessHours: true, // display business hours
            editable: true,
            events: [
                {
                    title: 'Business Lunch',
                    start: '2015-02-03T13:00:00',
                    constraint: 'businessHours'
                },
                {
                    title: 'Meeting',
                    start: '2015-02-13T11:00:00',
                    constraint: 'availableForMeeting', // defined below
                    color: '#20C572'
                },
                {
                    title: 'Conference',
                    start: '2015-02-18',
                    end: '2015-02-20'
                },
                {
                    title: 'Party',
                    start: '2015-02-29T20:00:00'
                },

                // areas where "Meeting" must be dropped
                {
                    id: 'availableForMeeting',
                    start: '2015-02-11T10:00:00',
                    end: '2015-02-11T16:00:00',
                    rendering: 'background'
                },
                {
                    id: 'availableForMeeting',
                    start: '2015-02-13T10:00:00',
                    end: '2015-02-13T16:00:00',
                    rendering: 'background'
                },

                // red areas where no events can be dropped
                {
                    start: '2015-02-24',
                    end: '2015-02-28',
                    overlap: false,
                    rendering: 'background',
                    color: '#FF6656'
                },
                {
                    start: '2015-02-06',
                    end: '2015-02-08',
                    overlap: true,
                    rendering: 'background',
                    color: '#FF6656'
                }
            ]
        });
        // end : Calendar==========

       
      })(jQuery);
     </script>
  <!-- end: Javascript -->
  </body>
</html>