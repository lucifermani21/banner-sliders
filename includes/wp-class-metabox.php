<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class METABOX{

    public function __construct(){
        if ( is_admin() ) {
			add_action( 'load-post.php',     array( $this, 'ms_init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'ms_init_metabox' ) );
		}
    }

    public function ms_init_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'ms_add_metabox'  )        );
		add_action( 'save_post',      array( $this, 'ms_save_metabox' ), 10, 2 );
	}

    public function ms_add_metabox() {
		add_meta_box(
			'ms-banner-slider-box',
			__( 'Banner Images and Text', 'ms-banner-slider' ),
			array( $this, 'ms_rendar_banner_slider_fucntion' ),
			array( 'page', 'post' ),
			'normal',
			'high'
		);
	}

    public function ms_rendar_banner_slider_fucntion( $post ) {
		echo '<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
			<thead>
				<tr>
					<th>Image</th>
					<th>Title</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td><img src="path/to/image.jpg" alt="Sample Image" style="width: 100px; height: auto;"></td>
					<td>Sample Title</td>
					<td>Sample description goes here.</td>
					<td><button type="button">Edit</button> <button type="button">Delete</button></td>
				</tr>
				<!-- Add more rows as needed -->
			</tbody>
		</table>';
	}

    public function ms_save_metabox( $post_id, $post ) {
		
		// Check if user has permissions to save data.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}

		// Check if not an autosave.
		if ( wp_is_post_autosave( $post_id ) ) {
			return;
		}

		// Check if not a revision.
		if ( wp_is_post_revision( $post_id ) ) {
			return;
		}
	}

}