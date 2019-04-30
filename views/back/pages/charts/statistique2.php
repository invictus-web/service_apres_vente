<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    

    <!-- Bootstrap -->
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
      
    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
       


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
           
            <div class="clearfix"></div>

            <div class="row">
              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  

<?PHP             
include "C:/wamp64/www/back/pages/core/reclamationC.php";
//$reclamation1r=new reclamationC();
//$listerec=$reclamation1r->afficherreclamation();


?>



  <div class="x_content">
                    <div class="row">
                      <div class="col-sm-12">
                        <div class="card-box table-responsive">
                 



                  <div class="x_content">

                   

 
<h1 class="page-header">R&eacuteclamations</h1>
        
          
          <div style="width: 500px; height: 500px">
            <canvas id="myChart" width="1000" height="1000" style="display: block;height: 50px !important ;width: 20px!important ; border : 20px"></canvas>


              <script>
                  var ctx = document.getElementById("myChart").getContext('2d');
                  var myChart = new Chart(ctx, {
                          type: 'bar',
    data: {
        labels: ["Avril","Mai"],
        datasets: [{
            label: '# of Votes',
            data: [  <?php 


                        $connection = mysqli_connect("localhost", "root", "", "test1");
                       // $sql = "SELECT COUNT(num) as number from reclamation where  sujet='service'";
                        $sql = "SELECT COUNT(month(datee)) from reclamation where  month(datee)=4";
                        $query = mysqli_query($connection, $sql);
                        $table = null;
                        while ($row = mysqli_fetch_array($query)) {
                            $table = $row[0];
                        }
                        print_r($table);


                        ?>
                           , <?php 


                            $connection = mysqli_connect("localhost", "root", "", "test1");
                          // $sql = "SELECT COUNT(num) as number from reclamation where  sujet='produit'";
                             $sql = "SELECT COUNT(month(datee)) from reclamation where  month(datee)=5";
                  $query = mysqli_query($connection, $sql);
                       $table = null;
        while ($row = mysqli_fetch_array($query)) {
            $table = $row[0];
        }
        print_r($table);


        ?>
],
            backgroundColor: [
                'rgba(0, 102, 204)',
                'rgba(102, 179, 255)'
                //'rgba(255, 206, 86)'
            ],
            borderColor: [
                'rgba(0, 102, 204)',
                'rgba(102, 179, 255)'
                //'rgba(255, 206, 86)'
            ],
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }
});


</script>
</div>
           
                    </div>
                  </div>
                </div>
              
               
                      </div>
                  </div>
                </div>
              </div>


                     
                    
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        

  




   

  
  </body>
</html>