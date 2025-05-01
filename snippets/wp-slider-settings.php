<?php $obj = new SETTINGS;
$wp_input = new INPUTS;
$page_slug = $obj->setting_page_slug;
$section = $obj->sections;?>
<div id="wp_banner_slider_plugin_custom_setting" class="wrap">
    <h1><?php echo __( 'Theme Custom Settings', '' );?></h1>
    <hr/>
    <form method="post" action="options.php" enctype="multipart/form-data">
        <?php settings_fields( $page_slug );
        do_settings_sections( $page_slug );?>       
        <?php foreach( $section as $key => $section_val ):?>   
        <h2><?php echo __( $section_val['section_title'] );?></h2>        
        <div id="<?php echo $section_val['section_title'];?>" class="wp-<?php echo $section_val['section_title'];?>" style="margin-bottom:1rem;" >
            <?php foreach( $section_val['section_fields'] as $i => $fields_val ):?>
                <table style="width: 100%;text-align:left;">
                    <tbody>
                        <?php $my_option = get_option( $fields_val['field_id'] );?>
                        <tr>
                            <th style="width:15%;padding-bottom: 10px;">
                                <?php $wp_input->wp_label( $fields_val['field_id'], $fields_val['field_desc'], $fields_val['field_name'] );?>
                            </th>
                            <td style="padding-bottom: 10px;">
                                <?php if( $fields_val['field_type'] == 'toggle' ):?>
                                    <?php $wp_input->wp_input_toggle( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $my_option );?>
                                <?php elseif( $fields_val['field_type'] == 'radio' ):?>
                                    <?php $wp_input->wp_input_radio( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $fields_val['field_options'], $my_option, '', '' );?>
                                <?php elseif( $fields_val['field_type'] == 'checkbox' ):?>
                                    <?php $wp_input->wp_input_checkbox( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $fields_val['field_options'], $my_option, '', '' );?>
                                <?php elseif( $fields_val['field_type'] == 'select' ):?>
                                    <?php $wp_input->wp_input_select( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $fields_val['field_options'], $my_option, '', '' );?>
                                <?php elseif( $fields_val['field_type'] == 'number' ):?>
                                    <?php $wp_input->wp_input_number( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $my_option, $fields_val['field_placeholder'], '1', '100', '', 'width:10%;' ); ?>
                                <?php elseif( $fields_val['field_type'] == 'color' ):?>
                                    <?php $wp_input->wp_input_color( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $my_option, '', '' ); ?>
                                <?php elseif( $fields_val['field_type'] == 'texteditor' ):?>
                                    <?php $wp_input->wp_input_texteditor( $fields_val['field_id'], $my_option );?>
                                <?php elseif( $fields_val['field_type'] == 'textarea' ):?>
                                    <?php $wp_input->wp_input_textarea( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $my_option, $fields_val['field_placeholder'], '', '' ); ?>
                                <?php else:?>								
                                    <?php $wp_input->wp_input_text( $fields_val['field_id'], $fields_val['field_type'], $fields_val['field_id'], $my_option, $fields_val['field_placeholder'], '', $fields_val['field_style'] ); ?>
                                <?php endif;?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php endforeach;?>
        </div>
        <?php endforeach;?>
        <hr/>
        <h2><?php echo __( '1. You can use <mark>[dynamic_slider]</mark> shortcode for the banner slider.' );?></h2>
        <h2><?php echo __( '2. The Banner Slider template can be overridden by copying it to yourtheme/dynamic_banner_slider/wp-bnrshortcode.php.' );?></h2>
       	<?php submit_button( 'Update Settings' );?>
    </form>
</div>