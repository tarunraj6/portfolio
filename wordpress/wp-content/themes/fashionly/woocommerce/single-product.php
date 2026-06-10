<?php
/**
 * Fashionly — Single Product Page Template Override
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );
?>

<style>
/* =============================================
   SINGLE PRODUCT — PREMIUM LAYOUT
   ============================================= */
.fsh-single-wrap {
    max-width: 1260px;
    margin: 0 auto;
    padding: 5rem 2rem 7rem;
}
.fsh-single-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 6rem;
    align-items: start;
}
/* Image Side */
.fsh-single-gallery {
    position: sticky;
    top: 100px;
}
.fsh-single-img-wrap {
    border-radius: 16px;
    overflow: hidden;
    background: #F0EDE8;
    aspect-ratio: 3/4;
    box-shadow: 0 20px 60px rgba(0,0,0,0.10);
}
.fsh-single-img-wrap img {
    width: 100%; height: 100%;
    object-fit: cover;
    transition: transform 0.8s ease;
}
.fsh-single-img-wrap:hover img {
    transform: scale(1.04);
}
/* Info Side */
.fsh-single-info {
    padding-top: 2rem;
}
.fsh-single-breadcrumb {
    font-size: 0.72rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-muted);
    margin-bottom: 1.5rem;
}
.fsh-single-breadcrumb a { color: var(--c-gold); }
.fsh-single-title {
    font-family: var(--font-serif) !important;
    font-size: clamp(2rem, 4vw, 3rem);
    font-style: italic;
    font-weight: 300 !important;
    color: var(--c-dark) !important;
    line-height: 1.15;
    margin-bottom: 1.5rem !important;
}
.fsh-single-price {
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--c-dark) !important;
    letter-spacing: 1px;
    margin-bottom: 2rem !important;
}
.fsh-single-short-desc {
    font-size: 0.95rem;
    line-height: 1.9;
    color: var(--c-muted);
    margin-bottom: 2.5rem;
    border-left: 2px solid var(--c-gold);
    padding-left: 1.5rem;
}
.fsh-single-meta-tags {
    display: flex;
    flex-wrap: wrap;
    gap: 8px;
    margin-bottom: 2.5rem;
}
.fsh-meta-tag {
    background: #F0EDE8;
    border-radius: 50px;
    padding: 5px 16px;
    font-size: 0.72rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--c-dark);
}
/* Add to Cart */
.fsh-single-info .quantity {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 1.5rem;
}
.fsh-single-info .qty {
    width: 80px;
    text-align: center;
    border: 1px solid var(--c-border);
    border-radius: 50px;
    padding: 0.75rem 1rem;
    font-size: 1rem;
    outline: none;
}
.fsh-single-info .single_add_to_cart_button {
    flex: 1;
    background: var(--c-dark) !important;
    color: #fff !important;
    border-radius: 50px !important;
    padding: 1rem 2rem !important;
    font-size: 0.8rem !important;
    font-weight: 600 !important;
    letter-spacing: 2px !important;
    text-transform: uppercase !important;
    border: 2px solid var(--c-dark) !important;
    transition: all 0.4s ease !important;
    cursor: pointer !important;
}
.fsh-single-info .single_add_to_cart_button:hover {
    background: transparent !important;
    color: var(--c-dark) !important;
}
/* Trust badges */
.fsh-trust-badges {
    display: flex;
    gap: 1.5rem;
    margin-top: 2.5rem;
    padding-top: 2.5rem;
    border-top: 1px solid var(--c-border);
}
.fsh-badge {
    display: flex;
    align-items: center;
    gap: 8px;
    font-size: 0.72rem;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: var(--c-muted);
}
.fsh-badge svg {
    width: 18px; height: 18px;
    stroke: var(--c-gold);
    fill: none;
    stroke-width: 2;
}
/* Tabs */
.woocommerce-tabs {
    margin-top: 5rem;
    border-top: 1px solid var(--c-border);
    padding-top: 3rem;
}
.woocommerce-tabs ul.tabs {
    display: flex;
    gap: 2rem;
    list-style: none;
    margin: 0 0 2rem;
    padding: 0;
    border-bottom: 1px solid var(--c-border);
}
.woocommerce-tabs ul.tabs li {
    padding-bottom: 1rem;
    cursor: pointer;
    font-size: 0.78rem;
    letter-spacing: 2px;
    text-transform: uppercase;
    color: var(--c-muted);
    border-bottom: 2px solid transparent;
    margin-bottom: -1px;
    transition: all 0.3s;
}
.woocommerce-tabs ul.tabs li.active,
.woocommerce-tabs ul.tabs li:hover {
    color: var(--c-dark);
    border-bottom-color: var(--c-gold);
}
/* Related */
.fsh-related {
    max-width: 1260px;
    margin: 0 auto;
    padding: 0 2rem 7rem;
}
.fsh-related h2 {
    font-family: var(--font-serif) !important;
    font-size: 2.2rem;
    font-style: italic;
    font-weight: 300 !important;
    margin-bottom: 3rem;
}
@media (max-width: 768px) {
    .fsh-single-grid { grid-template-columns: 1fr; gap: 3rem; }
    .fsh-single-gallery { position: static; }
    .fsh-trust-badges { flex-wrap: wrap; gap: 1rem; }
}
</style>

