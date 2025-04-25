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
		// Add a nonce field for security
		wp_nonce_field('image_upload_meta_box', 'image_upload_meta_box_nonce');
    
		// Get existing value if it exists
		$image_id = get_post_meta($post->ID, 'banner_images', true);
		$title_id = get_post_meta($post->ID, 'banner_title', true);
		$banner_desc = get_post_meta($post->ID, 'banner_desc', true);
		
		// Preview the image
		$image_src = '';
		if ($image_id) {
			$image_src = wp_get_attachment_url($image_id);
		}
		?>
		<table id="banner-table" border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
			<thead>
				<tr>
					<th>Banner Image</th>
					<th>Title</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody id="banner-rows">
				<tr class="banner-row">
					<td style="width:25%">
						<div class="image-upload-container" style="text-align: center; margin: auto;">
							<!-- Image preview -->
							<div id="image-preview" style="margin-bottom: 20px;">
							<?php if ($image_src) : ?>
								<img src="<?php echo esc_url($image_src); ?>" style="max-width:150px; height: auto;" />
							<?php endif; ?>
							</div>
							<!-- Hidden field to store image ID -->
							<input type="hidden" id="banner_images" name="banner_images" value="<?php echo esc_attr($image_id); ?>" />
							<!-- Upload button -->
							<input type="button" id="upload-image-button" class="button" value="Upload Image" />
							<!-- Remove button (only shows if image exists) -->
							<?php if ($image_id) : ?>
								<input type="button" id="remove-image-button" class="button" value="Remove Image" />
							<?php endif; ?>
						</div>
					</td>
					<td style="width:25%"><input type="text" id="banner_title" name="banner_title" value="<?php echo esc_attr($title_id); ?>" placeholder="add banner title." style="width: 100%;" /></td>
					<td style="width:50%">
						<?php $content = $banner_desc;
							$settings  = array( 
								'media_buttons' => false,
								'textarea_rows' => 4,
							);
							wp_editor( $content, 'banner_desc', $settings );?>
					</td>
					<td style="text-align:center">
						<button type="button"><span class="dashicons dashicons-trash"></span> Remove</button>
					</td>
				</tr>				
			</tbody>
		</table>
		<button type="button" id="add-banner-row" class="button" style="margin-top:10px;"><span class="dashicons dashicons-insert"></span> Add Row</button>		
		<?php 
	}

    public function ms_save_metabox( $post_id, $post ) {
		// Check if our nonce is set.
		if (!isset($_POST['image_upload_meta_box_nonce'])) {
			return;
		}
		
		// Verify that the nonce is valid.
		if (!wp_verify_nonce($_POST['image_upload_meta_box_nonce'], 'image_upload_meta_box')) {
			return;
		}		
		
		// Save/update the image ID
		if (isset($_POST['banner_images'])) {
			update_post_meta($post_id, 'banner_images', sanitize_text_field($_POST['banner_images']));
		}

		// Save/update the title ID
		if (isset($_POST['banner_title'])) {
			update_post_meta($post_id, 'banner_title', sanitize_text_field($_POST['banner_title']));
		}

		// Save/update the Banner description
		if (isset($_POST['banner_desc'])) {
			update_post_meta($post_id, 'banner_desc', sanitize_textarea_field($_POST['banner_desc']));
		}

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