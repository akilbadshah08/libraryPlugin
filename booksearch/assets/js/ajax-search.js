jQuery(document).ready(function(){
	jQuery( "#slider-range" ).slider({
      range: true,
      min: 100,
      max: 10000,
      values: [ 100, 10000 ],
      slide: function( event, ui ) {
        jQuery( ".min-price" ).val(ui.values[0] );
        jQuery( ".max-price" ).val(ui.values[1] );
      }
    });
    jQuery( ".min-price" ).val( jQuery( "#slider-range" ).slider( "values",0 ) );
    jQuery( ".max-price" ).val( jQuery( "#slider-range" ).slider( "values",1 ) );
	jQuery('.book-search-form').submit(function (e) {
        e.preventDefault();
		jQuery.ajax({
		  method: "POST",
		  url:   jQuery('.admin-ajax').val(),
		  data: { "action": "book_search",'serialize_data': jQuery('.book-search-form').serialize()}
		}).done(function( result ) {
		    jQuery('.search-result').html(result);
		  });

	})
})