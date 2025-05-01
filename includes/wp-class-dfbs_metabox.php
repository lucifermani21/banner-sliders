<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class DFBS_METABOX{

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
		$show_post_types = get_option( 'slider_post_type' );
		add_meta_box(
			'ms-banner-slider-box',
			__( 'Banner Images and Text', 'ms-banner-slider' ),
			array( $this, 'ms_rendar_banner_slider_fucntion' ),
			( !empty($show_post_types) ? $show_post_types : array('post', 'page') ),
			'normal',
			'high'
		);
	}

    public function ms_rendar_banner_slider_fucntion( $post ) {		
		$meta_data = get_post_meta($post->ID, 'wp_banner_slider_repeatable_data', true);
    	$fields = !empty($meta_data) ? $meta_data : array( array('banner_image' => '', 'banner_title' => '', 'banner_description' => '' ) );
		wp_nonce_field('wp_banner_slider_repeatable_data_nonce', 'wp_banner_slider_repeatable_data_nonce');
		?>
		<table id="repeatable-fields" border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
			<thead>
				<tr>
					<th><?php echo __( 'Banner Image' );?></th>
					<th><?php echo __( 'Title' );?></th>
					<th><?php echo __( 'Description' );?></th>
					<th><?php echo __( 'Action' );?></th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($fields as $index => $field):
				$image_url = !empty($field['banner_image']) ? wp_get_attachment_url($field['banner_image']) : '';?>
				<tr class="repeatable-field-group" data-index="<?php echo $index; ?>" >
					<td style="width:25%;text-align:center">
						<div class="image-preview">
							<?php if ($image_url): ?>
							<img src="<?php echo esc_url($image_url); ?>" style="max-width:120px; height: auto;">
							<?php endif; ?>
						</div>
						<input type="hidden" name="wp_banner_slider_repeatable_data[<?php echo $index; ?>][banner_image]" value="<?php echo esc_attr($field['banner_image']); ?>" class="image-id" />
						<button type="button" class="upload-image-button button">Select Image</button>
						<button type="button" class="remove-image-button button">Remove Image</button>
					</td>
					<td style="width:20%">
						<input type="text" name="wp_banner_slider_repeatable_data[<?php echo $index; ?>][banner_title]" value="<?php echo esc_attr($field['banner_title']); ?>" placeholder="Add image title here..." style="width: 100%;" />
					</td>
					<td style="width:50%">
						<textarea name="wp_banner_slider_repeatable_data[<?php echo $index; ?>][banner_description]" placeholder="Add image description here..." style="width: 100%;height:100px;"><?php echo esc_textarea($field['banner_description']); ?></textarea>
					</td>
					<td style="text-align:center">
						<button type="button" class="remove-field-group button"><span class="dashicons dashicons-trash"></span> Remove</bu>
					</td>
				</tr>			
				<?php endforeach;?>	
			</tbody>
		</table>
		<button type="button" id="add-new-field-group" class="button" style="margin-top:10px;"><span class="dashicons dashicons-insert"></span> Add Row</button>		
		<?php 
	}

    public function ms_save_metabox( $post_id, $post ) {

		if (!isset($_POST['wp_banner_slider_repeatable_data_nonce']) || 
			!wp_verify_nonce($_POST['wp_banner_slider_repeatable_data_nonce'], 'wp_banner_slider_repeatable_data_nonce')) {
			return;
		}
    
    	// Check user permissions
		if (!current_user_can('edit_post', $post_id)) {
			return;
		}
		
		// Save or delete the meta data
		if (isset($_POST['wp_banner_slider_repeatable_data'])) {
			// Sanitize the data
			$sanitized_data = array();
			foreach ($_POST['wp_banner_slider_repeatable_data'] as $field) {
				$sanitized_data[] = array(
					'banner_image' => absint($field['banner_image']),
					'banner_title' => sanitize_text_field($field['banner_title']),
					'banner_description' => sanitize_textarea_field($field['banner_description'])					
				);
			}
			update_post_meta($post_id, 'wp_banner_slider_repeatable_data', $sanitized_data);
		} else {
			delete_post_meta($post_id, 'wp_banner_slider_repeatable_data');
		}
	}
}