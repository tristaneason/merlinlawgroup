<?php
$site_footer_left = get_field('site_footer_left', 'option');
$site_footer_right_top = get_field('site_footer_right_top', 'option');
$site_footer_right_bottom = get_field('site_footer_right_bottom', 'option');
$site_footer_right_bottom_right = get_field('site_footer_right_bottom_right', 'option');
$site_twitter_url = get_field('site_twitter_url', 'option');
$site_linkedin_url = get_field('site_linkedin_url', 'option');
$site_facebook_url = get_field('site_facebook_url', 'option');
?>
</div><!-- .site-content -->

<footer class="footer">

  <div class="container-fluid">
    <div class="row">
      <div class="col-xs-12 col-sm-5 col-md-5 footer-left footer-pad bg-white">
        <?php echo $site_footer_left; ?>
        <a class="btn secondary block-mobile" href="<?php echo home_url(); ?>/attorneys">View Attorney Directory</a>
      </div>
      <div class="col-xs-12 col-sm-7 col-md-7 footer-right footer-pad bg-primary">
        <span class="footer-follow h6">Follow Us</span>
        <ul class="footer-socials">
          <li><a href="<?php echo $site_twitter_url; ?>" target="_blank">
            <svg class="svg-icon svg-social tw" viewBox="0 0 24 20" xmlns="http://www.w3.org/2000/svg">
              <path d="M24 2.557c-.883.392-1.832.656-2.828.775 1.017-.61 1.798-1.574 2.165-2.724-.95.564-2.005.974-3.127 1.195C19.313.846 18.032.248 16.616.248c-3.18 0-5.515 2.966-4.797 6.045C7.727 6.088 4.1 4.128 1.67 1.15.38 3.36 1.003 6.256 3.195 7.722c-.806-.026-1.566-.247-2.23-.616-.053 2.28 1.582 4.415 3.95 4.89-.693.188-1.452.232-2.224.084.626 1.957 2.444 3.38 4.6 3.42-2.07 1.623-4.678 2.348-7.29 2.04 2.18 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.72 13.995-14.646.962-.695 1.797-1.562 2.457-2.55z" fill-rule="nonzero" fill="currentColor"/>
            </svg>
          </a></li><!--/.tw-->
          <li><a href="<?php echo $site_linkedin_url; ?>" target="_blank">
            <svg class="svg-icon svg-social lk" viewBox="0 0 79 76" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.392 8.26c0 4.564-3.653 8.262-8.163 8.262S.065 12.824.065 8.262C.066 3.7 3.72 0 8.23 0c4.51 0 8.162 3.7 8.162 8.26zm.066 14.87H0V76h16.458V23.13zm26.274 0H26.38V76h16.356V48.247c0-15.432 19.845-16.694 19.845 0V76H79V42.524c0-26.04-29.368-25.09-36.268-12.273v-7.12z" fill-rule="nonzero" fill="currentColor"/>
            </svg>
          </a></li><!--/.lk-->
          <li><a href="<?php echo $site_facebook_url; ?>" target="_blank">
            <svg class="svg-icon svg-social fb" viewBox="0 0 12 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M3 8H0v4h3v12h5V12h3.642L12 8H8V6.333C8 5.378 8.192 5 9.115 5H12V0H8.192C4.596 0 3 1.583 3 4.615V8z" fill-rule="nonzero" fill="currentColor"/>
            </svg>
          </a></li><!--/.fb-->
        </ul><!--/.footer-socials-->
        <div class="row">
          <div class="col-xs-12 footer-right-top">
            <?php echo $site_footer_right_top; ?>
          </div><!--/.col-->
        </div><!--/.row-->
        <hr class="hr" />
        <div class="row">
          <div class="col-xs-12 col-sm-8 footer-right-bottom">
            <?php echo $site_footer_right_bottom; ?>
          </div><!--/.col-->
          <div class="col-xs-12 col-sm-4 footer-right-bottom-right">
            <?php echo $site_footer_right_bottom_right; ?>
          </div><!--/.col-->
                  </div><!--/.row-->
      </div><!--/.col-->
    </div><!--/.row-->
  </div><!--/.container-fluid-->

</footer><!--/.footer-->


<script>
var template_dir = "<?php echo get_stylesheet_directory_uri(); ?>";
</script>

<?php wp_footer(); ?>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/59b3fd234854b82732fef0f9/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html>
