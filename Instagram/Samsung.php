<?php require_once'API-MASTER/instagram.class.php'; ?>
<?php include('header.php') ?>
<html>
<head>
	<title></title>
</head>
<body>
	<div class="container">
		<div class="page-header" id="banner">
		        <div class="row">
		          <div class="col-lg-8 col-md-7 col-sm-6">
		            <div class="control-group">
                <label class="control-label">Date Picking</label>
                <div class="controls input-append date form_date" data-date="" data-date-format="dd MM yyyy" data-link-field="dtp_input2" data-link-format="dd-dd-yyyy">
                    <input size="16" type="text" value="" readonly>
                    <span class="btn btn-default"><i class="fa fa-times"></i></span>
					<span class="btn btn-default"><i class="fa fa-calendar"></i></span>
                </div>
				<input type="hidden" id="dtp_input2" value="" /><br/>
            </div>
		          </div>
		          </div>
		        </div>
		      </div>
  	</div>
  	<script type="text/javascript" src="Bootswatch/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="Bootswatch/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="Bootswatch/js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
	<script type="text/javascript" src="Bootswatch/js/bootstrap-datetimepicker.th.js" charset="UTF-8"></script>
<script type="text/javascript">
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
</script>
</body>
</html>