        </div>
    </div>
    <script src="<?php echo base_url()."/assets/js/jquery-3.5.1.min.js"; ?>"></script>
    <script src="<?php echo base_url()."/assets/js/popper.min.js"; ?>"></script>
    <script src="<?php echo base_url()."/assets/js/bootstrap.min.js"; ?>"></script>
    <script src="<?php echo base_url()."/assets/js/chart.min.js"; ?>"></script>
    <!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBl-N13dPLykJG9rBZKUBjpeyY_i5dWoc0"></script> -->
    <script src="<?php echo base_url()."/assets/js/jquery.dataTables.min.js"; ?>"></script>
    <script src="<?php echo base_url()."/assets/js/sweetalert2@11"; ?>"></script>
    <script src="<?php echo base_url()."/assets/js/html2canvas.min.js"; ?>"></script>
    <script src="<?php echo base_url()."/assets/js/dataTables.bootstrap4.min.js"; ?>"></script>
<script>
var motor_rated_hp = 0;
        function capture () {
          html2canvas(document.body).then((canvas) => {
            let a = document.createElement("a");
            a.download = "screen_shot.png";
            a.href = canvas.toDataURL("image/png");
            a.click(); // MAY NOT ALWAYS WORK!
          });
        }
        function updateStats(){
          console.log('updateStats');
          $.ajax({
              type: 'GET',
              url: '/mak_rmc/stats/show',
              async:false,
              success: function(data) {

                  //console.log(data);
                  obj = JSON.parse(data);
                  for(var k in obj[0]){
                    //console.log(k, obj[0][k]);
                    $("#"+k).text(obj[0][k])
                    $("#"+k).val(obj[0][k])
                  }
                  console.log("voltage a", obj[0]["voltage_b"]);
                  averge_voltage = (parseFloat(obj[0]["voltage_a"]) + parseFloat(obj[0]["voltage_b"]) + parseFloat(obj[0]["voltage_c"]))/3;
                  $("#averge_voltage").text(averge_voltage.toFixed(2));
                  $("#averge_voltage").val(averge_voltage.toFixed(2));


                  averge_voltage_phase_to_phase = (parseFloat(obj[0]["voltage_ab"]) + parseFloat(obj[0]["voltage_bc"]) + parseFloat(obj[0]["voltage_ca"]))/3;
                  $("#averge_voltage_phase_to_phase").text(averge_voltage_phase_to_phase.toFixed(2));

                  $("#averge_voltage_phase_to_phase").val(averge_voltage_phase_to_phase.toFixed(2));

                  total_current = (parseFloat(obj[0]["current_a"]) + parseFloat(obj[0]["current_b"]) + parseFloat(obj[0]["current_c"]))/3;
                  $("#total_current").text(total_current.toFixed(2));
                  $("#total_current").val(total_current.toFixed(2));

                  average_pf = (parseFloat(obj[0]["pf_a"]) + parseFloat(obj[0]["pf_b"]) + parseFloat(obj[0]["pf_c"]))/3;
                  $("#average_pf").text(average_pf.toFixed(3));
                  $("#average_pf").val(average_pf.toFixed(3));

                  average_power = (parseFloat(obj[0]["power_a"]) + parseFloat(obj[0]["power_b"]) + parseFloat(obj[0]["power_c"]));
                  $("#average_power").text(average_power.toFixed(3));
                  $("#average_power").val(average_power.toFixed(3));




              },
              error: function() {
              },
          });
          //print(stocks);

        }
      //  setTimeout(updateStats(), 5000);
      function updateTemperature(){
        console.log('updateTemperature');
        $.ajax({
            type: 'GET',
            url: '/mak_rmc/temperature/show',
            async:false,
            success: function(data) {

                //console.log(data);
                obj = JSON.parse(data);
                for(var k in obj[0]){
                  //console.log(k, obj[0][k]);
                  $("#"+k).text(obj[0][k]+" °C")
                  $("#"+k).val(obj[0][k])
                }
            },
            error: function() {
            },
        });
        //print(stocks);

      }


      function updateRPM(){
        console.log('updateRPM');
        $.ajax({
            type: 'GET',
            url: '/mak_rmc/rpm/show',
            async:false,
            success: function(data) {

                //console.log(data);
                obj = JSON.parse(data);
                for(var k in obj[0]){
                  //console.log(k, obj[0][k]);
                  $("#"+k).text(obj[0][k]+" RPM")
                }
            },
            error: function() {
            },
        });
        //print(stocks);

      }

      function ratedData(){

        var  data = new Array();
        $.ajax({
            type: 'GET',
            url: '/mak_rmc/dashboard/get_sites_info',
            async:false,
            success: function(data) {
                data = JSON.parse(data);
                motor_rated_hp = data['motor_rated_hp']
                // console.log(sites["total_sites"]);
            },
            error: function() {
            },
        });

      }

      function countLoadTestData(id){
        console.log('countLoadTestData');
        const load_point = ["0%", "25%", "50%","75%","100%","115%","130%"];
        var  data = new Array();
        $.ajax({
            type: 'GET',
            url: '/mak_rmc/motor_test/countLoadTestData/'+id,
            async:false,
            success: function(data) {
                data = JSON.parse(data);
                if(data[0]['count_load_test_record']>=7){
                  $("#record_load_point_button").hide();
                  $("#complete_test_button").show();

                }else{
                  $("#record_load_point_button").show();
                  $("#complete_test_button").hide();
                }
                $("#load_test_count").text(load_point[data[0]['count_load_test_record']]);
                console.log("countLoadTestData", load_point[data[0]['count_load_test_record']]);
            },
            error: function() {
            },
        });

      }


      function updateTorque_RPM(){
        console.log('updateTorque');
        $.ajax({
            type: 'GET',
            url: '/mak_rmc/torque/show',
            async:false,
            success: function(data) {

                //console.log(data);
                obj = JSON.parse(data);
                for(var k in obj[0]){
                  console.log(k, obj[0][k]);
                  if(k == "torque"){
                      $("#"+k).text(obj[0][k]+" N.m")
                  }
                  if(k == "rpm"){
                      $("#"+k).text(obj[0][k]+" RPM")
                  }

                }


                //Calculations
                shaft_power = obj[0]['rpm'] * obj[0]['torque'] * 0.00010472;
                loading_factor = (shaft_power * 100)/(motor_rated_hp*0.746);
                total_power = $('#average_power').text();
                motor_efficiency = (shaft_power * 100)/total_power;
                //Load Test Page
                $("#load_test_torque").val(obj[0]['torque']);
                $("#load_test_rpm").val(obj[0]['rpm']);
                $("#motor_size_load").val(motor_rated_hp);
                $("#loading_factor_load").val(loading_factor.toFixed(2));
                $("#motor_efficiency_load_test").val(motor_efficiency.toFixed(2));
                $("#load_test_shaft_power").val(shaft_power.toFixed(3));

                //No Load Test Page
                $("#motor_size_no_load").val(motor_rated_hp);

                //dashboard data
                $("#shaft_power").text(shaft_power.toFixed(2) +" kW");
                $("#motor_size").text(motor_rated_hp +" HP");
                $("#loading_factor").text(loading_factor.toFixed(2) +" %");
                $("#motor_efficiency").text(motor_efficiency.toFixed(2) +" %");

                //alert("updateTorque_RPM"+motor_rated_hp);

            },
            error: function() {
            },
        });
        //print(stocks);

      }

      function preview_load_data(){
        Swal.fire({
            title: 'Are you sure?',
            html: `
        <table id="table" style="font-size:14px" class="table table-hover">
            <tbody>
                <tr>
                    <td>TORQUE (N.M)</td>
                    <td>`+$("#load_test_torque").val()+`</td>
                    <td>SPEED (RPM)</td>
                    <td>`+$("#load_test_rpm").val()+`</td>
                </tr>
                <tr>
                    <td>SHAFT POWER (KW)</td>
                    <td>`+$("#load_test_shaft_power").val()+`</td>
                    <td>LOADING FACTOR (%)</td>
                    <td>`+$("#loading_factor_load").val()+`</td>
                </tr>
                <tr>
                    <td>MOTOR SIZE (HP)</td>
                    <td>`+$("#motor_size_load").val()+`</td>
                </tr>
            </tbody>
        </table>


        <table id="table" style="font-size:12px" class="table table-hover">
            <tbody>
                <thead>
                    <th>#</th>
                    <th>Average/Total</th>
                    <th>L1/L1-L2</th>
                    <th>L2/L2-L3</th>
                    <th>L3/L1-L3</th>
                </thead>
                <tr>
                    <td>Voltage (V)</td>
                    <td>`+$("#averge_voltage").val()+`</td>
                    <td>`+$("#voltage_a").val()+`</td>
                    <td>`+$("#voltage_b").val()+`</td>
                    <td>`+$("#voltage_c").val()+`</td>
                </tr>
                <tr>
                    <td>Voltage (L-L)</td>
                    <td>`+$("#averge_voltage_phase_to_phase").val()+`</td>
                    <td>`+$("#voltage_ab").val()+`</td>
                    <td>`+$("#voltage_bc").val()+`</td>
                    <td>`+$("#voltage_ca").val()+`</td>
                </tr>
                <tr>
                    <td>Current (A)</td>
                    <td>`+$("#total_current").val()+`</td>
                    <td>`+$("#current_a").val()+`</td>
                    <td>`+$("#current_b").val()+`</td>
                    <td>`+$("#current_c").val()+`</td>
                </tr>
                <tr>
                    <td>P.F.</td>
                    <td>`+$("#average_pf").val()+`</td>
                    <td>`+$("#pf_a").val()+`</td>
                    <td>`+$("#pf_b").val()+`</td>
                    <td>`+$("#pf_c").val()+`</td>
                </tr>
                <tr>
                    <td>Active Power (kW)</td>
                    <td>`+$("#average_power").val()+`</td>
                    <td>`+$("#power_a").val()+`</td>
                    <td>`+$("#power_b").val()+`</td>
                    <td>`+$("#power_c").val()+`</td>
                </tr>
                <tr>
                    <td>Frequency (Hz)</td>
                    <td>`+$("#frequency").val()+`</td>
                </tr>
            </tbody>
        </table>


        <table id="table" style="font-size:14px" class="table table-hover">
            <tbody>
                <tr>
                    <td>AMBIENT TEMPERATURE(°C)</td>
                    <td>`+$("#amb_temperature").val()+`</td>
                </tr>
                <tr>
                    <td>MOTOR TEMPERATURE(°C)</td>
                    <td>`+$("#motor_temperature").val()+`</td>
                </tr>
                <tr>
                    <td>ESTIMATED EFFICIENCY(%)</td>
                    <td>`+$("#motor_efficiency_load_test").val()+`</td>
                </tr>
            </tbody>
        </table>
        `,
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Record Load Point'
            }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById("load_test_form").submit();
                Swal.fire(
                'Saved!',
                'Record has been saved.',
                'success'
                )
            }
        })
    }

        $(document).ready(function()
        {
            //setInterval(updateStats(), 10000);
            split_path = window.location.pathname.split("/");

            //console.log("pathname", split_path[split_path.length-1]);
            if(window.location.pathname.includes('/motor_test/no_load_test') || window.location.pathname.includes('/motor_test/load_test') || window.location.pathname.includes('/dashboard')){

              updateStats();
              ret = ratedData();
              countLoadTestData(split_path[split_path.length-1]);
              updateTemperature();
              updateRPM();
              updateTorque_RPM();
              setInterval('updateStats()',1500);
              setInterval('updateTemperature()',1500);
              setInterval('updateTorque_RPM()',1500);
              //setInterval('updateRPM()',2000);
              //setInterval('updateTorque()',2000);

            }
            //
            // const socket = new WebSocket('ws://localhost:8000');
            // socket.addEventListener('open', function (event) {
            //     socket.send('Connection Established');
            //     alert("test");
            // });
            // socket.addEventListener('message', function (event) {
            //     console.log(event.data);
            //     alert("data recieved from server");
            // });



            if(document.body.contains(document.getElementById('map_card')))
            {
                PrintMap();
            }

            $('#sidebarCollapse').on('click', function()
            {
                $('#sidebar').toggleClass('active');
            });

            $('#example').DataTable();

            if(document.body.contains(document.getElementById('not-ok-sites-table')))
            {
                $('#not-ok-sites-table').DataTable();
            }

            if(document.body.contains(document.getElementById('non-feasible-sites-table')))
            {
                $('#non-feasible-sites-table').DataTable();
            }

            if(document.body.contains(document.getElementById('passed-sites-table')))
            {
                $('#passed-sites-table').DataTable();
            }

            if(document.body.contains(document.getElementById('failed-sites-table')))
            {
                $('#failed-sites-table').DataTable();
            }

            // if(document.body.contains(document.getElementById('myPieChart')))
            // {
            //     PlotChart();
            // }

        });

        $('#item').on('change', function()
        {

            var  stocks = new Array();
            $.ajax({
                type: 'GET',
                url: '/mak_rmc/stocks/get_stocks',
                async:false,
                success: function(data) {
                    stocks = JSON.parse(data);
                },
                error: function() {
                },
            });

            if($('#item').val() == "default")
            {
                $("#current_quantity_div").hide();
            }
            else
            {
                $("#current_quantity_div").show();
            }

            for (let index = 0; index < stocks.length; index++)
            {
                if($('#item').val() == stocks[index]["sno"])
                {
                    $('#current_quantity').text(stocks[index]["quantity"]);
                }

            }
        });
        $('#report_filter').on('change', function()
        {
            // console.log($('#report_filter').val());
            if($('#report_filter').val() == "all"){
                $('#package_sub_filter_label').hide();
                $('#package_sub_filter_options').hide();
                $('#district_sub_filter_label').hide();
                $('#district_sub_filter_options').hide();

            }
            else if($('#report_filter').val() == "package"){
                $('#package_sub_filter_label').hide();
                $('#package_sub_filter_options').hide();
                $('#district_sub_filter_label').hide();
                $('#district_sub_filter_options').hide();

                $('#package_sub_filter_label').show();
                $('#package_sub_filter_options').show();
            }
            else if($('#report_filter').val() == "district"){
                $('#package_sub_filter_label').hide();
                $('#package_sub_filter_options').hide();
                $('#district_sub_filter_label').hide();
                $('#district_sub_filter_options').hide();

                $('#district_sub_filter_label').show();
                $('#district_sub_filter_options').show();
            }
        });

        $('.collapse').on('shown.bs.collapse', function(){
            $(this).parent().find(".fa-caret-square-down").removeClass("fa-caret-square-down").addClass("fa-caret-square-up");
        }).on('hidden.bs.collapse', function(){
            $(this).parent().find(".fa-caret-square-up").removeClass("fa-caret-square-up").addClass("fa-caret-square-down");
        });

        function PrintMap()
        {
            var uluru = {lat: 35.2227, lng: 72.4258};
            var map = new google.maps.Map(document.getElementById('map_card'), {
                center: uluru,
                zoom: 8
            });

            var  sites = new Array();
            $.ajax({
                type: 'GET',
                url: '/mak_rmc/dashboard/get_sites',
                async:false,
                success: function(data) {
                    sites = JSON.parse(data);
                    // console.log(sites[0]["handing_taking_status"]);
                },
                error: function() {
                },
            });
            var infowindow = new google.maps.InfoWindow();

            for(index = 0; index < sites.length; index++){
                marker_url = {lat:site_lat_lng(sites[index]["gps_coordinates_n"]), lng:site_lat_lng(sites[index]["gps_coordinates_e"])};
                var marker_color = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
                var site_status = "";
                if(sites[index]["handing_taking_status"] == 1)
                {
                    site_status = "Handed Over";
                    marker_color = "http://maps.google.com/mapfiles/ms/icons/green-dot.png";
                }
                else
                {
                    if (sites[index]["fat_status"] == 1)
                    {
                        site_status = "FAT Done";
                    }
                    else
                    {
                        if (sites[index]["is_installed"] == 1)
                        {
                            site_status = "Site Installed";
                            marker_color = "http://maps.google.com/mapfiles/ms/icons/blue-dot.png";
                        }
                        else
                        {
                            if (sites[index]["supply_order_status"] == 1)
                            {
                                site_status = "Supply Order Created";
                                marker_color = "http://maps.google.com/mapfiles/ms/icons/yellow-dot.png";
                            }
                            else
                            {
                                if (sites[index]["status"] == 1)
                                {
                                    site_status = "Survey Approved";
                                }
                                else if (sites[index]["status"] == 2)
                                {
                                    site_status = "Survey Rejected";
                                }
                                else
                                {
                                    if (sites[index]["is_surveyed"] == 1)
                                    {
                                        site_status = "Survey Done";
                                        marker_color = "http://maps.google.com/mapfiles/ms/icons/red-dot.png";
                                    }
                                    else
                                    {
                                        site_status = "Site Created";
                                    }
                                }
                            }
                        }
                    }
                }

                var marker = new google.maps.Marker(
                {
                    position: marker_url,
                    map: map,
                    icon: {
                        url: marker_color
                    }

                });

                google.maps.event.addListener(marker, 'mouseover', (function(marker, index) {
                    var content =   '<h3>' +sites[index]["siteid"]+ ' <small>(' +site_status+')</small></h3>' +
                                    '<div>' +sites[index]["masgid"]+ '</div>'+
                                    '<div>' +sites[index]["address"]+ '</div>'+
                                    '<div>' +sites[index]["gps_coordinates_n"]+' , '+sites[index]["gps_coordinates_e"]+'</div>';
                    return function() {
                        infowindow.setContent(content);
                        infowindow.open(map, marker);
                    }
                })(marker, index));

                google.maps.event.addListener(marker, 'click', (function(marker, index) {
                    var content =   '<h3>' +sites[index]["siteid"]+ '</h3>' +
                                    '<div>' +sites[index]["masgid"]+ '</div>'+
                                    '<div>' +sites[index]["address"]+ '</div>'+
                                    '<div>' +sites[index]["gps_coordinates_n"]+' , '+sites[index]["gps_coordinates_e"]+'</div>';
                    return function() {
                        infowindow.setContent(content);
                        infowindow.open(map, marker);
                    }
                })(marker, index));

                google.maps.event.addListener(marker, 'mouseout', function() {
                    infowindow.close();

                });


            }
        }

        function PlotChart()
        {
            var  sites = new Array();
            $.ajax({
                type: 'GET',
                url: '/mak_rmc/dashboard/get_sites_info',
                async:false,
                success: function(data) {
                    sites = JSON.parse(data);
                    // console.log(sites["total_sites"]);
                },
                error: function() {
                },
            });

            // Set new default font family and font color to mimic Bootstrap's default styling
            Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
            Chart.defaults.global.defaultFontColor = '#858796';

            // Pie Chart Example
            var ctx = document.getElementById("myPieChart");
            var myPieChart = new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ["Total Sites", "Completed Sites", "Installed Sites"],
                    datasets: [{
                    data: [sites["total_sites"], sites["handed_over_sites"], sites["installed_sites"]],
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'],
                    hoverBackgroundColor: ['#2e59d9', '#17a673', '#2c9faf'],
                    hoverBorderColor: "rgba(234, 236, 244, 1)",
                    }],
                },
                options: {
                    maintainAspectRatio: false,
                    tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    caretPadding: 10,
                    },
                    legend: {
                    display: false
                    },
                    cutoutPercentage: 80,
                },
            });
        }

        var site_lat_lng = function(str){
            res = str.split(" ");
            return (parseFloat(res[0]) + (parseFloat(res[1])/60)+(parseFloat(res[2])/3600));
        }
    </script>
</body>

</html>
