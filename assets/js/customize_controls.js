//JS for Admin Area

(function() {
    // Slider Control
	wp.customize.bind('ready', function() {
        rangeSlider();
    });

    var rangeSlider = function() {
        var slider = jQuery('.range-slider'),
            range = jQuery('.range-slider__range'),
            value = jQuery('.range-slider__value')

        slider.each(function() {

            value.each(function() {
                var value = jQuery(this).prev().attr('value');
				var suffix = (jQuery(this).prev().attr('suffix')) ? jQuery(this).prev().attr('suffix') : '';
                jQuery(this).html(value + suffix);
            });

            range.on('input', function() {
				var suffix = (jQuery(this).attr('suffix')) ? jQuery(this).attr('suffix') : '';
                jQuery(this).next(value).html(this.value + suffix );
            });

        });
    };

})( jQuery );

wp.customize.sectionConstructor['itre-button'] = wp.customize.Section.extend( {

	// No events for this type of section.
	attachEvents: () => {},

	// Always make the section active.
	isContextuallyActive: () => {
		return true;
	}
} );
