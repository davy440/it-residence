<?php

/**
 * Section with Button
 */

if ( class_exists( 'WP_Customize_Section' ) ) {

	class itre_Button extends WP_Customize_Section {

		/**
		 * The type of customize section being rendered.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $type = 'itre-button';

		/**
		 * Custom button text to output.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $button_text = '';

		/**
		 * Custom button URL to output.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $button_url = '';

		public $demo_text = '';

		public $demo_url = '';

		/**
		 * Default priority of the section.
		 *
		 * @since  1.0.0
		 * @access public
		 * @var    string
		 */
		public $priority = 999;

		/**
		 * Add custom parameters to pass to the JS via JSON.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return array
		 */
		public function json() {

			$json       = parent::json();
			$theme      = wp_get_theme();
			$button_url = $this->button_url;

			// Fall back to the `Theme URI` defined in `style.css`.
			if ( ! $button_url && $theme->get( 'ThemeURI' ) ) {

				$button_url = $theme->get( 'ThemeURI' );

			// Fall back to the `Author URI` defined in `style.css`.
			} elseif ( ! $button_url && $theme->get( 'AuthorURI' ) ) {

				$button_url = $theme->get( 'AuthorURI' );
			}

			$json['button_text'] = $this->button_text ? $this->button_text : $theme->get( 'Name' );
			$json['button_url']  = esc_url( $button_url );
			$json['demo_text']	 = $this->demo_text ? $this->demo_text : 'Demo';
			$json['demo_url']	 = $this->demo_url ? $this->demo_url : '#';

			return $json;
		}

		/**
		 * Outputs the Underscore.js template.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		protected function render_template() { ?>

			<li id="accordion-section-{{ data.id }}" class="accordion-section control-section control-section-{{ data.type }} cannot-expand">

				<h3 class="accordion-section-title">
					<# if ( data.demo_text && data.demo_url ) { #>
						<a href="{{ data.demo_url }}" class="button button-primary" target="_blank" rel="external nofollow noopener noreferrer">{{ data.demo_text }}</a>
					<# } #>

					<# if ( data.button_text && data.button_url ) { #>
						<a href="{{ data.button_url }}" class="button button-primary" target="_blank" rel="external nofollow noopener noreferrer">{{ data.button_text }}</a>
					<# } #>
				</h3>
			</li>
		<?php }
	}
}


add_action( 'customize_register', function( $manager ) {

	$manager->register_section_type( itre_Button::class );

	$manager->add_section(
		new itre_Button( $manager, 'itre-pro', array(
			'title'          => __( 'Want more Features?', 'it-residence' ),
			'priority'       => 1,
			'button_text'    => __( 'Get Pro Version', 'it-residence' ),
			'button_url'     => 'https://indithemes.com/product/it-residence-pro/',
			'demo_url'       =>	'https://demo.indithemes.com/it-residence'
		) )
	);

} );
