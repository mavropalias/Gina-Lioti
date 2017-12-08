<?php get_header(); ?>

    <section>
        <div class="row column">
            <h1 class="title">Search recipes</h1>
        </div>

        <form action="/" method="get">
            <div class="row column">
                <label>Type a recipe or ingredient name:
                    <div class="input-group">
                        <input id="search"
                            class="input-group-field"
                            type="text"
                            name="s"
                            placeholder="e.g. tzatziki or beef"
                            value="<?php the_search_query(); ?>"
                            autofocus>
                        <div class="input-group-button">
                            <input type="submit" class="button" value="Search">
                        </div>
                    </div>
                </label>
            </div>
            <input type="hidden" name="post_type" value="recipe">
        </form>

        <div class="row column">
            <small>Suggestions:</small>
            <ul class="no-bullet">
                <li><a class="lead" href="/course/main">Mains</a></li>
                <li><a class="lead" href="/course/savoury">Savouries</a></li>
                <li><a class="lead" href="/course/sweet">Sweets</a></li>
                <li><a class="lead" href="/tag/vegetarian">Vegetarian recipes</a></li>
                <li><a class="lead" href="/tag/gluten-free">Gluten&ndash;free recipes</a></li>
            </ul>
        </div>

    </section>

<?php get_footer(); ?>