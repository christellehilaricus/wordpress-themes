<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Twenty Sixteen 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
                <?php
                    if( shortcode_exists( 'wp_breadcrumb_single' ) ) {
                        do_shortcode( '[wp_breadcrumb_single id=' . get_the_ID() . ']' );
                    }
                ?>

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->

	<?php twentysixteen_excerpt(); ?>

	<?php twentysixteen_post_thumbnail(); ?>

	<div class="entry-content">
		<?php
			the_content();
		?>
		<h2>À propos de cet album</h2>
		<table>
			<?php
			$album_id = get_the_ID();

			$author = get_album_author( $album_id );
			$author_second = get_album_author_second( $album_id );

			if ( $author ) {
			?>
		        <tr>
			        <td>
					<b>Artiste<?php if ( $author_second ) { echo 's'; } ?></b>
			        </td>
			        <td>
					<?php
					echo '<a href="' . get_term_link( $author->term_id ). '">' . $author->name . '</a>';

					if ( $author_second ) {
						echo ', <a href="' . get_term_link( $author_second->term_id ). '">' . $author_second->name . '</a>';
					}
					?>
			        </td>
		        </tr>
			<?php
			}
			?>
		        <tr>
			        <td>
					<b>Titre</b>
			        </td>
			        <td>
					<?php echo get_album_title_original( $album_id ); ?>
			        </td>
		        </tr>
		        <tr>
			        <td>
					<b>Parution</b>
			        </td>
			        <td>
					<?php echo date_i18n( 'j F Y', strtotime(get_album_date_release( $album_id )) ); ?>
			        </td>
		        </tr>
			<?php

			$price = get_album_price( $album_id );

			if( $price ){

			?>
		        <tr>
			        <td>
					<b>Prix</b>
			        </td>
			        <td>
					<?php echo $price; ?> &euro;
			        </td>
		        </tr>
			<?php

                        }

			$rating = get_album_rating( $album_id );

			if ($rating) {

			?>
		        <tr>
			        <td>
					<b>Ma note</b>
			        </td>
			        <td>
					<?php
						$rating = get_album_rating( $album_id );

						switch ( $rating ) {
						    case 1:
						        $rating_title = 'Je n\'ai pas aimé';
						        break;
						    case 2:
						        $rating_title = 'Pourquoi pas...';
						        break;
						    case 3:
						        $rating_title = 'J\'ai aimé';
						        break;
						    case 4:
						        $rating_title = 'J\'ai adoré';
						        break;
						    case 5:
						        $rating_title = 'Coup de c&oelig;ur';
						        break;
						    default:
						        $rating_title = '';
						        break;
						}
						?>
						<span title="<?php echo $rating_title; ?>">
						<?php
						for ($i = 0; $i < 5; $i++) {
							if ($i < $rating) {
								echo '&bigstar;';
							} else {
								echo '&star;';
							}
						}
						?>
						</span>
						<?php
					?>
			        </td>
		        </tr>
			<?php

			}

			?>
			<?php

			$amazon = get_album_amazon( $album_id );

                        if( $amazon['link'] ){

			?>
		        <tr>
			        <td>
					<b>Disponible sur</b>
			        </td>
			        <td>
					<a href="<?php echo $amazon['link']; ?>" target="_blank" rel="nofollow" class="logo_partner logo_amazon">
						<img src="<?php echo $amazon['img']; ?>" alt="Amazon" />
					</a>
			        </td>
		        </tr>
                        <?php
                        }
                        ?>
		</table>
		<?php
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'twentysixteen' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'twentysixteen' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );

		?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php twentysixteen_entry_meta(); ?>
		<?php
			edit_post_link(
				sprintf(
					/* translators: %s: Name of current post */
					__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'twentysixteen' ),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
		?>
	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
