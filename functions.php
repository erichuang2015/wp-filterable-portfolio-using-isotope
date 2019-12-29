<?php 

function text_domain_assets(){

    wp_enqueue_script( 'isotope-script', get_stylesheet_directory_uri() . '/js/isotope.pkgd.min.js',
        array( 'jquery' )
    );
    
    wp_enqueue_script( 'imagesloaded-script', get_stylesheet_directory_uri() . '/js/imagesloaded.pkgd.min.js',
        array( 'jquery' )
    );

    wp_enqueue_script( 'ds-theme-script', get_stylesheet_directory_uri() . '/js/scripts.js',
        array( 'jquery' )
    );

}

add_action( 'wp_enqueue_scripts', 'text_domain_assets' );


/**
 * Portfolio
 */
function shortcode_callback_func_portfolio( $atts = array(), $content = '' ) {
	$atts = shortcode_atts( array(
		'id' => 'value',
	), $atts, 'shortcode-id' );

	ob_start(); ?>

<div class="portfolio-area clearfix">
    <div class="portfolio-title-area clearfix">
        <div class="section-title clearfix">
            <h1>Our Work</h1>
            <p>A sampling of our work.</p>
        </div>
        <!-- /.section-title -->
        <div class="portfolio-menu-area clearfix">
            <ul class="portfolio-menu">
                <li data-filter="*" class="active">all</li>
            
                <?php 

                    function gen_class($name){
                        return  str_replace(' ', '_', strtolower($name));
                    }

                    $taxonomies = get_terms( array(
                        'taxonomy' => 'portfolio_categories',
                        'hide_empty' => false,
                    ) ); 


                    if ( !empty($taxonomies) ) :
                        foreach( $taxonomies as $category ) {?>

                            <li data-filter=".<?php echo gen_class($category->name); ?>"><?php echo $category->name; ?></li>
                            
                        <?php
                        }
                    endif;
                ?>

            </ul>
        </div>

        
    </div>
    <!-- /.portfolio-title-area -->

    <div class="portfolio_container clearfix">
        <div class="row all-folio clearfix">
            <?php 
                $portfolio_args = array(
                    'post_type' => 'portfolios',
                    'posts_per_page' => -1
                );

                $portfolio_item = new WP_Query($portfolio_args);
                while ($portfolio_item-> have_posts()) {
                    $portfolio_item->the_post();

                        $terms = get_the_terms( get_the_ID(), 'portfolio_categories' );
                            

                        if ( !empty($terms) ) :
                            foreach( $terms as $category ) {?>

                                <?php 
                                    $cat_list .= "<li data-filter=.".gen_class($category->name).">".$category->name."</li>";
                                    $class_name .= gen_class($category->name) . " "; ?>
                                
                            <?php
                            }
                        endif;

                        ?>

                        <a href="<?php the_permalink(); ?>">
                            <div class="col-md-4 folios-item clearfix <?php echo $class_name; ?>" data-wow-duration="1s">
                                <div class="single-folio clearfix">
                                    <div class="single-folio-content clearfix">
                                        <?php 
                                            $class_name = "";
                                            $thumbnail = get_field('thumbnail');
                                            $size = 'full';
                                            if( $thumbnail ) {
                                                echo wp_get_attachment_image( $thumbnail, $size );
                                            }
                                        ?>
                                        
                                        <div class="folio-hvr">
                                            <div class="folio-image-container">
                                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/img/trees_white.png" alt="" class="img-hover" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="single-folio-info clearfix">
                                    <h3><a href="<?php the_permalink(  ); ?>"><?php the_title(); ?></a></h3>
                                    <div class="terms">

                                        <?php  

                                            echo '<ul class="portfolio-menu single-portfolio">';
                                            echo $cat_list;
                                            echo "</ul>";

                                            $cat_list = "";

                                         ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </a>
                    <?php
                }
                wp_reset_query();
            ?>
        </div>
        <!-- /.row all-folio -->
    </div>
    <!-- /.container -->
</div>
<!-- /.portfolio-area -->


	<?php
	$output = ob_get_contents();
	ob_end_clean();

	return $output;

}
add_shortcode( 'portfolio', 'shortcode_callback_func_portfolio' );