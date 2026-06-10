<?php
/**
 * Fashionly Premium Front Page Template v2.0
 */
get_header();

$theme_uri = get_stylesheet_directory_uri();

// Hero: high-res fashion image from local hero_banner
$hero_img = $theme_uri . '/images/hero_banner.png';
$parallax_img = $theme_uri . '/images/parallax_bg.png';

// Category images (Unsplash — direct CDN, no API key needed)
$cat_women = 'https://images.unsplash.com/photo-1485968579580-b6d095142e6e?w=800&q=80';
$cat_men   = 'https://images.unsplash.com/photo-1617127365659-c47fa864d8bc?w=800&q=80';
$cat_acc   = 'https://images.unsplash.com/photo-1584917865442-de89df76afd3?w=800&q=80';
?>

<div class="fashionly-front-page">

    <!-- ============================================================
         HERO — Full-screen with Ken Burns zoom
         ============================================================ -->
    <section class="fsh-hero">
        <div class="fsh-hero-bg" style="background-image:url('<?php echo esc_url($hero_img); ?>')"></div>
        <div class="fsh-hero-overlay"></div>
        <div class="fsh-hero-content">
            <span class="fsh-hero-eyebrow">Fashionly &mdash; Fall / Winter 2026</span>
            <h1 class="fsh-hero-title">Dress the<br><em>World You Want</em></h1>
            <p class="fsh-hero-subtitle">Curated premium fashion for those who live beautifully.</p>
            <div class="fsh-hero-actions">
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="btn-primary">Shop the Collection</a>
                <a href="#story" class="btn-ghost">Our Story</a>
            </div>
        </div>
        <div class="fsh-hero-scroll-hint">
            <span></span>
            Scroll
        </div>
    </section>

    <!-- ============================================================
         TICKER / MARQUEE
         ============================================================ -->
    <div class="fsh-ticker">
        <div class="fsh-ticker-inner">
            <span>New Arrivals</span><span class="dot">·</span>
            <span>Sustainable Fashion</span><span class="dot">·</span>
            <span>Fall Collection 2026</span><span class="dot">·</span>
            <span>Free Shipping Over $150</span><span class="dot">·</span>
            <span>Premium Materials</span><span class="dot">·</span>
            <span>Handcrafted Essentials</span><span class="dot">·</span>
            <!-- duplicate for seamless loop -->
            <span>New Arrivals</span><span class="dot">·</span>
            <span>Sustainable Fashion</span><span class="dot">·</span>
            <span>Fall Collection 2026</span><span class="dot">·</span>
            <span>Free Shipping Over $150</span><span class="dot">·</span>
            <span>Premium Materials</span><span class="dot">·</span>
            <span>Handcrafted Essentials</span><span class="dot">·</span>
        </div>
    </div>

    <!-- ============================================================
         CATEGORIES BAND
         ============================================================ -->
    <section class="fsh-section fsh-section-alt">
        <div class="fsh-container">
            <div style="text-align:center; margin-bottom:4rem;">
                <span class="fsh-eyebrow reveal">Shop by Category</span>
                <h2 class="fsh-section-title reveal delay-1">Explore Our World</h2>
            </div>
            <div class="fsh-cats">
                <div class="fsh-cat-card reveal fade-scale">
                    <img src="<?php echo esc_url($cat_women); ?>" alt="Women" loading="lazy">
                    <div class="fsh-cat-overlay">
                        <div class="fsh-cat-label">
                            <small>Explore</small>
                            Women
                        </div>
                    </div>
                </div>
                <div class="fsh-cat-card reveal fade-scale delay-1">
                    <img src="<?php echo esc_url($cat_men); ?>" alt="Men" loading="lazy">
                    <div class="fsh-cat-overlay">
                        <div class="fsh-cat-label">
                            <small>Explore</small>
                            Men
                        </div>
                    </div>
                </div>
                <div class="fsh-cat-card reveal fade-scale delay-2">
                    <img src="<?php echo esc_url($cat_acc); ?>" alt="Accessories" loading="lazy">
                    <div class="fsh-cat-overlay">
                        <div class="fsh-cat-label">
                            <small>Explore</small>
                            Accessories
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         NEW ARRIVALS — Custom Product Grid
         ============================================================ -->
    <section id="new-arrivals" class="fsh-section">
        <div class="fsh-container">
            <div class="fsh-products-header">
                <div>
                    <span class="fsh-eyebrow reveal">Just Dropped</span>
                    <h2 class="fsh-section-title reveal delay-1">New Arrivals</h2>
                </div>
                <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="reveal delay-2">View All &rarr;</a>
            </div>

            <div class="fsh-product-grid">
                <?php
                $args = array(
                    'post_type'      => 'product',
                    'posts_per_page' => 3,
                    'orderby'        => 'date',
                    'order'          => 'DESC',
                    'post_status'    => 'publish',
                );
                $loop = new WP_Query( $args );
                $delay = 0;

                if ( $loop->have_posts() ) :
                    while ( $loop->have_posts() ) : $loop->the_post();
                        global $product;
                        $img_url    = get_the_post_thumbnail_url( get_the_ID(), 'woocommerce_single' );
                        $permalink  = get_permalink();
                        $title      = get_the_title();
                        $price_html = $product->get_price_html();
                        $delay_cls  = $delay > 0 ? ' delay-' . $delay : '';
                        $delay++;
                        ?>
                        <div class="fsh-product-card reveal fade-scale<?php echo $delay_cls; ?>">
                            <div class="fsh-product-img">
                                <?php if ( $img_url ) : ?>
                                    <img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
                                <?php else : ?>
                                    <img src="https://images.unsplash.com/photo-1445205170230-053b83016050?w=600&q=80" alt="<?php echo esc_attr($title); ?>" loading="lazy">
                                <?php endif; ?>
                                <span class="fsh-product-badge">New</span>
                                <div class="fsh-product-actions">
                                    <a href="<?php echo esc_url( $permalink ); ?>" class="fsh-add-cart-btn">View Details</a>
                                </div>
                            </div>
                            <div class="fsh-product-info">
                                <h3 class="fsh-product-name"><?php echo esc_html( $title ); ?></h3>
                                <div class="fsh-product-price"><?php echo $price_html; ?></div>
                            </div>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo '<p>No products found. Add some from your WordPress dashboard.</p>';
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- ============================================================
         QUOTE / PARALLAX SECTION
         ============================================================ -->
    <section class="fsh-quote-section">
        <div class="fsh-quote-bg" style="background-image:url('<?php echo esc_url($parallax_img); ?>')"></div>
        <div class="fsh-quote-overlay"></div>
        <div class="fsh-quote-content">
            <span class="fsh-quote-mark reveal">&ldquo;</span>
            <p class="fsh-quote-text reveal delay-1">Style is a way to say who you are<br>without having to speak.</p>
            <span class="fsh-quote-author reveal delay-2">&mdash; Rachel Zoe</span>
        </div>
    </section>

    <!-- ============================================================
         STATS BAR
         ============================================================ -->
    <div class="fsh-stats">
        <div class="fsh-container">
            <div class="fsh-stats-grid">
                <div class="reveal">
                    <span class="fsh-stat-number">12k+</span>
                    <span class="fsh-stat-label">Happy Clients</span>
                </div>
                <div class="reveal delay-1">
                    <span class="fsh-stat-number">300+</span>
                    <span class="fsh-stat-label">Unique Styles</span>
                </div>
                <div class="reveal delay-2">
                    <span class="fsh-stat-number">18</span>
                    <span class="fsh-stat-label">Countries Served</span>
                </div>
                <div class="reveal delay-3">
                    <span class="fsh-stat-number">100%</span>
                    <span class="fsh-stat-label">Premium Materials</span>
                </div>
            </div>
        </div>
    </div>

    <!-- ============================================================
         BRAND STORY — 50/50
         ============================================================ -->
    <section id="story" class="fsh-story">
        <div class="fsh-story-visual reveal fade-left">
            <img src="<?php echo esc_url( $hero_img ); ?>" alt="Our Story" loading="lazy">
        </div>
        <div class="fsh-story-content">
            <div class="fsh-story-inner">
                <span class="fsh-eyebrow reveal">About Fashionly</span>
                <h2 class="fsh-section-title reveal delay-1">Crafted for the<br><em>Unapologetically Bold</em></h2>
                <p class="reveal delay-2">Founded on the belief that true style is timeless, Fashionly curates premium wardrobe essentials — garments that transcend fleeting trends and become part of your story.</p>
                <p class="reveal delay-3">Every thread is sourced consciously. Every silhouette is sculpted to move with you. We don't follow fashion — we define it.</p>
                <div class="reveal delay-4">
                    <a href="<?php echo esc_url( get_permalink( wc_get_page_id('shop') ) ); ?>" class="btn-primary" style="background:var(--c-gold)!important; border-color:var(--c-gold)!important; color:var(--c-dark)!important; display:inline-block; margin-top:1rem;">Discover the Collection</a>
                </div>
            </div>
        </div>
    </section>

    <!-- ============================================================
         NEWSLETTER
         ============================================================ -->
    <section class="fsh-newsletter">
        <div class="fsh-container">
            <span class="fsh-eyebrow reveal">Stay Connected</span>
            <h2 class="fsh-section-title reveal delay-1">Join the Inner Circle</h2>
            <p class="fsh-newsletter-sub reveal delay-2">Be first to know about new arrivals, exclusive offers, and private events.</p>
            <div class="reveal delay-3">
                <form class="fsh-nl-form" onsubmit="event.preventDefault(); this.innerHTML='<p style=\'color:var(--c-gold-lt);padding:1rem;\'>✓ Thank you for subscribing!</p>'">
                    <input type="email" placeholder="Your email address" required>
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

</div><!-- .fashionly-front-page -->

<?php get_footer(); ?>
