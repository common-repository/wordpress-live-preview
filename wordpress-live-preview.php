<?php
/*
Plugin Name: WordPress Live Preview
Plugin URI: http://rohankapoor.com/projects/plugins/wordpress-live-preview/
Description: Allows You to View Any Page From Within the WordPress Admin Section.
Version: 1.3
Author: Rohan Kapoor
Author URI: http://rohankapoor.com
*/
?>
<?php
/*  Copyright 2011  Rohan Kapoor  (email : rohan@rohankapoor.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation; either version 2 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/
?>
<?php
add_action('admin_menu', 'silpstream_live_preview_add_option_page');
function silpstream_live_preview_add_option_page() {
	if ( function_exists('add_management_page') ) {
		 add_management_page('WordPress Live Preview', 'WordPress Live Preview', 8, __FILE__, 'silpstream_live_preview_option_page');
	}
}

function silpstream_live_preview_option_page() {
?>
<?php
// variables for the field and option names 
    $opt_name = 'preview_location';
    $preview_uri_changed = 'mt_submit_hidden';
    $preview_uri = 'preview_location';

    // Read in existing option value from database
    $opt_val = get_option( $opt_name );

    // See if the user has posted us some information
    // If they did, this hidden field will be set to 'Y'
    if( $_POST[ $preview_uri_changed ] == 'Y' ) {
        // Read their posted value
        $opt_val = $_POST[ $preview_uri ];

        // Save the posted value in the database
        update_option( $preview_uri, $opt_val );

        // Put an options updated message on the screen

?>
<div class="updated"><p><strong><?php _e('Options saved.', 'wordpress_live_preview' ); ?></strong></p></div>
<?php
    }
	
    // Now display the options editing screen
    echo '<div class="wrap">';
    // header
    echo "<h2>" . __( 'WordPress Live Preview', 'wordpress_live_preview' ) . "</h2>";
    // options form
?>
<p>Help and Support for this plugin is available at <a href="http://rohankapoor.com/projects/plugins/">WordPress Plugins by Rohan Kapoor!</a></p>
<p>If you found this plugin helpful please consider a <a href="http://rohan-kapoor.com/donate/">donation</a>. Thanks in advance!</p>
<p>Please Enter the Full Path to the Page You Want to View!</p>
<p><br></p>



<form name="live_preview" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
<input type="hidden" name="<?php echo $preview_uri_changed; ?>" value="Y">

<p><?php _e("Full Path to Page Requested:", 'new_live_preview' ); ?> 
<input type="text" name="<?php echo $preview_uri; ?>" value="<?php echo $opt_val; ?>" size="40">
<class="submit">
<input type="submit" name="Submit" value="<?php _e('Update Options', 'wordpress_live_preview' ) ?>" />
</p>

</form>
</div>
<hr />
<br>
<iframe width="100%" height="1250" src="<?php echo $opt_val; ?>"></iframe>
<?php
}
?>