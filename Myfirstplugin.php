<?php
/**
*plugin Name: My-first-plugin
*Description: This is just a basic plugin
**/

function myfirstplugin()
{
    $content = "This is a very basic plugin.";
    $content .= "<div>This is a div</div>";
    $content .= "<p>This is a paragraph</p>";
    return $content;
}
add_shortcode('plug1','myfirstplugin');

//This function is to display the content through a short code//


function myfirstplugin_admin_menu_option()
{
    add_menu_page('Header & footer Scripts','site scripts','manage_options','myfirstplugin_admin_menu','myfirstplugin_scripts_page','',200);
}


add_action('admin_menu','myfirstplugin_admin_menu_option');

//created an admin menu option//

function myfirstplugin_scripts_page()
{
    
    if(array_key_exists('submit_scripts_update',$_POST))
    {
        update_option('myfirstplugin_header_scripts',$_POST['header_scripts']);
        update_option('myfirstplugin_footer_scripts',$_POST['footer_scripts']);
        ?>
<div id="setting-error-settings-updated" class="updated_settings_error notice is-dismissible"><strong>Settings have been saved.</strong></div>
<?php
    }
    
    
    $header_scripts = get_option('myfirstplugin_header_scripts','');
    $footer_scripts = get_option('myfirstplugin_footer_scripts','');
    
    ?>
<div class="wrap">
<h2>Update scripts.</h2>
    
    <form method="post" action="">
    <label for="header_scripts">Header Scripts</label>
    <textarea name="header_scripts" class="large-text"><?php print $header_scripts; ?></textarea>
        <label for="footer_scripts">Footer Scripts</label>
    <textarea name="footer_scripts" class="large-text"><?php print $footer_scripts; ?></textarea>
        <br>
        <br>
    <input type="submit" name= "submit_scripts_update" class="button button-primary" value="UPDATE SCRIPTS">
    </form>
</div>
<?php
}


// created this function for the settings page//


function myfirstplugin_display_header_scripts()
{
    $header_scripts = get_option('myfirstplugin_header_scripts','');
    print $header_scripts;
}
add_action('wp_head','myfirstplugin_display_header_scripts');

function myfirstplugin_display_footer_scripts()
{
    $header_scripts = get_option('myfirstplugin_footer_scripts','');
    print $footer_scripts;
}
add_action('wp_footer','myfirstplugin_display_footer_scripts');


// these two functions will display the header and footer scripts which we put into wordpress admin site//



    
    
    
    
    

function form()
{
    $content = '';
    
    
    $content .= '<form method="post" action="http://localhost/wordpress/submit-page/">';
     
    $content .= '<input type="text" name="full_name" placeholder="Your Full Name" />';
    $content .= '<br/>';
    $content .= '<br/>';
    
    $content .= '<input type="text" name="email_address" placeholder="Email Address" />';
    $content .= '<br/>';
    $content .= '<br/>';
    
    $content .= '<input type="text" name="phone_number" placeholder="Mobile Number" />';
    $content .= '<br/>';
    $content .= '<br/>';
    
    $content .= '<textarea name="comments" placeholder="Give us your comments"></textarea>';
    $content .= '<br/>';
    $content .= '<br/>';
    
    $content .= '<input type="submit" name="myfirstplugin_submit_form" value="SUBMIT YOUR INFORMATION HERE">';
    $content .= '<br/>';
    
    $content .= '</form>';
    
    return $content;
}
add_shortcode('myfirstplugin_contact_form','form');



function form_capture()
{
    if(array_key_exists('myfirstplugin_submit_form',$_POST))
    {
        $to ="rohankunal9399@gmail.com";
        $subject = "Site Form Submission";
        $body = '';
        
        $body .= 'Name: '.$_POST['full_name'].' <br/>';
        $body .= 'Email: '.$_POST['email_address'].' <br/>';
        $body .= 'Phone: '.$_POST['phone_number'].' <br/>';
        $body .= 'Comments: '.$_POST['comments'].' <br/>';
        
        wp_mail ($to,$subject,$body);
    }
}
add_action('wp_head','form_capture');


?>