<?php
  $show_profile_image = get_option('show_profile_image');
  $show_profile_imagesize = get_option('show_profile_imagesize');
  if (empty($show_profile_imagesize)) $show_profile_imagesize = 80;
  if (empty($show_profile_image)) :
    $show_profile_image = get_avatar(get_the_author_id(), $show_profile_imagesize);
  else :
    $show_profile_image = '<img src="'.$show_profile_image.'" alt="'.get_the_author().'" width="'.$show_profile_imagesize.'" height="'.$show_profile_imagesize.'">';
  endif;
  $profile = '<aside id="Profile">';
  $profile .= '<div id="AuthorImage">'.$show_profile_image.'</div>';
  $profile .= '<div id="Author">'.get_the_author().'</div>';
  $profile .= '<div id="UserDescription">'.get_the_author_meta('user_description').'</div>';
  $profile .= '</aside>';
  echo $profile;
?>