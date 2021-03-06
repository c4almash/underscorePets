<?php
/**
 * Custom options for this theme.
 *
 *
 * @package Underscore_Pets
 */
function cd_add_submenu() {
		add_submenu_page( 'themes.php', 'Options Page', 'Theme Options', 'manage_options', 'theme_options', 'my_theme_options_page');
	}
add_action( 'admin_menu', 'cd_add_submenu' );
	

function cd_settings_init() { 
	register_setting( 'theme_options', 'cd_options_settings' );
	
	add_settings_section(
		'cd_options_page_section', 
		'Post Category Selection for template', 
		'cd_options_page_section_callback', 
		'theme_options'
	);
	
	function cd_options_page_section_callback() { 
		echo 'Use the tools below to set the post category that you would want to display. Only for New Page Template. You can change Template Page in Dashboard > Pages';
	}

	add_settings_field( 
		'cd_text_field', 
		'Enter the name of category', 
		'cd_text_field_render', 
		'theme_options', 
		'cd_options_page_section' 
	);


	

	


	function cd_text_field_render() { 
		$options = get_option( 'cd_options_settings' );
		?>
		<input type="text" name="cd_options_settings[cd_text_field]" value="<?php if (isset($options['cd_text_field'])) echo $options['cd_text_field']; ?>" />
		<?php
	}
	
	function cd_checkbox_field_render() { 
		$options = get_option( 'cd_options_settings' );
	?>
		<input type="checkbox" name="cd_options_settings[cd_checkbox_field]" <?php if (isset($options['cd_checkbox_field'])) checked( 'on', ($options['cd_checkbox_field']) ) ; ?> value="on" />
		<label>Turn it On</label> 
		<?php	
	}
	
	function cd_radio_field_render() { 
		$options = get_option( 'cd_options_settings' );
		?>
		<input type="radio" name="cd_options_settings[cd_radio_field]" <?php if (isset($options['cd_radio_field'])) checked( $options['cd_radio_field'], 1 ); ?> value="1" /> <label>4</label><br />
		<input type="radio" name="cd_options_settings[cd_radio_field]" <?php if (isset($options['cd_radio_field'])) checked( $options['cd_radio_field'], 2 ); ?> value="2" /> <label>6</label><br />
		<input type="radio" name="cd_options_settings[cd_radio_field]" <?php if (isset($options['cd_radio_field'])) checked( $options['cd_radio_field'], 3 ); ?> value="3" /> <label>8</label>
		<?php
	}
	
	function cd_textarea_field_render() { 
		$options = get_option( 'cd_options_settings' );
		?>
		<textarea cols="40" rows="5" name="cd_options_settings[cd_textarea_field]"><?php if (isset($options['cd_textarea_field'])) echo $options['cd_textarea_field']; ?></textarea>
		<?php
	}

	function cd_select_field_render() { 
		$options = get_option( 'cd_options_settings' );
		?>
		<select name="cd_options_settings[cd_select_field]">
			<option value="1" <?php if (isset($options['cd_select_field'])) selected( $options['cd_select_field'], 1 ); ?>>Option 1</option>
			<option value="2" <?php if (isset($options['cd_select_field'])) selected( $options['cd_select_field'], 2 ); ?>>Option 2</option>
		</select>
	<?php
	}
	
	function my_theme_options_page(){ 
		?>
		<form action="options.php" method="post">
			<h2>Theme options for underscorePets Theme</h2>
			<?php
			settings_fields( 'theme_options' );
			do_settings_sections( 'theme_options' );
			submit_button();
			?>
		</form>
		<?php
	}

}

add_action( 'admin_init', 'cd_settings_init' );

