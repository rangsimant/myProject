$(document).ready(function() {

  var reportdate = function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
    $('#reportrange span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
    //alert("Callback has fired: [" + start.format('DD MMMM YYYY') + " to " + end.format('DD MMMM YYYY') + ", label = " + label + "]");
    $('#report-date').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
  }

  var comparedate = function(start, end, label) {
    console.log(start.toISOString(), end.toISOString(), label);
    $('#date-Compare span').html(start.format('DD MMMM YYYY') + ' - ' + end.format('DD MMMM YYYY'));
    //alert("Callback has fired: [" + start.format('DD MMMM YYYY') + " to " + end.format('DD MMMM YYYY') + ", label = " + label + "]");
  }

  var optionSet2 = {
    startDate: moment(),
    endDate: moment(),
    opens: 'left',
    ranges: {
       'Today': [moment(), moment()],
       'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
       'Last 7 Days': [moment().subtract(6, 'days'), moment()],
       'Last 30 Days': [moment().subtract(29, 'days'), moment()],
       'This Month': [moment().startOf('month'), moment().endOf('month')],
       'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  };

  $('#reportrange span').html(moment().format('DD MMMM YYYY') + ' - ' + moment().format('DD MMMM YYYY'));
  $('#date-Compare span').html(moment().subtract(29, 'days').format('DD MMMM YYYY') + ' - ' + moment().format('DD MMMM YYYY'));

  $('#reportrange').daterangepicker(optionSet2, reportdate);
  $('#date-Compare').daterangepicker(optionSet2, comparedate);

  $('#reportrange').on('show.daterangepicker', function() { console.log("show event fired"); });
  $('#reportrange').on('hide.daterangepicker', function() { console.log("hide event fired"); });
  $('#reportrange').on('apply.daterangepicker', function(ev, picker) { 
    console.log("apply event fired, start/end dates are " 
      + picker.startDate.format('DD MMMM YYYY') 
      + " to " 
      + picker.endDate.format('DD MMMM YYYY')
    ); 
  });
  $('#reportrange').on('cancel.daterangepicker', function(ev, picker) { console.log("cancel event fired"); });

});