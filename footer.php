    <?php 
        if (!is_page(['search', 'cooking-club', 'hello'])) {
            get_template_part( 'partial--get-in-touch' ); 
        }
    ?>

    <!-- COPYRIGHT -->
    <section>
        <div class="row">
            <div class="large-12 columns">
                <strong>Thank you!</strong> <br>
                <small>© Gina Lioti. All rights reserved.</small>
            </div>
        </div>
    </section>

    </main>
  
    <!-- wp_footer START -->
    <?php wp_footer(); ?>
    <!-- wp_footer END -->

    <!-- Google Analytics FOOTER -->
    <!-- ======================================================================= -->
    <script type="text/javascript">  (function() {
        var ga = document.createElement('script');     ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:'   == document.location.protocol ? 'https://ssl'   : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
        })();
    </script>

    </body>
</html>