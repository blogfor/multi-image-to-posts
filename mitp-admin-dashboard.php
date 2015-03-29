
<?php
global $wpdb;
if (isset($_POST) && isset($_POST['ThumbnailWidth'])) {

    $thumb_width = (int) trim($_POST['ThumbnailWidth']);
    $thumb_height = (int) trim($_POST['ThumbnailHeight']);
    $limit = (int) trim($_POST['ImageUploadLimit']);

    //INSERT THUMBNAIL WIDTH
    update_option('mitp_width', $thumb_width);
    
    //INSERT THUMBNAIL HEIGHT
    update_option('mitp_height', $thumb_height);
    
    //INSERT THUMBNAIL LIMIT
    update_option('mitp_limit', $limit);
    
    $msg="Settings has been updated";
}
?>
 <?php
 if($_POST['SetSettings'])
 {
     
     
     
         update_option('mitp_post_type',  serialize($_POST['chkPost']));
     
          $msg1="Settings has been updated";
     
 }
 
 ?> <?php
 if($_POST['SetSettings'])
 {
     
     
     
         update_option('mitp_post_type',  serialize($_POST['chkPost']));
     
          $msg1="Settings has been updated";
     
 }
 
 ?>
<style>
    .form{ 
        max-width: 70%; 
        min-width: 70%; 
        border-width: 3px; 
        border-color: #4D3C41; 
        border-radius: 4px; 
        border-style: dotted; 
        color: #222222; 
        font-size: 16px; 
        margin: 6px; 
        background-color: #FFFFFF; 
        padding: 31px; 
    } 
    .content{ 
        margin: 7px; 
    } 
    .form label{ 
        color: #222222; 
        font-size: 14px; 
        display: block; 
    } 
    .form input[type=radio], input[type=checkbox]{ 
        margin: 10px; 
        width: 13px; 
    } 
    .form div{ 
        display: block; 
    } 
    .form input, form textarea, form select{ 
        border-width: 2px; 
        border-style: groove; 
        border-color: #666666; 
        border-radius: 8px; 
        padding: 3px; 
        width: 100%; 
    } 
    .form, .form h1, .form h2{ 
        font-family: 'Arial'; 
    } 
    .form h1{ 
        font-size: 29px; 
        color: #607A75; 
        padding: 0px; 
        margin: 0px; 
        margin-bottom: 10px; 
        border-bottom-style: dotted; 
        border-bottom-color: #CCCCCC; 
        border-bottom-width: 2px; 
        border-radius: 0px; 
        background-color: #FFFFFF; 
    } 
    .intro{ 
        margin-bottom: 10px; 
    } 
    .clear{ 
        clear: both; 
    } 
    .form textarea{ 
        height: 50px; 
        width: 100%; 
    } 
    .form input[type=submit]{ 
        width: 22%; 
        background-color: #CCCCCC; 
        color: #222222; 
    } 
    .field{ 
        margin-bottom: 21px; 
    } 
      .form input[type=checkbox]{
          border-radius: 2px !important;
        width: 2% !important;
        }
</style>
<form id="form" class="form" name="form" action="" method="post" accept-charset="UTF-8">
    <h1>Multi Image to Posts</h1>
    
    <div class="content">
        <?php if(isset($msg)) echo '<p style="font-size:13px;color:green;font-weight:700;">'.$msg.'</p>'; ?>
        
        <div class="intro"><p>Choose posts type , and image upload limit from here .</p></div>
        <div id="section0" >
            <div class="field"><label for="ThumbnailWidth">Thumbnail Width</label><input type="text" id="ThumbnailWidth" name="ThumbnailWidth" required autofocus  value="<?php echo get_option('mitp_width');?>" /></div>
            <div class="field"><label for="ThumbnailHeight">Thumbnail Height</label><input type="text" id="ThumbnailHeight" name="ThumbnailHeight" required value="<?php echo get_option('mitp_height');?>" /></div>
            <div class="field"><label for="ImageUploadLimit">Image Upload Limit</label><input type="text" id="ImageUploadLimit" name="ImageUploadLimit" value="<?php echo get_option('mitp_limit');?>" /></div>
            <div class="field"><label for="SaveSettings">Save Settings</label><input type="submit" id="SaveSettings" name="SaveSettings"></div>
        </div>
    </div>
</form>

 <h2> Choose on which post type it will work !</h2>
 <form id="form2" class="form" name="form2" action="" method="post" accept-charset="UTF-8">
     <div class="content">
         <?php if(isset($msg1)) echo '<p style="font-size:13px;color:red;font-weight:700;">'.$msg1.'</p>'; ?>
 <?php 
$post_types = get_post_types( '', 'names' ); 
  $mitp_post_type=get_option('mitp_post_type');
  $unserialized_data=  unserialize($mitp_post_type);
 

foreach ( $post_types as $post_type ) {

    if($post_type !='attachment' && $post_type !='revision' && $post_type !='nav_menu_item'){
        
        if(in_array($post_type, $unserialized_data))
                $checked='checked';
            else {
                $checked='';
            }
        
        
    echo '<input type="checkbox" name="chkPost[]" value="'.$post_type.'" '.$checked.' /> &nbsp;' . $post_type . '';
    }
}
?>
         <div class="field"><input type="submit" id="SetSettings" name="SetSettings"></div>
         </div>
</form>

 