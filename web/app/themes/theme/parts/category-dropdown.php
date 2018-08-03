<?php
/**
 * Template for AnsPress category dropdown
 */

$cat_args = array(
    'parent'        => 0,
    'number'        => 16,
    'hide_empty'    => false,
    'orderby'       => 'count',
    'order'         => 'DESC',
);

$categories = get_terms( 'question_category' , $cat_args);
?>
<div class="dropdown-menu">
	<div class="dropdown-cat-items clearfix">
		<?php
		foreach($categories as $key => $category) :
			$sub_cat_count = count(get_term_children( $category->term_id, 'question_category' ));
		?>
			<div class="cat-item clearfix">
				<a class="ap-cat-image" href="<?php echo get_category_link( $category );?>">
					<?php echo ap_category_icon( $category->term_id ); ?>
				</a>
				<a class="ap-cat-wid-title" href="<?php echo get_category_link( $category );?>">
					<?php echo $category->name; ?>
				</a>
			</div>
		<?php endforeach; ?>
	</div>
	<a href="<?php ap_link_to('categories'); ?>" class="view-all-cat"><?php _e('View all categories', 'ab'); ?></a>
</div>