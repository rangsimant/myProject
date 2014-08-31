	<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap\cssbootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
    <script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<html>
 <head>
 	<script type="text/javascript">
 	    $(function(){
    		$("#btnOK").click(function(){
    		alert($('#date1').val()+"\n"+$('#date2').val());
    	});
    });
 	</script>
 	<title></title>
 </head>
 <body>
 	<div class="container">
    <form action="" class="form-horizontal">
        <fieldset>
            <legend>Test</legend>
			<div class="control-group">
                <label class="control-label">Date From :</label>
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly id="date1">
					<span class="add-on"><i class="icon-th"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
			<div class="control-group">
                <label class="control-label">Date To :</label>
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="yyyy-mm-dd">
                    <input size="16" type="text" value="" readonly id="date2">
					<span class="add-on"><i class="icon-th"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
            <div class="control-group">
            	<a href="#"class="btn btn-Default" id="btnOK">OK</a>
            </div>
        </fieldset>
    </form>
</div>
<?php include('datetime.php'); ?>
 </body>
 </html> 