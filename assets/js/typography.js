/**
 *	Typography Controls
 */

( function() {
	wp.customize.bind('ready', function() {

		var weights = [ '300', 'regular', '500', '600', '700', '800', '900'];

		var newWeights

		const weightControl = ( element ) => {
			wp.customize( 'itre_gfonts_' + element, function( font ) {

				font.bind( function( to ) {

					newWeights = itre[ font.get() ]['variants'].filter( value => weights.includes( value ) )

					var weightDropdown = jQuery('#customize-control-itre_gweights_' + element )

					weightDropdown.empty()

					newWeights.forEach( ( weight, index, array ) => {
						if ( weight == 'regular' ) {
							array[ index ]	= '400'
						}
					})

					newWeights.forEach( weight => {
						weightDropdown.append( '<option value=' + weight + '>' + weight + '</option>' );
					})

					var catField = jQuery(`#customize-control-itre_gcat_${element}`)

					catField.val( itre[ font.get()]['category'] ).change()

				})

			} )
		}
		weightControl( 'heading' )
		weightControl( 'body' )
	})
}
)()
