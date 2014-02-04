<?php
/**
 * The template for displaying the footer.
 *
 */
?>
</main>
<!-- #main .site-main -->

<footer id="colophon" class="site-footer" role="contentinfo">
  <?php get_sidebar('footer'); ?>
  <div id="bottom-bar">
    <div class="inner">
      <div class="footer-text"> <?php echo get_theme_mod( 'footer_text', emphaino_default_settings('footer_text') ) ?> </div>
      <div class="site-info">Powered by <a href="#">Digital Library Technology Services</a></div>
    </div>
    <!-- .inner --> 
   </div>
  <!-- #bottom-bar --> 
</footer>
<!-- #colophon .site-footer -->

</div>
<!-- #page .hfeed .site -->

<?php if( get_theme_mod( 'disable_backtotop' ) != 'on' ): ?>
<a href="#" class="back-to-top icon-up-open-mini">&uarr;</a>
<?php endif; ?>
<?php wp_footer(); ?>
</body></html>