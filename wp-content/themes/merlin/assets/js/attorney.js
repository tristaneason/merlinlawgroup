// Attorney filtering
// Collect & send filter data; call on click of apply button

var sendFilterData = function() {

  // initialize all the variables to be used as an empty array.
  $('#results').html("");
  var state = [];
  var specialty = [];
  var term_id = $('#cat_id').text();

  // loop through all checked check boxes; take the items and push into an empty array
  $(".filter-wrap.state input.ios8-switch:checked").each(function() {
    var state_title = $(this).attr('name');
    state.push(state_title);
  });

  $(".filter-wrap.specialty input.ios8-switch:checked").each(function() {
    var specialty_title = $(this).attr('name');
    specialty.push(specialty_title);
  });

  // collect all the data.
  // ex: {state: Array(3), specialty: Array(0)}
  var filter_data = {
    'state': state,
    'specialty': specialty
  }
  //console.log(filter_data);
  $.ajax({
    url: ajaxreq.ajaxurl,
    type: 'POST',
    data: {
      action: 'query_attorneys',
      filter_data: filter_data
    },
    error: function(xhr, status, errorThrown) {
      console.log("Request failed: " + status);
    },
    success: function(result) {
      $('#results').html(result);
      $('#loading').hide(); //remove loading div
      //console.log(result);
    }
  });

} //close function

$('#attorney-filter-search').on('click', function(e) {
  $('#loading').show(); //show loading div
  sendFilterData();
});