<?php while ( have_posts() ) : the_post(); ?>

<div class="fsh-single-wrap">

    <?php global $product; ?>

    <!-- Breadcrumb -->
    <div class="fsh-single-breadcrumb">
        <a href="<?php echo esc_url(home_url('/')); ?>">Home</a> &nbsp;/&nbsp;
        <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>">Shop</a> &nbsp;/&nbsp;
        <span><?php the_title(); ?></span>
    </div>

    <div class="fsh-single-grid">

        <!-- Gallery -->
        <div class="fsh-single-gallery reveal fade-left">
            <div class="fsh-single-img-wrap">
                <?php
                $img_url = get_the_post_thumbnail_url(get_the_ID(), 'woocommerce_single');
                if ($img_url) {
                    echo '<img src="' . esc_url($img_url) . '" alt="' . esc_attr(get_the_title()) . '">';
                } else {
                    echo '<img src="https://images.unsplash.com/photo-1445205170230-053b83016050?w=800&q=80" alt="Product">';
                }
                ?>
            </div>
        </div>

        <!-- Info -->
        <div class="fsh-single-info reveal">

            <h1 class="fsh-single-title"><?php the_title(); ?></h1>

            <div class="fsh-single-price">
                <?php echo $product->get_price_html(); ?>
            </div>

            <div class="fsh-single-short-desc">
                <?php
                $short = $product->get_short_description();
                echo $short ? wp_kses_post($short) : wp_kses_post(get_the_content());
                ?>
            </div>

            <div class="fsh-single-meta-tags">
                <span class="fsh-meta-tag">✦ Premium Quality</span>
                <span class="fsh-meta-tag">Free Shipping</span>
                <span class="fsh-meta-tag">Easy Returns</span>
            </div>

            <!-- Add to Cart Form -->
            <?php woocommerce_template_single_add_to_cart(); ?>

            <!-- Trust Badges -->
            <div class="fsh-trust-badges">
                <div class="fsh-badge">
                    <svg viewBox="0 0 24 24"><path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/></svg>
                    Secure Checkout
                </div>
                <div class="fsh-badge">
                    <svg viewBox="0 0 24 24"><path d="M20 7H4l1 10h14L20 7z"/><path d="M16 7c0-2.2-1.8-4-4-4S8 4.8 8 7"/></svg>
                    Free Returns
                </div>
                <div class="fsh-badge">
                    <svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><path d="m9 12 2 2 4-4"/></svg>
                    Authentic
                </div>
            </div>

        </div><!-- .fsh-single-info -->

    </div><!-- .fsh-single-grid -->

    <!-- Tabs -->
    <div class="woocommerce-tabs">
        <?php woocommerce_output_product_data_tabs(); ?>
    </div>

</div><!-- .fsh-single-wrap -->

<!-- Related Products -->
<div class="fsh-related">
    <?php woocommerce_output_related_products(); ?>
</div>

<?php endwhile; ?>

<?php get_footer( 'shop' ); ?>
