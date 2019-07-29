<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Promela to NS Chart Generator</title>

  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/scrolling-nav.css?id=1" rel="stylesheet">
	
  <!-- Custom JS -->
  <link href="js/result.js" rel="stylesheet">

	
</head>

<body id="page-top">

  <!-- Navigation -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-cupink drop-shadow fixed-top" id="mainNav">
    <div class="container">
      <a class="navbar-brand js-scroll-trigger" href="#page-top">Promela to NS Chart Generator</a>
	  <div>
		<button type="button" data-toggle="modal" data-target="#cExampleTrace" class="btn btn-outline-light">Trace</button>
	  	<button type="button" class="btn btn-outline-light" id="saveCanvas">Save NS Chart</button>
		<a href="index.html" class="btn btn-outline-danger" role="button">Restart</a>
      </div>
	</div>
  </nav>

  <section id="about">
    <div class="container">
      <div class="row">
        <div class="mx-auto">
          <div class="w-100 p-3" id="canvasArea">
          
          <?php
          //$xmlname = "nsbase.xml";
          $xmlname = $_GET['xml'];
          $xmldata = simplexml_load_file($xmlname) or die("Failed to load");

          ?>
          <?php
          $get_start=0;
          $get_if=0;
          foreach($xmldata as $data){      
                if(preg_match('/\b(do)\b/', $data->children()))
                {
                // check do
                $offset = '';
                echo "<div class=\"row\">";
                echo "<div class=\"col\" style=\"border-bottom:none;border-left:black solid;border-right:black solid;\">";
                
                echo htmlentities($data->children());
                
                echo "</div>";
                echo "</div>";
                  $get_start = $data->attributes()['lc_id'];
                }

                else if(preg_match('/\b(od)\b/', $data->children())){
                  //check od
                $offset = '';
                echo "<div class=\"row\">";
                 echo "<div class=\"col\" style=\"border-top:none;border-left:black solid;border-right:black solid;\">";
                echo htmlentities($data->children());
                echo "</div>";
                echo "</div>";
                $get_stop = $data->attributes()['lc_id'];
                }

                else if(($data->attributes()['lc_id'] == $get_start+1) && ($get_start != 0)){
                  // check lc beetween do and od and escape getstart 0
                  echo "<div class=\"row\" style=\"border-left:black solid;\">";
                  echo "<div class=\"col\">";
                  echo "<div class=\"row\">";
                  echo "<div class=\"col offset-lg-2\" style=\"border:black solid;\">";
                echo htmlentities($data->children());
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                $get_start = $data->attributes()['lc_id'];
                }

                else if(preg_match('/\b(if)\b/', $data->children()))
                {
                // check if
                $offset = '';
                echo "<div class=\"row\">";
                echo "<div class=\"col\" style=\"border:black solid;\">";
              
                echo htmlentities($data->children());
                
                echo "</div>";
                echo "</div>";
                $get_if = $data->attributes()['lc_id'];
                }

                else if(preg_match('/\b(fi)\b/', $data->children())){
                //check fi
                $offset = '';
                echo "<div class=\"row\">";
                echo "<div class=\"col\" style=\"border:black solid;\">";
                echo htmlentities($data->children());
                echo "</div>";
                echo "</div>";
                $get_stopif = $data->attributes()['lc_id'];
                }

                else if(($data->attributes()['lc_id'] == $get_if+1) && ($get_if != 0)){
                // check lc beetween do and od and escape getstart 0
                echo "<div class=\"row\">";
                echo "<div class=\"col\">";
                echo "<div class=\"row\">";
                echo "<div class=\"col\" style=\"border:black dashed;\">";
                echo htmlentities($data->children());
                echo "</div>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
                $get_if = $data->attributes()['lc_id'];
                }

                // elseif(preg_match('/\b(do)\b/', $data->children()) && ($data->attributes()['trace'] == "true"))
                // {
                // // check do
                // $offset = '';
                // echo "<div class=\"row\">";
                // echo "<div class=\"col\" style=\"border-bottom:none;border-left:black solid;border-right:black solid;\">";
                
                // echo htmlentities($data->children());
                
                // echo "</div>";
                // echo "</div>";
                //   $get_start = $data->attributes()['lc_id'];
                // }

                // else if(preg_match('/\b(od)\b/', $data->children()) && ($data->attributes()['trace'] == "true")){
                //   //check od
                // $offset = '';
                // echo "<div class=\"row\">";
                //  echo "<div class=\"col\" style=\"border-top:none;border-left:black solid;border-right:black solid;\">";
                // echo htmlentities($data->children());
                // echo "</div>";
                // echo "</div>";
                // $get_stop = $data->attributes()['lc_id'];
                // }

                // else if(($data->attributes()['lc_id'] == $get_start+1) && ($get_start != 0) && ($data->attributes()['trace'] == "true")){
                //   // check lc beetween do and od and escape getstart 0
                //   echo "<div class=\"row\" style=\"border-left:black solid;\">";
                //   echo "<div class=\"col\">";
                //   echo "<div class=\"row\">";
                //   echo "<div class=\"col offset-lg-2\" style=\"border:black solid;\">";
                // echo htmlentities($data->children());
                // echo "</div>";
                // echo "</div>";
                // echo "</div>";
                // echo "</div>";
                // $get_start = $data->attributes()['lc_id'];
                // }

                // else if(preg_match('/\b(if)\b/', $data->children()) && ($data->attributes()['trace'] == "true"))
                // {
                // // check if
                // $offset = '';
                // echo "<div class=\"row\">";
                // echo "<div class=\"col\" style=\"border:black solid;\">";
              
                // echo htmlentities($data->children());
                
                // echo "</div>";
                // echo "</div>";
                // $get_if = $data->attributes()['lc_id'];
                // }

                // else if(preg_match('/\b(fi)\b/', $data->children()) && ($data->attributes()['trace'] == "true")){
                // //check fi
                // $offset = '';
                // echo "<div class=\"row\">";
                // echo "<div class=\"col traced\" style=\"border:black solid;\">";
                // echo htmlentities($data->children());
                // echo "</div>";
                // echo "</div>";
                // $get_stopif = $data->attributes()['lc_id'];
                // }

                // else if(($data->attributes()['lc_id'] == $get_if+1) && ($get_if != 0) && ($data->attributes()['trace'] == "true")){
                // // check lc beetween do and od and escape getstart 0
                // echo "<div class=\"row\" style=\"border-left:black solid;\">";
                // echo "<div class=\"col\">";
                // echo "<div class=\"row\">";
                // echo "<div class=\"col traced\" style=\"border:black dashed;\">";
                // echo htmlentities($data->children());
                // echo "</div>";
                // echo "</div>";
                // echo "</div>";
                // echo "</div>";
                // $get_start = $data->attributes()['lc_id'];
                // }

                // elseif($data->attributes()['trace'] == "true"){
                //   // print traced statement
                //   $offset = '';
                //   echo "<div class=\"row\">";
                //   echo "<div class=\"col traced\" style=\"border:black solid;\">";
                // echo htmlentities($data->children());
                // echo "</div>";
                // echo "</div>";
                // }

                else{
                  // print statement
                  $offset = '';
                  echo "<div class=\"row\">";
                  echo "<div class=\"col\" style=\"border:black solid;\">";
                echo htmlentities($data->children());
                echo "</div>";
                echo "</div>";
                }
          }
          ?>
          </table>


		      </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer class="footer bg-cupink">
    <div class="container vertical-center">
      <p class="m-0 alignleft text-white">Copyright &copy; <strong>A. Chawanothai</strong>.  <a data-toggle="modal" href="#disclaimer"><i>Disclaimer</i></a></p>
      <p class="m-0 alignright text-white">Version 1.0.0</p>
    </div>
    <!-- /.container -->
  </footer>

	
  <!-- Modal Disclaimer -->
  <div class="modal fade" id="disclaimer" role="dialog">
    <div class="modal-dialog shadow-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modalTitle">Discliamer</h4>
        </div>
        <div class="modal-body">
          <p>This tools is a part of a thesis titled <strong>"Visualization of Promela with NS-Chart"</strong> and submitted in partial fulfullment of the requirements for the Degree of Master of Science in Software Engineering. Department of Computer Engineering, Faculty of Engineering, Chulalongkorn University.</p>
		  <p>เครื่องมือนี้เป็นส่วนหนึ่งของวิทยานิพนธ์เรื่อง <strong>"การมโนภาพของโพรเมลาด้วยแผนภาพเอ็นเอส"</strong> อันเป็นส่วนหนึ่งของการศึกษาตามหลักสูตรปริญญาวิทยาศาสตรมหาบัณฑิต สาขาวิชาวิศวกรรมซอฟต์แวร์ ภาควิชาวิศวกรรมคอมพิวเตอร์ คณะวิศวกรรมศาสตร์ จุฬาลงกรณ์มหาวิทยาลัย</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>

  <!-- Modal Counter Example-->
  <div class="modal fade" id="cExampleTrace" role="dialog">
    <div class="modal-dialog shadow-lg">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modalTitle">"Counter Example" tracing</h4>
        </div>
        <div class="modal-body">
          <p>To begin the process, please upload a file.<br /><i>(Only .txt file supported)</i></p>
        <div class="input-group">
            <div class="custom-file">
            <input type="file" id="selectfile">
            <!--<input type="file" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
              <label class="custom-file-label" for="inputGroupFile01">Choose file</label>-->
            </div>
        </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-pink" onclick="file_explorer();">Start Process</button>
        </div>
        </div>
          
        </div>
      </div>


