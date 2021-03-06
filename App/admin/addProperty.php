<?php
require_once dirname(__FILE__) . '/../include/webHandler.php';
$db = new DbHandler();
require_once dirname(__FILE__) . '/header.php';
?>
  		
          <!-- start: content -->
            <div id="content">
               <div class="panel box-shadow-none content-header">
                  <div class="panel-body">
                    <div class="col-md-12">
                        <h4 class="nav animated fadeInDown">
							<a href="index.php">Properties</a>
							<span class="fa-angle-right fa"></span> 
							Add Property
						</h4>                        
                    </div>
                  </div>
              </div>

                <div class="col-md-12" style="padding:20px;">
                    <div class="col-md-12 padding-0">
							
	<form method="post" action="saveProperty.php" enctype="multipart/form-data">
								
								<?php
								$propertyTypes = $db -> getPropertyTypes();
								?>
								
		<div class="form-group col-lg-4">
			<label for="idnum">Property Type<font class="a">*</font></label>
			<select class="form-control " name="propertyType" id="propertyType" required>
				<option value="">Select Type</option>
				<?php
				foreach($propertyTypes as $row){?>
				<option value="<?php echo($row['id']) ?>"><?php echo($row['type']) ?></option>
				<?php }	?>
				
			</select>
		</div>
								<?php
								$propertyListing = $db -> getPropertyListing();
								?>
		<div class="form-group col-lg-4">
			<label for="idnum">Property Listing<font class="a">*</font></label>
			<select class="form-control " name="propertyListing" id="propertyListing" required>
				<option value="">Select Listing</option>
				<?php
				foreach($propertyListing as $row){?>
				<option value="<?php echo($row['id']) ?>"><?php echo($row['listing']) ?></option>
				<?php }	?>
				
			</select>
		</div>
								<?php
								$genLocation = $db -> getPropertyLocation();
								?>
		<div class="form-group col-lg-4">
			<label for="idnum">Location<font class="a">*</font></label>
			<select class="form-control " name="generalLocation" id="generalLocation" required>
				<option value="">Select Location</option>
				<?php
				foreach($genLocation as $row){?>
				<option value="<?php echo($row['id']) ?>"><?php echo($row['general_location']) ?></option>
				<?php }	?>
				
			</select>
		</div>

<div class="form-group col-lg-4">
	<label for="idnum">Specific Location<font class="a">*</font></label> <input class="form-control " name="location" type="text" id="location" placeholder="Specify the location e.g Ruaka" required/>
</div>
								
<div class="form-group col-lg-4">
	<label for="idnum">Amount (KSH)<font class="a">*</font></label> <input class="form-control " name="amount" type="text" id="amount" placeholder="Enter rent/price e.g 35000"/>
</div>
								<?php
								$genManager = $db -> getPropertyManager();
								?>
<div class="form-group col-lg-4">
	<label for="idnum">Contact Person<font class="a">*</font></label>
	<select class="form-control " name="manager" id="manager" required>
		<option value="">Select Person</option>
		<?php
		foreach($genManager as $row){?>
		<option value="<?php echo($row['userId']) ?>"><?php echo($row['name']) ?></option>
		<?php }	?>
	</select>
</div>
								
<div class="form-group col-lg-4">
	<label for="idnum">Bedrooms<font class="a">*</font></label> <input class="form-control " name="bedrooms" type="number" id="bedrooms" min="0" required/>
</div>
								
<div class="form-group col-lg-4">
	<label for="idnum">Showers<font class="a">*</font></label> <input class="form-control " name="showers" type="number" id="showers" min="0" required/>
</div>

<div class="form-group col-lg-4">
	<label for="idnum">Car Parks<font class="a">*</font></label> <input class="form-control " name="carParks" type="number" id="carParks" min="0" required/>
</div>
								
<div class="form-group col-lg-8">
	<label for="idnum">Description<font class="a">*</font></label>
	<textarea class="form-control" name="description" id="description" rows="5"placeholder="Describe the property fully" required></textarea>	
</div>								
								
<div class="form-group col-lg-6">
	<label for="idnum">Property Photo <font class="a">*</font></label>
	<input type="file" name="propertyPhoto" id="propertyPhoto" required="required">
</div>
								
<div class="form-group col-lg-6">
	<label for="idnum">Indoor Facilities<font class="a">*</font> <span class="small"><i>(Can select multiple images)</i></span> </label>
	<input type="file" name="facilities[]"  multiple required="required">
