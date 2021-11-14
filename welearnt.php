<?php

/**
 * Plugin Name:       My Author Box
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Custom My Author Box.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Tarikul Islam
 * Author URI:        https://author.example.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://example.com/my-plugin/
 * Text Domain:       welearnt-authorbox
 * Domain Path:       /languages
 */

if (!defined('ABSPATH')) exit;

// file import 
if (is_admin()) {
    require_once dirname(__FILE__) . '/includes/admin/profile.php';
}

$twitterHandle = get_the_author_meta('twitter');

echo $twitterHandle;


function welearnt_post_author_box($content)
{

    global $post;
    //$author_avatar = get_avatar($post->post_author);
    $avatar_src = get_avatar_url($post->post_author);
    $bio = get_user_meta($post->post_author,'description', true);
    $facebook = get_user_meta($post->post_author,'twitter', true);
    $twitter = get_user_meta($post->post_author,'facebook', true);
    $linkedin = get_user_meta($post->post_author,'linkedin', true);
    $github = get_user_meta($post->post_author,'github', true);

    // Username + user inage + user contact info 
   // echo $avatar_src;
    
    ob_start();
?>
    <div class="container author-box p-5 shadow mb-5 bg-body rounded">
        <div class="row justify-content-center">
            <div class="col-sm-3 text-center">
                <img src="<? echo esc_url($avatar_src)?>" class="img-fluid rounded-circle author-img" alt="..." width="150" height="150" />
               
            </div>
            <div class="col-sm-9">
                <h3>Tarikul Islam</h3>
                <?php echo wpautop(wp_kses_post($bio))?>
                <h5>Follow me:</h5>
                <ul class="list-inline">
                    <?php if($facebook){?>
                        <li class="list-inline-item">
                        <button type="button" class="btn btn-outline-secondary">
                            <a href="<?php echo esc_url($facebook);?>" class="text-decoration-none">
                                <i class="fab fa-facebook"></i>FaceBook
                            </a>
                        </button>
                    </li>
                    <?php }?>
                    <?php if($twitter){?>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-outline-secondary">
                            <a href="<?php echo esc_url($twitter);?>" class="text-decoration-none">
                                <i class="fab fa-twitter"></i> Twitter
                            </a>
                        </button>
                    </li>
                    <?php }?>
                    <?php if($linkedin){?>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-outline-secondary">
                            <a href="<?php echo esc_url($linkedin);?>" class="text-decoration-none">
                                <i class="fab fa-twitter"></i> Linkedin
                            </a>
                        </button>
                    </li>
                    <?php }?>
                    <?php if($github){?>
                    <li class="list-inline-item">
                        <button type="button" class="btn btn-outline-secondary ">
                            <a href="<?php echo esc_url($github);?>" class="text-decoration-none">
                                <i class="fab fa-github-square"></i> Secondary
                            </a>
                        </button>
                    </li>
                    <?php }?>
                </ul>
            </div>
        </div>
    </div>

<?php
    $author_box = ob_get_clean();
    return $content . $author_box;
}
add_action('the_content', 'welearnt_post_author_box');

function welearnt_custom_script()
{
    wp_enqueue_style('bootstarp-css', '//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome-css', '//use.fontawesome.com/releases/v5.15.4/css/all.css');
    wp_enqueue_style('custom-css', plugins_url('assets/css/style.css', __FILE__));
}
add_action('wp_enqueue_scripts', 'welearnt_custom_script');
