<?php get_header(); ?>

<?php $post = get_post(); ?>

<p><?php echo $post->post_title; ?></p>
<p><?php echo $post->post_content; ?></p>
<?php
  echo $post->post_content;
  if ( has_blocks( $post->post_content ) ) {
      $blocks = parse_blocks( $post->post_content );

      if ( isset($blocks[0]->blockName) && $blocks[0]->blockName === 'core/heading' ) {
      }
  }
?>

<?php get_footer(); ?>