</div>
	<div class="col-lg-8 form-group">
	<input type="submit" class="btn btn-success" name="submit" id="submit" value="Save"> </div>
						</form>		
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
     <script type="text/javascript">
      (function(jQuery){

        // start: Chart =============

        Chart.defaults.global.pointHitDetectionRadius = 1;
        Chart.defaults.global.customTooltips = function(tooltip) {

            var tooltipEl = $('#chartjs-tooltip');

            if (!tooltip) {
                tooltipEl.css({
                    opacity: 0
                });
                return;
            }

            tooltipEl.removeClass('above below');
            tooltipEl.addClass(tooltip.yAlign);

            var innerHtml = '';
            if (undefined !== tooltip.labels && tooltip.labels.length) {
                for (var i = tooltip.labels.length - 1; i >= 0; i--) {
                    innerHtml += [
                        '<div class="chartjs-tooltip-section">',
                        '   <span class="chartjs-tooltip-key" style="background-color:' + tooltip.legendColors[i].fill + '"></span>',
                        '   <span class="chartjs-tooltip-value">' + tooltip.labels[i] + '</span>',
                        '</div>'
                    ].join('');
                }
                tooltipEl.html(innerHtml);
            }

            tooltipEl.css({
                opacity: 1,
                left: tooltip.chart.canvas.offsetLeft + tooltip.x + 'px',
                top: tooltip.chart.canvas.offsetTop + tooltip.y + 'px',
                fontFamily: tooltip.fontFamily,
                fontSize: tooltip.fontSize,
                fontStyle: tooltip.fontStyle
            });
        };
        var randomScalingFactor = function() {
            return Math.round(Math.random() * 100);
        };
        var lineChartData = {
            labels: ["January", "February", "March", "April", "May", "June", "July"],
            datasets: [{
                label: "My First dataset",
                fillColor: "rgba(21,186,103,0.4)",
                strokeColor: "rgba(220,220,220,1)",
                pointColor: "rgba(66,69,67,0.3)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(220,220,220,1)",
                 data: [18,9,5,7,4.5,4,5,4.5,6,5.6,7.5]
            }, {
                label: "My Second dataset",
                fillColor: "rgba(21,113,186,0.5)",
                strokeColor: "rgba(151,187,205,1)",
                pointColor: "rgba(151,187,205,1)",
                pointStrokeColor: "#fff",
                pointHighlightFill: "#fff",
                pointHighlightStroke: "rgba(151,187,205,1)",
                data: [4,7,5,7,4.5,4,5,4.5,6,5.6,7.5]
            }]
        };

        var doughnutData = [
                {
                    value: 300,
                    color:"#129352",
                    highlight: "#15BA67",
                    label: "Alfa"
                },
                {
                    value: 50,
                    color: "#1AD576",
                    highlight: "#15BA67",
                    label: "Beta"
                },
                {
                    value: 100,
                    color: "#FDB45C",
                    highlight: "#15BA67",
                    label: "Gamma"
                },
                {
                    value: 40,
                    color: "#0F5E36",
                    highlight: "#15BA67",
                    label: "Peta"
                },
                {
                    value: 120,
                    color: "#15A65D",
                    highlight: "#15BA67",
                    label: "X"
                }

            ];


        var doughnutData2 = [
                {
                    value: 100,
                    color:"#129352",
                    highlight: "#15BA67",
                    label: "Alfa"
                },
                {
                    value: 250,
                    color: "#FF6656",
                    highlight: "#FF6656",
                    label: "Beta"
                },
                {
                    value: 100,
                    color: "#FDB45C",
                    highlight: "#15BA67",
                    label: "Gamma"
                },
                {
                    value: 40,
                    color: "#FD786A",
                    highlight: "#15BA67",
                    label: "Peta"
                },
                {
                    value: 120,
                    color: "#15A65D",
                    highlight: "#15BA67",
                    label: "X"
                }

            ];

        var barChartData = {
                labels: ["January", "February", "March", "April", "May", "June", "July"],
                datasets: [
                    {
                        label: "My First dataset",
                        fillColor: "rgba(21,186,103,0.4)",
                        strokeColor: "rgba(220,220,220,0.8)",
                        highlightFill: "rgba(21,186,103,0.2)",
                        highlightStroke: "rgba(21,186,103,0.2)",
                        data: [65, 59, 80, 81, 56, 55, 40]
                    },
                    {
                        label: "My Second dataset",
                        fillColor: "rgba(21,113,186,0.5)",
                        strokeColor: "rgba(151,187,205,0.8)",
                        highlightFill: "rgba(21,113,186,0.2)",
                        highlightStroke: "rgba(21,113,186,0.2)",
                        data: [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
            };

         window.onload = function(){
                var ctx = $(".doughnut-chart")[0].getContext("2d");
                window.myDoughnut = new Chart(ctx).Doughnut(doughnutData, {
                    responsive : true,
                    showTooltips: true
                });

                var ctx2 = $(".line-chart")[0].getContext("2d");
                window.myLine = new Chart(ctx2).Line(lineChartData, {
                     responsive: true,
                        showTooltips: true,
                        multiTooltipTemplate: "<%= value %>",
                     maintainAspectRatio: false
                });

                var ctx3 = $(".bar-chart")[0].getContext("2d");
                window.myLine = new Chart(ctx3).Bar(barChartData, {
                     responsive: true,
                        showTooltips: true
                });

                var ctx4 = $(".doughnut-chart2")[0].getContext("2d");
                window.myDoughnut2 = new Chart(ctx4).Doughnut(doughnutData2, {
                    responsive : true,
                    showTooltips: true
                });

            };
        
        //  end:  Chart =============

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