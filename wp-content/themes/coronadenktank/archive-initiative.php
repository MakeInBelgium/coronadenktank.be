<?php
/**
 * The template for displaying archive pages
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package understrap
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();

$container = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_attr( $container ); ?>" id="content" tabindex="-1">

		<div class="">

			<!-- Do the left sidebar check -->
			<?php get_template_part( 'global-templates/left-sidebar-check' ); ?>

        </div>
			<main class="site-main" id="main">
<?php if ( have_posts() ) : ?>

    <header class="page-header">
      <?php
      the_archive_title( '<h1 class="page-title">', '</h1>' );
      the_archive_description( '<div class="taxonomy-description">', '</div>' );
      ?>
    </header><!-- .page-header -->

                <div id="vue-app">
                    <initiative-filter></initiative-filter>
                    <initiative-list></initiative-list>
                </div>

<script type="x-template" id="initiative-filter">
<div class="filter"></div>
</script>
<script type="x-template" id="initiative-list">
    <div class="row initiative-listing">
        <div v-for="(item, i) in initiatives" class="col-md-3 col-12 large" :id="'item_'+i">
            <div><a :href="item.link" v-html="item.img"></a></div>
            <div class="initiative">
                <div class="date">{{item.date}}</div>
                <h4><a :href="item.link">{{item.title}}</a></h4>
                <p class="excerpt"><a :href="item.link">{{item.excerpt}}</a></p>
                <a :href="item.link" class="link">{{item.readmore}}</a>
            </div>
        </div>
    </div>
</script>
<script>
const eventBus = new Vue();

Vue.component('initiative-filter', {
  template: '#initiative-filter',
  data: function () {
    return {}
  }
});

Vue.component('initiative-list', {
  template: '#initiative-list',
  data: function () {
    return {
          initiatives: []
        }
  },
  created: function () {
    var obj = {
      action:	'get_initiatives',
      lang: '<?php echo get_locale(); ?>',
    };
    this.$http.post(coronadenktank.ajax_url, obj, {emulateJSON: true}).then((response) => {
      eventBus.$emit('show-loader',false);
      this.initiatives = response.body.initiatives;
    });
  }
});

var app = new Vue({
  el: '#vue-app'
});

</script>


				<?php else : ?>

					<?php get_template_part( 'loop-templates/content', 'none' ); ?>

				<?php endif; ?>

			</main><!-- #main -->

			<!-- The pagination component -->
			<?php understrap_pagination(); ?>

			<!-- Do the right sidebar check -->
			<?php get_template_part( 'global-templates/right-sidebar-check' ); ?>

		</div> <!-- .row -->

	</div><!-- #content -->

	</div><!-- #archive-wrapper -->

<?php get_footer();
