<?php

if ( ! class_exists('PCP_CPT_Creator') ) {
	class PCP_CPT_Creator{

		public function register_cpt( $post_type, $names, $icon ) {

			$args   = [
				'labels'          => [
					'name'               => $names['uc_plural'],
					'all_items'          => $names['uc_plural'],
					'add_new'            => 'Add New ' . $names['uc_single'],
					'add_new_item'       => 'Add New ' . $names['uc_single'],
					'menu_name'          => $names['uc_plural'],
					'singular_name'      => $names['uc_single'],
					'edit_item'          => 'Edit ' . $names['uc_single'],
					'new_item'           => 'New ' . $names['uc_single'],
					'view_item'          => 'View ' . $names['uc_single'],
					'items_archive'      => $names['uc_plural'],
					'search_items'       => 'Search ' . $names['uc_plural'],
					'not_found'          => 'None found',
					'not_found_in_trash' => 'None found in trash',
				],
				'public'          => true,
				'query_var'       => true,
				'rewrite'         => array( 'slug' => $names['single'], 'with_front' => false ),
				'menu_icon'			=> 'dashicons-'.$icon,
				'has_archive'     => true,
				'can_export'      => true,
				'supports'        => [ 'title', 'editor', 'thumbnail', 'excerpt' ],
			];

			register_post_type( $post_type, $args );
		}

		public function register_taxonomy( $taxonomy, $post_type, $names, $hierarchical ) {
			$labels = array(
				'name'                       => _x( $names['uc_plural'], 'Categories', 'spurs' ),
				'singular_name'              => _x( $names['uc_singular'], 'Category', 'spurs' ),
				'search_items'               => __( 'Search ' . $names['uc_plural'], 'spurs' ),
				'popular_items'              => __( 'Popular ' . $names['uc_plural'], 'spurs' ),
				'all_items'                  => __( 'All ' . $names['uc_plural'], 'spurs' ),
				'parent_item'                => null,
				'parent_item_colon'          => null,
				'edit_item'                  => __( 'Edit ' . $names['uc_singular'], 'spurs' ),
				'update_item'                => __( 'Update ' . $names['uc_singular'], 'spurs' ),
				'add_new_item'               => __( 'Add New ' . $names['uc_singular'], 'spurs' ),
				'new_item_name'              => __( 'New ' . $names['uc_singular'] . ' Name', 'spurs' ),
				'separate_items_with_commas' => __( 'Separate ' . $names['plural'] . ' with commas', 'spurs' ),
				'add_or_remove_items'        => __( 'Add or remove ' . $names['plural'], 'spurs' ),
				'choose_from_most_used'      => __( 'Choose from the most used ' . $names['plural'], 'spurs' ),
				'not_found'                  => __( 'No ' . $names['plural'] . ' found.', 'spurs' ),
				'menu_name'                  => __( $names['uc_plural'], 'spurs' ),
			);

			$args = array(
				'hierarchical'          => $hierarchical,
				'labels'                => $labels,
				'show_ui'               => true,
				'show_admin_column'     => true,
				'query_var'             => true,
				'rewrite'               => array( 'slug' => $taxonomy ),
			);

			register_taxonomy( $taxonomy, $post_type, $args );
		}
	}
}
