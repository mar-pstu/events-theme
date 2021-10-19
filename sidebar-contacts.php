<?php if ( is_active_sidebar( 'side_contacts' ) ) : ?>
	<div class="col-sm-5 col-sm-push-7">
	  <aside class="main__aside aside" id="contacts-aside">
	  	<?php dynamic_sidebar( 'side_contacts' ); ?>
	  </aside>
	</div>
<?php endif; ?>