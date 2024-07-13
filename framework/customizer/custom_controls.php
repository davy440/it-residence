<?php
/**
 *  Custom Controls for Customizer
 *
 *  @package IT_Residence
 */

if ( class_exists('WP_Customize_Control') ) {

    class itre_Range_Value_Control extends WP_Customize_Control {
  	public $type = 'itre-range-value';

  	/**
  	 * Render the control's content.
  	 *
  	 * @author soderlind
  	 * @version 1.2.0
  	 */
  	public function render_content() {
  		?>
  		<label>
  			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
  			<div class="range-slider"  style="width:100%; display:flex;flex-direction: row;justify-content: flex-start;">
  				<span  style="width:100%; flex: 1 0 0; vertical-align: middle;"><input class="range-slider__range" type="range" value="<?php echo esc_attr( $this->value() ); ?>"
  																																				  <?php
  																																					$this->input_attrs();
  																																					$this->link();
  																																					?>
  				>
  				<span class="range-slider__value">0</span></span>
  			</div>
  			<?php if ( ! empty( $this->description ) ) : ?>
  			<span class="description customize-control-description"><?php echo esc_html( $this->description ); ?></span>
  			<?php endif; ?>
  		</label>
  		<?php
  	}

  	/**
  	 * Plugin / theme agnostic path to URL
  	 *
  	 * @see https://wordpress.stackexchange.com/a/264870/14546
  	 * @param string $path  file path
  	 * @return string       URL
  	 */
  	private function abs_path_to_url( $path = '' ) {
  		$url = str_replace(
  			wp_normalize_path( untrailingslashit( ABSPATH ) ),
  			home_url(),
  			wp_normalize_path( $path )
  		);
  		return esc_url_raw( $url );
  	}
  }

  class itre_WP_Customize_Category_Control extends WP_Customize_Control {
        /**
         * Render the control's content.
         */
        public function render_content() {
            $dropdown = wp_dropdown_categories(
                array(
                    'name'              => '_customize-dropdown-categories-' . $this->id,
                    'echo'              => 0,
                    'show_option_none'  => __( 'All', 'it-residence' ),
                    'option_none_value' => '0',
                    'selected'          => $this->value(),
                )
            );

            $dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

            printf(
                '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
                esc_html($this->label),
                $dropdown
            );
        }
    }

    class itre_Image_Radio_Control extends WP_Customize_Control {

    	  public $type = "itre-image-radio";

    	  public function render_content() {
     		?>
    			<div class="image_radio_button_control">
    				<?php if( !empty( $this->label ) ) { ?>
    					<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
    				<?php } ?>
    				<?php if( !empty( $this->description ) ) { ?>
    					<span class="customize-control-description"><?php echo esc_html( $this->description ); ?></span>
    				<?php } ?>
                    <div class="choices">
    				<?php foreach ( $this->choices as $key => $value ) { ?>
    					<label class="radio-button-label">
    						<input type="radio" name="<?php echo esc_attr( $this->id ); ?>" value="<?php echo esc_attr( $key ); ?>" <?php $this->link(); ?> <?php checked( esc_attr( $key ), $this->value() ); ?>/>
    						<img src="<?php echo esc_attr( $value['image'] ); ?>" alt="<?php echo esc_attr( $value['name'] ); ?>" title="<?php echo esc_attr( $value['name'] ); ?>" />
    					</label>
    				<?php	} ?>
                    </div>
    			</div>
     		<?php
     		}
      }

      class ITRE_Custom_Button_Control extends WP_Customize_Control {

	    public $type = "itre-button";

	    public function render_content() {
		    ?>
		    <label>
		    	<div id="<?php echo $this->id ?>">
			    	<?php if ( $this->description ) : ?>
			    		<p><?php echo $this->description ?></p>
			    	<?php endif; ?>

		    		<button type="button" class="button button-primary" tabindex="0"><?php echo $this->label ?></a>
		    	</div>
		    </label>
		    <?php
	    }
    }

    class itre_Google_Font_Dropdown_Custom_Control extends WP_Customize_Control {

        public $type             = 'itre-gfonts';
	    private $fonts			 = false;
	    private $fontValue		 = '';
        private $catValue        = '';
	    private $weightValue	 = '';

	    public function __construct( $manager, $id, $args = array(), $options = array() )
	    {
	        $this->fonts 		=	ITRE_Google_Fonts::itre_get_fonts( 50 );

	        parent::__construct( $manager, $id, $args );
	    }

	    public function render_content() {

		    if ( !empty( $this->fonts ) ) {

			    $this->render_fonts();
			    $this->render_weights();
                $this->render_category();

		    }
	    }

	    /**
	     * Render the content of the category dropdown
	     *
	     * @return HTML
	     */
	    protected function render_fonts()  {

	        ?>
            <label>
                <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>

                <select id="<?php echo $this->input_attrs['font_id'] ?>" <?php $this->link('font'); ?>>
                    <?php
					echo '<optgroup label="Default Fonts"><option value="League Spartan"' . selected($this->value('font'), "League Spartan", false) . '>League Spartan</option></optgroup>';

						echo '<optgroup label="Other Fonts">';
                        foreach ( $this->fonts as $k => $v ) {
                            printf( '<option value="%2$s" %1$s>%2$s</option>', selected($this->value('font'), $k, false), $k );
                        }
						echo '</optgroup>';
                    ?>
                </select>
            </label>
            <?php
	    }


	    protected function render_weights() {
		    ?>
		   <h4>Weight</h4>

		   <?php
			$font_weights = ['300', 'regular', '500', '600', '700', '800', '900'];
			
			// By any chance if the fetched fonts don't contain the selected font, revert to default font
			if ( !in_array( $this->value('font'), array_keys( $this->fonts ) ) ) {
				$selectedFont = $this->value('font');
				$selectedFont = str_replace(' ', '+', $selectedFont);
				$url = "https://www.googleapis.com/webfonts/v1/webfonts?key=AIzaSyA9-9K8wV9KWKWY84Sp5TLSS7p9GguLRh4&family={$selectedFont}&capability=WOFF2";
				$content = wp_remote_get( $url, array( 'sslverify' => false ) );
				$fileDir = ITRE_PATH . 'assets/cache/fontFiles/';
				$contentBody = json_decode($content['body'])->items;
			}

			if (!empty($this->fonts[$this->value('font')])) {
				$this->weightValue = array_intersect( $this->fonts[ $this->value('font')]['variants'], $font_weights );
			} else {
				// In this case, our font is not in the list. This could be due to updating
				// after a long time and the selected font is out of the fetched fonts list.
				// Since the fonts are fetched on the basis of popularity, there's a chance that
				// overtime, the the font got behind. Here we make a remote request to Google Fonts API to
				// get the font info.
				
				$this->weightValue = ['400', '700'];
			}
			
			?>
			<select id="<?php echo $this->input_attrs['weight_id'] ?>" <?php $this->link('weight'); ?>>
                <?php
                    foreach ( $this->weightValue as $weight ) {
						
	                    if ( $weight == 'regular' ) {
		                    $weight = '400';
	                    }

                        printf( '<option value="%2$s" %1$s>%2$s</option>', selected($this->value('weight'), $weight, false), $weight );
                    }
                ?>
            </select>
		<?php
	    }

        protected function render_category() {
            ?>

            <input type="hidden" id="<?php echo $this->input_attrs['cat_id']; ?>" value="<?php echo $this->value('category') ?>" <?php echo $this->link('category'); ?> />

            <?php
        }
	}

    class itre_Separator_Control extends WP_Customize_Control {

	    public $type = "itre-separator";

	    public function render_content() { ?>
		    <hr>
		<?php
		}
    }

    class itre_Custom_Link_Control extends WP_Customize_Control {

		/**
		 * Type
		 *
		 * @var string
		 */
	    public $type = "itre-link";

	    public function render_content() {
		    ?>
		    <label>
		    	<div id="<?php echo $this->id ?>" class="itre-theme-link">
			    	<p><?php echo $this->description ?></p>
		    		<a href="<?php echo $this->input_attrs['url'] ?>" class="button button-primary widefat" target="_blank"><?php echo $this->label ?></a>
		    	</div>
		    </label>
		    <?php
	    }
    }
}

