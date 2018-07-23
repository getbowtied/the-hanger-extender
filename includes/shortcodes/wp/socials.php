<?php

// [socials]

function getbowtied_shortcode_socials($atts, $content = null) {	

	extract(shortcode_atts(array(
		"align" => "left"
	), $atts));

    ob_start();
    ?>

    <ul class="shortcode_socials <?php echo esc_html($align); ?>">
        
        <?php

        if ( GBT_Opt::getOption('facebook_link')   != "" )     echo '<li><a href="' . GBT_Opt::getOption('facebook_link') . '"    target="_blank"><i class="thehanger-icons-facebook-f"></i>  <span>Facebook</span>   </a></li>';
        if ( GBT_Opt::getOption('twitter_link')    != "" )     echo '<li><a href="' . GBT_Opt::getOption('twitter_link') . '"     target="_blank"><i class="thehanger-icons-twitter"></i>     <span>Twitter</span>    </a></li>';
        if ( GBT_Opt::getOption('pinterest_link')  != "" )     echo '<li><a href="' . GBT_Opt::getOption('pinterest_link') . '"   target="_blank"><i class="thehanger-icons-pinterest"></i>   <span>Pinterest</span>  </a></li>';
        if ( GBT_Opt::getOption('linkedin_link')   != "" )     echo '<li><a href="' . GBT_Opt::getOption('linkedin_link') . '"    target="_blank"><i class="thehanger-icons-linkedin"></i>    <span>Linkedin</span>   </a></li>';
        if ( GBT_Opt::getOption('googleplus_link') != "" )     echo '<li><a href="' . GBT_Opt::getOption('googleplus_link') . '"  target="_blank"><i class="thehanger-icons-google2"></i>     <span>Googleplus</span> </a></li>';
        if ( GBT_Opt::getOption('rss_link')        != "" )     echo '<li><a href="' . GBT_Opt::getOption('rss_link') . '"         target="_blank"><i class="thehanger-icons-rss"></i>         <span>RSS</span>        </a></li>';
        if ( GBT_Opt::getOption('tumblr_link')     != "" )     echo '<li><a href="' . GBT_Opt::getOption('tumblr_link') . '"      target="_blank"><i class="thehanger-icons-tumblr"></i>      <span>Tumblr</span>     </a></li>';
        if ( GBT_Opt::getOption('instagram_link')  != "" )     echo '<li><a href="' . GBT_Opt::getOption('instagram_link') . '"   target="_blank"><i class="thehanger-icons-instagram"></i>   <span>Instagram</span>  </a></li>';
        if ( GBT_Opt::getOption('youtube_link')    != "" )     echo '<li><a href="' . GBT_Opt::getOption('youtube_link') . '"     target="_blank"><i class="thehanger-icons-youtube2"></i>    <span>Youtube</span>    </a></li>';
        if ( GBT_Opt::getOption('vimeo_link')      != "" )     echo '<li><a href="' . GBT_Opt::getOption('vimeo_link') . '"       target="_blank"><i class="thehanger-icons-vimeo"></i>       <span>Vimeo</span>      </a></li>';
        if ( GBT_Opt::getOption('behance_link')    != "" )     echo '<li><a href="' . GBT_Opt::getOption('behance_link') . '"     target="_blank"><i class="thehanger-icons-behance"></i>     <span>Behance</span>    </a></li>';
        if ( GBT_Opt::getOption('dribbble_link')   != "" )     echo '<li><a href="' . GBT_Opt::getOption('dribbble_link') . '"    target="_blank"><i class="thehanger-icons-dribbble"></i>    <span>Dribbble</span>   </a></li>';
        if ( GBT_Opt::getOption('flickr_link')     != "" )     echo '<li><a href="' . GBT_Opt::getOption('flickr_link') . '"      target="_blank"><i class="thehanger-icons-flickr"></i>      <span>Flickr</span>     </a></li>';
        if ( GBT_Opt::getOption('git_link')        != "" )     echo '<li><a href="' . GBT_Opt::getOption('git_link') . '"         target="_blank"><i class="thehanger-icons-github"></i>      <span>Github</span>     </a></li>';
        if ( GBT_Opt::getOption('skype_link')      != "" )     echo '<li><a href="' . GBT_Opt::getOption('skype_link') . '"       target="_blank"><i class="thehanger-icons-skype"></i>       <span>Skype</span>      </a></li>';
        if ( GBT_Opt::getOption('weibo_link')      != "" )     echo '<li><a href="' . GBT_Opt::getOption('weibo_link') . '"       target="_blank"><i class="thehanger-icons-sina-weibo"></i>  <span>Weibo</span>      </a></li>';
        if ( GBT_Opt::getOption('foursquare_link') != "" )     echo '<li><a href="' . GBT_Opt::getOption('foursquare_link') . '"  target="_blank"><i class="thehanger-icons-foursquare2"></i> <span>Foursquare</span> </a></li>';
        if ( GBT_Opt::getOption('soundcloud_link') != "" )     echo '<li><a href="' . GBT_Opt::getOption('soundcloud_link') . '"  target="_blank"><i class="thehanger-icons-soundcloud"></i>  <span>Soundcloud</span> </a></li>';
        if ( GBT_Opt::getOption('snapchat_link') != "" )     echo '<li><a href="' . GBT_Opt::getOption('snapchat_link') . '"  target="_blank"><i class="thehanger-icons-snapchat"></i>  <span>Snapchat</span> </a></li>';
        ?>

    </ul>
    
    <?php
    $content = ob_get_contents();
	ob_end_clean();
	return $content;
}

add_shortcode("socials", "getbowtied_shortcode_socials");