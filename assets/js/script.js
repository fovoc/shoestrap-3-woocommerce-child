var $j = jQuery.noConflict();
// Using jQuery.noConflict
$j(window).load(function(){
	
	if ( shoestrap_script_vars.is_woo == 1 ) {
		//ISOTOPE
		var $container = $j(".products");
		var $default_name_label   = $j(".btn-name").text();
		var $default_price_label  = $j(".btn-price").text();

		if ( shoestrap_script_vars.masonry != 1 )
			$j(".products .product").equalHeights();

  	if ( shoestrap_script_vars.sort_filters == 1 || shoestrap_script_vars.masonry == 1 ) {
    	$container.isotope({
  			layoutMode: "sloppyMasonry",
  			itemSelector: ".products .product",
  			animationEngine: "best-available",
  			// get sort data-filter
  			getSortData : {
  				name : function ( $elem ) {
  					return $elem.find(".product-title a").text();
  				},
  				price : function ( $elem ) {
  					return parseInt( $elem.find(".plain-price").text(), 10 );
  				}
  			}
  		});
    }

		// Multi-select filters
		if ( shoestrap_script_vars.sort_filters == 1 ) {
			$j(".filter select").multiselect({
				enableCaseInsensitiveFiltering: true,
				dropRight: true,
				nonSelectedText: shoestrap_script_vars.no_filters
			});
		
			var $checkboxes = $j(".multiselect-container li a");

			$checkboxes.click(function(){
				var filters = [];
				var active = $j(".filter select").val();
				if ( active ) 
					filters.push(active);
				filters = filters.join(", ");
				$container.isotope({ filter: filters });
				if ( $j(".filter .multiselect").text() != "No filters " ) 
					$j(".filter .multiselect").removeClass("btn-default").addClass("btn-primary");
				else 
					$j(".filter .multiselect").removeClass("btn-primary").addClass("btn-default"); 
			});

			// Sort ASC
			$j(".sort .true a").click(function(){
				// get href attribute, minus the "#"
				var sortName = $j(this).attr("href").slice(1);
				var order = $j(this).text();
				if ( sortName == "name" ) {
					$j(".btn-name .name").html($default_name_label).append(" ").append(order);
					$j(".btn-price .name").html( $default_price_label );
					$j(".btn-name").addClass("btn-primary");
					$j(".btn-price").removeClass("btn-primary");
				}
				if ( sortName == "price" ) {
					$j(".btn-price .name").html( $default_price_label ).append(" ").append(order);
					$j(".btn-name .name").html( $default_name_label );
					$j(".btn-price").addClass("btn-primary");
					$j(".btn-name").removeClass("btn-primary");
				}
				$container.isotope({ sortBy : sortName, sortAscending : true });
				return false;
			});

			// Sort DSC
			$j(".sort .false a").click(function(){
				// get href attribute, minus the "#"
				var sortName = $j(this).attr("href").slice(1);
				var order = $j(this).text();
				if ( sortName == "name" ) {
					$j(".btn-name .name").html( $default_name_label ).append(" ").append(order);
					$j(".btn-price .name").html( $default_price_label );
					$j(".btn-name").addClass("btn-primary");
					$j(".btn-price").removeClass("btn-primary");
				}
				if ( sortName == "price" ) {
					$j(".btn-price .name").html( $default_price_label ).append(" ").append(order);
					$j(".btn-name .name").html( $default_name_label );
					$j(".btn-price").addClass("btn-primary");
					$j(".btn-name").removeClass("btn-primary");
				}
				$container.isotope({ sortBy : sortName, sortAscending : false });
				return false;
			});

			// Sort default
			$j(".sort .default a").click(function(){
				$container.isotope({ sortBy : "original-order" });
				$j(".btn-price .name").html( $default_price_label );
				$j(".btn-name .name").html( $default_name_label );
				$j(".btn-price").removeClass("btn-primary");
				$j(".btn-name").removeClass("btn-primary");
				return false;
			});
		}

		//INFINITE SCROLL
		if ( shoestrap_script_vars.infinitescroll == 1 ) {
			var $msgText = shoestrap_script_vars.msgText;
			var $finishedMsg = shoestrap_script_vars.finishedMsg;

			$container.infinitescroll({
				navSelector  : ".pagination",
				nextSelector : ".pagination li a.next",
				itemSelector : ".products .product",
				loading: {
					msgText: $msgText,
					finishedMsg: $finishedMsg
				}
				// trigger Isotope as a callback
				},function( newElements ) {
						// hide new items while they are loading
						var newElems = $j( newElements ).css({ opacity: 0 });
						// ensure that images load before all
						$j(newElems).imagesLoaded(function(){
						// show elems now they are ready
						$j(newElems).animate({ opacity: 1 });

						if ( shoestrap_script_vars.masonry != 1 ) 
							$j(".products .product").equalHeights();
						
						$container.isotope( "insert", $j(newElems), true );
						});
					});
		}
	}
});