if ( class_exists('WP_Customize_Color_Control') ) {
    class itre_ColorAlpha extends WP_Customize_Color_Control {

    	/**
    	 * Type.
    	 *
    	 * @access public
    	 * @since 1.0.0
    	 * @var string
    	 */
    	public $type = 'color-alpha';

    	/**
    	 * Enqueue scripts/styles for the color picker.
    	 *
    	 * @access public
    	 * @since 1.0.0
    	 * @return void
    	 */
    	public function enqueue() {
    		$control_root_url = str_replace(
    			wp_normalize_path( untrailingslashit( WP_CONTENT_DIR ) ),
    			untrailingslashit( content_url() ),
    			ITRE_PATH
    		);

    		/**
    		 * Filters the URL for the scripts.
    		 *
    		 * @since 1.0.0
    		 * @param string $control_root_url The URL to the root folder of the package.
    		 * @return string
    		 */
    		$control_root_url = apply_filters( 'itre_color_picker_alpha_url', $control_root_url );

    		wp_enqueue_script(
    			'itre-control-color-picker-alpha',
    			$control_root_url . '/assets/js/resources/color-alpha.min.js',
    			// We're including wp-color-picker for localized strings, nothing more.
    			[ 'customize-controls', 'wp-element', 'jquery', 'customize-base', 'wp-color-picker' ], // phpcs:ignore Generic.Arrays.DisallowShortArraySyntax
    			ITRE_VERSION,
    			true
    		);
    	}

    	/**
    	 * Refresh the parameters passed to the JavaScript via JSON.
    	 *
    	 * @since 3.4.0
    	 * @uses WP_Customize_Control::to_json()
    	 */
    	public function to_json() {
    		parent::to_json();
    		$this->json['choices'] = $this->choices;
    	}

    	/**
    	 * Empty JS template.
    	 *
    	 * @access public
    	 * @since 1.0.0
    	 * @return void
    	 */
    	public function content_template() {}
    }
}
