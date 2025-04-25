<?php 

if ( ! defined( 'ABSPATH' ) ) {
    die;
}

class METABOX{

	public $meta_fields_array = array(
        [
            'field_name' => 'Banner Image',
            'field_type' => 'file',
            'field_id' => 'slider_banner_image',
            'desc' => 'Add your Banner Image.',
            'placeholder' => ''
        ],
        [
            'field_name' => 'Banner Title',
            'field_type' => 'test',
            'field_id' => 'slider_banner_title',
            'desc' => 'Add your Banner Title.',
            'placeholder' => 'Banner Title'
        ],
        [
            'field_name' => 'Banner Description',
            'field_type' => 'textarea',
            'field_id' => 'slider_banner_desc',
            'desc' => 'Add your Banner Description.',
            'placeholder' => 'add your Banner Description'
        ],
    );

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
		
		$meta_fields_array = $this->meta_fields_array;
		?>
		<table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
			<thead>
				<tr>
					<th>Banner Image</th>
					<th>Title</th>
					<th>Description</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<?php foreach( $this->meta_fields_array as $k => $vlaue ):
					get_post_meta( $post->ID, $vlaue['field_id'], true );?>
					<td><input type="<?php echo $vlaue['field_type'];?>" id="<?php echo $vlaue['field_id'];?>" name="team_<?php echo $vlaue['field_id'];?>" value="<?php echo ( get_post_meta( $post->ID, 'team_'.$vlaue['field_id'], true ) ) != '' ? get_post_meta( $post->ID, 'team_'.$vlaue['field_id'], true ) : '';?>" placeholder="<?php echo $vlaue['placeholder'];?>" style="width: 100%;"></td>
					<?php endforeach;?>
					
					<td style="text-align:center"><button type="remove_button"><span class="dashicons dashicons-trash"></span> Remove</button></td>
				</tr>				
			</tbody>
		</table>
		<button type="add_button" style="margin-top:10px;"><span class="dashicons dashicons-insert"></span> Add Row</button>
		<?php 
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