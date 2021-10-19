<?php get_header(); ?>


<div class="row">
  <div class="<?php echo ( is_active_sidebar( 'side_right' ) ) ? 'col-sm-8' : 'col-xs-12'; ?>">
    
    <?php if (have_posts()) : ?>
      <?php while ( have_posts() ) : the_post(); ?>
        <!-- свойства поста-->
        <?php $post_thumb = get_the_post_thumbnail_url( $post->ID, 'large' ); ?>
        <div class="info">
          <div class="row">
            <?php if ( $post_thumb ) echo "<div class=\"col-sm-6\"><img class=\"img-responsive\" src=\"" . $post_thumb . "\" alt=\"" . get_the_title() . "\" alt=\"" . the_title_attribute( array( 'echo' => false ) ) . "\"></div>"; ?>
            <div class="<?php echo ( $post_thumb ) ? 'col-sm-6': 'col-xs-12'; ?>">
              <dl class="dl-horizontal small">
                <dt><?php _e( 'Автор', 'events-theme' ); ?></dt>
                <dd><i class="glyphicon glyphicon-user"></i> <?php the_author(); ?></dd>
                <dt><?php _e( 'Опубліковано', 'events-theme' ); ?></dt>
                <dd><i class="glyphicon glyphicon-calendar"></i> <?php the_modified_date( 'Y/m/d' ); ?></dd>
                <dt><?php _e( 'Перегляди', 'events-theme' ); ?></dt>
                <dd><i class="glyphicon glyphicon-eye-open"></i> <?php the_post_views( $post->ID ); ?></dd>
                <dt><?php _e( 'Коментарі', 'events-theme' ); ?></dt>
                <dd><i class="glyphicon glyphicon-comment"></i> <?php comments_number( '0', '1', '%' ); ?></dd> <?php
                $tags_list = get_the_tag_list( "<ul class=\"tags__list list\"><li><i class=\"glyphicon glyphicon-tag\"></i> ", "</li><li><i class=\"glyphicon glyphicon-tag\"></i> ", "</li></ul>");
                if ( ! empty( $tags_list ) ) {
                  echo "<dt>" . __( 'Тегі', 'events-theme' ) . "</dt>";
                  echo "<dd><div class=\"tags\">" . $tags_list . "</div></dd>";
                } ?>
              </dl>
              <?php if ( has_excerpt( $post->ID ) ) echo "<div class=\"well well-sm\">" . get_the_excerpt() . "</div>"; ?>
            </div>
          </div>
        </div>
        <!-- end свойства поста-->
        <div class="content clearfix"><?php the_content(); ?></div>
      <?php endwhile; ?>
    <?php else : ?>
    <?php endif; ?>


    
    <!---->
    <nav aria-label="..." class="clearfix">
      <ul class="pager">
        <?php previous_post_link( '<li class="previous">%link</li>', '<span aria-hidden="true">&larr;</span> ' . __( 'Попередній', 'events-theme' ) ); ?>
        <?php next_post_link( '<li class="next">%link</li>', __( 'Наступній', 'events-theme' ) . ' <span aria-hidden="true">&rarr;</span>' ); ?>
      </ul>
    </nav>
    <!---->

    <!---->
    <?php if( comments_open($post->ID) ) comments_template(); ?>
    <!---->

  </div> <!-- .col- -->

<?php get_sidebar( 'right' ); ?>

</div> <!-- .row -->

<?php get_footer(); ?>