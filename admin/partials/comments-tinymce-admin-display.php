<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://profiles.wordpress.org/shailu25
 * @since      1.0.0
 *
 * @package    Comments_Tinymce
 * @subpackage Comments_Tinymce/admin/partials
 */

$comment_tinymce_object = new Comments_Tinymce;
$text_domain = $comment_tinymce_object->get_plugin_name();
$comment_tinymce_options = Comments_Tinymce::comment_tinymce_get_options();
?>
<div class="wrap">
    <h2><?php echo esc_html( 'Comment Form Editor With Tinymce Settings' );?></h2>
    <form method="post" action="<?php echo admin_url( 'admin-post.php' ); ?>" enctype="multipart/form-data">
        <input type="hidden" name="action" value="save_comment_tinymce_update_settings" />
        <?php wp_nonce_field(-1,'save_comment_tinymce_options' ); ?>
        <?php if(isset($_GET["update-status"])): ?>
        <div class="notice notice-success is-dismissible">
            <p><?php echo esc_html( 'Settings save successfully!', 'comment-tinymce' ); ?></p>
        </div>
        <?php endif; ?>
        <div class="sticky_popup_form">
            <table class="form-table" width="100%">
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable H1 Tag', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_heading_one" id="comment_tinymce_heading_one" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_heading_one']) && $comment_tinymce_options['comment_tinymce_heading_one'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable H2 Tag', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_heading_two" id="comment_tinymce_heading_two" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_heading_two']) && $comment_tinymce_options['comment_tinymce_heading_two'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable H3 Tag', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_heading_three" id="comment_tinymce_heading_three" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_heading_three']) && $comment_tinymce_options['comment_tinymce_heading_three'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable H4 Tag', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_heading_four" id="comment_tinymce_heading_four" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_heading_four']) && $comment_tinymce_options['comment_tinymce_heading_four'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable H5 Tag', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_heading_five" id="comment_tinymce_heading_five" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_heading_five']) && $comment_tinymce_options['comment_tinymce_heading_five'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable H6 Tag', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_heading_six" id="comment_tinymce_heading_six" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_heading_six']) && $comment_tinymce_options['comment_tinymce_heading_six'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable Media Button', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_media_btn" id="comment_tinymce_media_btn" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_media_btn']) && $comment_tinymce_options['comment_tinymce_media_btn'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php echo esc_html( 'Disable Pre Tag', 'comment-tinymce' ); ?></th>
                    <td>
                        <input type="checkbox" name="comment_tinymce_pre_tag" id="comment_tinymce_pre_tag" value="1"
                        <?php if(isset($comment_tinymce_options['comment_tinymce_pre_tag']) && $comment_tinymce_options['comment_tinymce_pre_tag'])  echo 'checked="checked"'; else ''; ?>/>
                    </td>
                </tr>
            </table>
            <p class="submit">
                <input type="submit" name="Submit" class="button-primary"
                    value="<?php echo esc_attr( 'Save Changes', 'comment-tinymce' ) ?>" />
            </p>
        </div>
    </form>
</div>