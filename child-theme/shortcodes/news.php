<?php
    $category = $params['category'] ? $params['category'] : '';
    $number = $params['number'] ? $params['number'] : 3;

    $args = array(
        'post_type' => 'news',
        'showposts' => intval($number),
        'orderby' => 'date',
        'order' => 'DESC',
        'category_name' => $category
    );

    $last_news = new WP_Query( $args );

?>

<div class="container news__container">
    <div class="row">
        <?php
            while ($last_news->have_posts()) :
            $last_news->the_post();

            $post_url = esc_url(get_the_permalink());
            $post_img_alt = get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true);
            $post_title = esc_html(get_the_title());

            if (has_excerpt()) {
                $excerpt = strip_tags(get_the_excerpt());
            } else {
                $excerpt = strip_tags(get_the_content());
                strlen($excerpt) > 20 ? $excerpt = substr($excerpt, 0, 20) . '...' : $excerpt;
            }
        ?>

            <div class="col-12 news__item">
                <?php if(wp_is_mobile()) { ?>
                    <h2><?php echo $post_title; ?></h2>
                <?php }; ?>
                <?php if(has_post_thumbnail()) { ?>
                    <a href="<?php echo $post_url; ?>" rel="nofollow">
<!--                        <img src="--><?php //echo get_the_post_thumbnail_url(); ?><!--" alt="--><?php //echo $post_img_alt; ?><!--" class="news__item-img" />-->
                        <?php echo get_the_post_thumbnail(get_the_ID(), array(490, 328), array('class' => 'news__item-img')); ?>
                    </a>
                <?php }; ?>
                <div class="news__item-text">
                    <?php if(!wp_is_mobile()) { ?>
                        <h2><?php echo $post_title; ?></h2>
                    <?php }; ?>
                    <div class="news__item-excerpt"><?php echo $excerpt; ?></div>
                    <a href="<?php echo $post_url; ?>" rel="nofollow">Read more here</a>
                </div>
            </div>

        <?php
            endwhile;
            wp_reset_postdata();
        ?>
    </div>
</div>

<style>
    .news__container .row {
        row-gap: 10px;
    }
    .news__item {
        display: flex;
        gap: 10px;
    }
    .news__item-text {
        display: flex;
        flex-direction: column;
        gap: 5px;
    }
    .news__item-text a {
        padding: 5px 10px;
        text-decoration: none;
        color: #000;
        background-color: #d5d5d5;
        border-radius: 20px;
        width: 100%;
        max-width: 150px;
        text-align: center;
        align-self: end;
    }
    .news__item-img {
        /*for img tag*/

        /*max-width: 490px;*/
        /*width: 100%;*/
        /*max-height: 328px;*/
        /*height: auto;*/

        border-radius: 10px;
    }
    @media (max-width: 576px) {
        .news__item {
            flex-direction: column;
        }
        .news__item-text a {
            align-self: unset;
        }
    }
</style>