<!-- dialog -->
      <div id="dialog" title="Basic dialog">
        <img id="test" src=""></img>
</div>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Plugin JavaScript -->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
  <script src="js/html2canvas.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- Custom JavaScript for this theme -->
  <script src="js/scrolling-nav.js"></script>
  
  <script>

  var element = document.getElementById("canvasArea");
  var fileobj;
	  
	$('#saveCanvas').on('click', function(e){		
		html2canvas(element).then(function(canvas) {
    	// Export the canvas to its data URI representation
    	var image = canvas.toDataURL("image/png").replace("image/png", "image/octet-stream");
		console.log(image);

		// Open the image in a new window
     	//window.open(base64image , "_blank");
    //window.location.href=image;
    $('#test').attr("src",image);
    $( "#dialog" ).dialog();
    });
  })
  
  /*function upload_file(e) {
    e.preventDefault();
    fileobj = e.dataTransfer.files[0];
    alert('kuy');
    ajax_file_upload(fileobj);
  }
*/

  function file_explorer() {
        fileobj = document.getElementById('selectfile').files[0];;
        ajax_file_upload(fileobj);
  }

	  
  function ajax_file_upload(file_obj) {
    if(file_obj != undefined) {
        var form_data = new FormData();                  
        form_data.append('file', file_obj);
      $.ajax({
        type: 'POST',
        url: 'ajax.php',
        contentType: false,
        processData: false,
        data: form_data,
        success:function(response) {
          //alert(response);
          window.location.href= "result.php?xml=nsbase.xml";
        }
      });
    }
  }
  </script>

</body>

</html>
