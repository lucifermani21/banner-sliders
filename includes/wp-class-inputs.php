<?php 

if ( ! defined( constant_name: 'ABSPATH' ) ) {
    die;
}

class INPUTS {

    /**
     * @param string $label_for
     * @param string $label_desc
     * @param string $label_title
     * 
     * @return void
     */
    public function wp_label( string $label_for, string $label_desc, string $label_title  ): void {
        $label_for = $label_for != '' ? $label_for : '';
        $label_desc = $label_desc != '' ? $label_desc : '';
        $label_title = $label_title != '' ? $label_title : '';
        $html = '<label for="'.$label_for.'" title="'.$label_desc.'">'.$label_title.'</label>';
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param string $input_value
     * @param string $input_placeholder
     * @param string $input_class
     * @param string $input_style
     * 
     * @return void
     */
    public function wp_input_text( string $input_id, string $input_type, string $input_name, string $input_value, string $input_placeholder, string $input_class, string $input_style ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'text';
        $input_name = $input_name != '' ? $input_name : '';
        $input_value = $input_value != '' ? $input_value : '';
        $input_placeholder = $input_placeholder != '' ? $input_placeholder : '';
        $input_class = $input_class != '' ? $input_class : 'form-control';
        $input_style = $input_style != '' ? $input_style : 'width:100%;';
        $html = '<input id="'.$input_id.'" type="'.$input_type.'" name="'.$input_name.'" value="'.$input_value.'" placeholder="'.$input_placeholder.'" class="'.$input_class.'" style="'.$input_style.'" />';
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param string $input_value
     * @param string $input_placeholder
     * @param string $input_class
     * @param string $input_style
     * 
     * @return void
     */
    public function wp_input_textarea( string $input_id, string $input_type, string $input_name, string $input_value, string $input_placeholder, string $input_class, string $input_style ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'textarea';
        $input_name = $input_name != '' ? $input_name : '';
        $input_value = $input_value != '' ? $input_value : '';
        $input_placeholder = $input_placeholder != '' ? $input_placeholder : '';
        $input_class = $input_class != '' ? $input_class : 'form-control';
        $input_style = $input_style != '' ? $input_style : 'width:100%;';
        $html = '<textarea id="'.$input_id.'" type="'.$input_type.'" name="'.$input_name.'" placeholder="'.$input_placeholder.'" class="'.$input_class.'" style="'.$input_style.'" rows="4" cols="50">'.$input_value.'</textarea>';
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_value
     * 
     * @return void
     */
    public function wp_input_texteditor( string $input_id, string $input_value ): void {
        $input_value = $input_value != '' ? $input_value : '';
        $input_id = $input_id != '' ? $input_id : '';
        $settings  = array( 
            'media_buttons' => false,
            'textarea_rows' => 5,
        );
        wp_editor( $input_value, $input_id, $settings );
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param string $input_value
     * @param string $input_class
     * @param string $input_style
     * 
     * @return void
     */
    public function wp_input_color( string $input_id, string $input_type, string $input_name, string $input_value, string $input_class, string $input_style ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'color';
        $input_name = $input_name != '' ? $input_name : '';
        $input_value = $input_value != '' ? $input_value : '';
        $input_class = $input_class != '' ? $input_class : 'form-control';
        $input_style = $input_style != '' ? $input_style : '';
        $html = '<input id="'.$input_id.'" type="'.$input_type.'" name="'.$input_name.'" value="'.$input_value.'" class="'.$input_class.'" style="'.$input_style.'" />';
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param string $input_value
     * @param string $input_placeholder
     * @param string $input_min
     * @param string|int $input_max
     * @param string $input_class
     * @param string $input_style
     * 
     * @return void
     */
    public function wp_input_number( string $input_id, string $input_type, string $input_name, string $input_value, string $input_placeholder, string $input_min, string|int $input_max, string $input_class, string $input_style ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'number';
        $input_name = $input_name != '' ? $input_name : '';
        $input_value = $input_value != '' ? $input_value : '0';
        $input_min = $input_min != '' ? $input_min : '0';
        $input_max = $input_max != '' ? $input_max : '999';
        $input_placeholder = $input_placeholder != '' ? $input_placeholder : '0';
        $input_class = $input_class != '' ? $input_class : 'form-control';
        $input_style = $input_style != '' ? $input_style : '';
        $html = '<input id="'.$input_id.'" type="'.$input_type.'" name="'.$input_name.'" value="'.$input_value.'" placeholder="'.$input_placeholder.'" min="'.$input_min.'" max="'.$input_max.'" class="'.$input_class.'" style="'.$input_style.'" />';
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param array|string $input_options
     * @param string $input_value
     * @param string $input_class
     * @param string $input_style
     * 
     * @return void
     */
    public function wp_input_select( string $input_id, string $input_type, string $input_name, array|string $input_options, string $input_value, string $input_class, string $input_style ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'select';
        $input_name = $input_name != '' ? $input_name : '';
        $input_options = explode( '|', $input_options );
        $input_value = $input_value != '' ? $input_value : '0';
        $input_class = $input_class != '' ? $input_class : 'form-control';
        $input_style = $input_style != '' ? $input_style : 'width:60%';
        $html = '';
        $html .= '<select name="'.$input_name.'" id="'.$input_name.'" class="'.$input_class.'" style="'.$input_style.'">';
        $html .= '<option value="" disabled selected>-- Select option --</option>';
        foreach( $input_options as $select_option ):
        $html .= '<option value="'.trim( $select_option, ' ' ).'" '.($input_value == $select_option ? 'selected' : '').' >'.$select_option.'</option>';
        endforeach;
        $html .= '</select>';
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param array|string $input_options
     * @param string $input_value
     * @param string $input_class
     * @param string $input_style
     * 
     * @return void
     */
    public function wp_input_checkbox( string $input_id, string $input_type, string $input_name, array|string $input_options, string $input_value, string $input_class, string $input_style ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'checkbox';
        $input_name = $input_name != '' ? $input_name : '';
        $input_options = explode( '|', $input_options );
        $input_value = $input_value != '' ? $input_value : '0';
        $input_class = $input_class != '' ? $input_class : '';
        $input_style = $input_style != '' ? $input_style : '';
        $html = '';
        foreach( $input_options as $checkbox_option ):
        $html .= '<input type="'.$input_type.'" id="'.$input_id.'" name="'.$input_id.'[]" value="'.trim( $checkbox_option, ' ' ).'" '.( in_array( $checkbox_option, (array)$input_value ) ? 'checked' : '' ).' class="'.$input_class.'" style="'.$input_style.'" >';
        $html .= '<label for="'.$input_id.'">'.trim( $checkbox_option, ' ' ).'</label><br>';
        endforeach;
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param array|string $input_options
     * @param string $input_value
     * @param string $input_class
     * @param string $input_style
     * 
     * @return void
     */
    public function wp_input_radio( string $input_id, string $input_type, string $input_name, array|string $input_options, string $input_value, string $input_class, string $input_style ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'radio';
        $input_name = $input_name != '' ? $input_name : '';
        $input_options = explode( '|', $input_options );
        $input_value = $input_value != '' ? $input_value : '0';
        $input_class = $input_class != '' ? $input_class : '';
        $input_style = $input_style != '' ? $input_style : '';
        $html = '';
        foreach( $input_options as $radio_option ):
        $html .= '<input type="'.$input_type.'" id="'.$input_id.'" name="'.$input_id.'" value="'.trim( $radio_option, ' ' ).'" '.( $radio_option == $input_value ? 'checked' : '' ).' class="'.$input_class.'" style="'.$input_style.'" >';
        $html .= '<label for="'.$input_id.'">'.trim( $radio_option, ' ' ).'</label><br>';
        endforeach;
        echo $html;
    }

    /**
     * @param string $input_id
     * @param string $input_type
     * @param string $input_name
     * @param string $input_value
     * 
     * @return void
     */
    public function wp_input_toggle( string $input_id, string $input_type, string $input_name, string $input_value ): void {
        $input_id = $input_id != '' ? $input_id : '';
        $input_type = $input_type != '' ? $input_type : 'radio';
        $input_name = $input_name != '' ? $input_name : '';
        $input_value = $input_value != '' ? $input_value : '0';
        $html = '';
        $html .= '<label class="switch">';
        $html .= '<input type="'.$input_type.'" id="'.$input_id.'" name="'.$input_id.'" value="yes" '.( is_array( $input_value ) ? 'checked' : '' ).' />';
        $html .= '<span class="slider round"></span>';
        $html .= '</label>';
        echo $html;
    }
}