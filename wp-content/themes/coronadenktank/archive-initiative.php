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


$terms = get_terms( array(
  'taxonomy' => 'initiatives_category',
  'hide_empty' => false,
) );

array_unshift($terms, ["name" => __("all initiatives","coronadenktank"),"term_id" => "all"]);

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
<div class="filter">
    <p>Filter op: <a href="#" v-for="(term, i) in terms" v-on:click.stop.prevent="filterby(i);"  v-bind:class="[{active: i === activeItem}, 'term','px-3']" :id="'term_'+i" >{{term.name}}</a></p>
</div>
</script>
<script type="x-template" id="initiative-list">
    <div class="row initiative-listing">
        <div v-show="loading" class="col-12 initiatives-placeholder">
            <div v-show="loading" class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <div v-for="(item, i) in filteredInitiatives" class="col-md-3 col-12 large" :id="'item_'+i">
            <div><a :href="item.link" v-html="item.img"></a></div>
            <div class="initiative">
                <div class="date">{{item.date}}</div>
                <h4 class="title"><a :href="item.link">{{item.title}}</a></h4>
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
    return {
      activeItem: 0,
      terms: <?php print(json_encode($terms));?>,
    }
  },
  methods: {
    filterby: function(i) {
      this.activeItem = i;
      eventBus.$emit('filter-by-termid', this.terms[i].term_id);
    }
  }
});

Vue.component('initiative-list', {
  template: '#initiative-list',
  data: function () {
    return {
          loading: true,
          initiatives: [],
          filteredInitiatives: [],
          term: "all"
        }
  },
  created: function () {
    eventBus.$on('filter-by-termid', (termid) => {
      this.term = termid;
      this.filterInitiatives();
    });
    var obj = {
      action:	'get_initiatives',
      lang: '<?php echo get_locale(); ?>',
    };
    this.$http.post(coronadenktank.ajax_url, obj, {emulateJSON: true}).then((response) => {
      eventBus.$emit('show-loader',false);
      this.loading = false;
      this.initiatives = response.body.initiatives;
      this.filterInitiatives();
    });
  },
  methods: {
    filterInitiatives: function () {
        if (this.term === "all") {
          this.filteredInitiatives = this.initiatives;
        } else {
          this.filteredInitiatives = this.initiatives.filter((initiative) => {
            if (initiative.terms) {
              return initiative.terms.find(term => term.term_id == this.term) != undefined;
            }
            return false;
          });
        }
    }
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
