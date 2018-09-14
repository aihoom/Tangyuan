<?php
/*
Name: 分类图片
Description: 让分类，标签添加图像项编辑，就是这么简单。
Version: 1.0
Author: Mousin
Author URI: https://mousin.cn
 */
class TaxonomyImage
{
    const DEFAULT_IMG = '';

    public function __construct()
    {
        add_action('admin_init', array(
            $this,
            'inits',
        ));
        if (strpos($_SERVER['SCRIPT_NAME'], 'edit-tags.php') > 0 || strpos($_SERVER['SCRIPT_NAME'], 'term.php') > 0) {
            add_action('admin_head', array(
                $this,
                'load_style',
            ));
            add_action('admin_head', array(
                $this,
                'load_script',
            ));
        }
    }

    public function inits()
    {
        $taxonomies = get_taxonomies();
        foreach ($taxonomies as $taxonomy) {
            add_action($taxonomy.'_add_form_fields', array(
                $this,
                'add_texonomy_field',
            ));
            add_action($taxonomy.'_edit_form_fields', array(
                $this,
                'edit_texonomy_field',
            ));
            add_filter('manage_edit-'.$taxonomy.'_columns', array(
                $this,
                'taxonomy_columns',
            ));
            add_filter('manage_'.$taxonomy.'_custom_column', array(
                $this,
                'taxonomy_column',
            ), 10, 3);
        }
    }

    public static function save_taxonomy_image($term_id)
    {
        if (isset($_POST['taxonomy_image'])) {
            update_option('taxonomy_image'.$term_id, $_POST['taxonomy_image']);
        }
    }

    public function taxonomy_columns($columns)
    {
        $new_columns['thumb'] = '<a><span>'.__('Image', 'tangyuan').'</span></a>';

        return array_merge($new_columns, $columns);
    }

    public function add_texonomy_field()
    {
        echo '<div class="form-field">
			<label for="taxonomy_image">'.__('Image', 'tangyuan').'</label>
			<p>
			  <div class="select_image_preview image_preview" style="background-image: url(\''.TaxonomyImage::DEFAULT_IMG.'\')"></div>
			<p>
			<input type="hidden" name="taxonomy_image" id="taxonomy_image" value="" />
			<button id="upload_image_button" class="button">'.__('Set Image', 'tangyuan').'</button>
			<button id="remove_image_button" class="button">'.__('Remove Image', 'tangyuan').'</button>
		</div>';
    }

    public function edit_texonomy_field($taxonomy)
    {
        $attachment = $this->get_taxonomy_image_url($taxonomy->term_id, null);
        echo '<tr class="form-field">
			<th scope="row" valign="top"><label for="taxonomy_image">'.__('Image', 'tangyuan').'</label></th>
			<td>
			 <div class="select_image_preview image_preview" style="background-image: url(\''.$attachment['attachment_url'].'\')"></div>
			<input type="hidden" name="taxonomy_image" id="taxonomy_image" value="'.$attachment['attachment_id'].'" />
			<button id="upload_image_button" class="button">'.__('Edit Image', 'tangyuan').'</button>
			<button id="remove_image_button" class="button">'.__('Remove Image', 'tangyuan').'</button>
			</td>
		</tr>';
    }

    public function taxonomy_column($columns, $column, $id)
    {
        $columns = '<span class="preview-thumb" style="background-image: url(\''.$this->get_taxonomy_image_url($id, array(
            80,
            80,
        ))['attachment_url'].'\')"></span>';

        return $columns;
    }

    public static function get_taxonomy_image_url($term_id = null, $size = 'medium')
    {
        if (!$term_id) {
            if (is_category()) {
                $term_id = get_query_var('cat');
            } elseif (is_tag()) {
                $term_id = get_query_var('tag_id');
            } elseif (is_tax()) {
                $current_term = get_term_by('slug', get_query_var('term'), get_query_var('taxonomy'));
                $term_id = $current_term->term_id;
            }
        }
        $attachment_id = get_option('taxonomy_image'.$term_id);
        if (!empty($attachment_id)) {
            $taxonomy_image_url = wp_get_attachment_image_src($attachment_id, $size);
            if ($taxonomy_image_url) {
                return ['attachment_id' => $attachment_id, 'attachment_url' => $taxonomy_image_url[0]];
            }
        }

        return ['attachment_id' => '', 'attachment_url' => TaxonomyImage::DEFAULT_IMG];
    }

    public function load_style()
    {
        echo '<style>
		 .column-thumb {width:80px;}
		 .preview-thumb{
			width : 80px;
			height: 80px;
			background-size: cover;
			display: block;
            background-position: 50%;
            background-color: #f4f4f4;
		 }
		 .select_image_preview,.image_preview{
			 width: 150px;
			 height: 150px;
			 background-size: cover;
			 margin-bottom: 10px;
             background-position: 50%;
             background-color: #f4f4f4;
		</style>';
    }

    public function load_script()
    {
        wp_enqueue_media(); ?>
	<script type="text/javascript">
				jQuery(document).ready(function($) {
					var upload_panel=wp.media();
					$('#upload_image_button').click(function(event) {
						event.preventDefault();
						upload_panel.open();
					});

					upload_panel.on( 'select', function() {

						var selects = upload_panel.state().get("selection").first();

						if(selects.attributes.url){
							$('.select_image_preview').css('background-image','url('+selects.attributes.url+')');
							$('#taxonomy_image').val(selects.attributes.id);
						}
						upload_panel.close()
					});

					$('#remove_image_button').click(function() {
						$('.select_image_preview').css("background-image","url('<?php echo TaxonomyImage::DEFAULT_IMG; ?>')");
						$('#taxonomy_image').val('');
						event.preventDefault();
					});
				});
			</script>;
	<?php
    }
}
add_action('edit_term', array(
    'TaxonomyImage',
    'save_taxonomy_image',
));
add_action('create_term', array(
    'TaxonomyImage',
    'save_taxonomy_image',
));
new TaxonomyImage();
