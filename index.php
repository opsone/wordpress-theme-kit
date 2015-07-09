<?php get_header(); ?>

    <header class="entry-header">
        <h1>Wordpress theme kit</h1>
        <p>Init empty theme for wordpress</p>
    </header><!-- .entry-header -->

    <article>
        <div class="entry-content">

            <h2>Composer</h2>
            <p>Use composer for add lib PHP.</p>

            <h2>Controller</h2>
            <p>
                Use a controller for all view Wordpress.<br />
                Samples:<br />
                    index.php -> IndexController.php<br />
                    single.php -> SingleController.php<br />
                    page.php -> PageController.php<br />
                    custom.php -> CustomController.php<br />
                    ...
            </p>

            <h2>Zend Framework 2</h2>
            <p>Create strong form and use filter/validator in frontoffice</p>
            <p>Return properties controller in view with Zend\View\Renderer\PhpRenderer()</p>

            <h2>Required</h2>
            <p>
                Meta-box plugin for create simple meta-box.<br />
                Site: <a href="http://www.deluxeblogtips.com/meta-box/getting-started">http://www.deluxeblogtips.com/meta-box/getting-started</a>
            </p>

            <h2>Optional</h2>
            <p>
                Use Options Framework plugin for administer your option theme(file: options.php).<br />
                Use of_get_option($id,$default) to return option values.<br />
                Site: <a href="http://wptheming.com/options-framework-plugin">http://wptheming.com/options-framework-plugin</a>
            </p>

            <hr />
        </div><!-- .entry-content -->
    </article>

    <form action="" method="post" enctype="multipart/form-data">
      <ul>
        <li><label><span>firstname</span><input name="firstname" type="text" value="" /></label></li>
        <li><label><span>url</span><input name="url" type="url" value="" /></label></li>
        <li><label><span>email</span><input name="email" type="email" value="" /></label></li>
        <li><label><span>cv</span><input name="cv" type="file" value="" /></label></li>
        <li><label><span>content</span><input name="content" type="text" value="" /></label></li>
        <li><label><span>int</span><input name="int" type="text" value="" /></label></li>
        <li><label><span>uppercase</span><input name="uppercase" type="text" value="" /></label></li>
        <li><input type="submit" value="send" /></li>
      </ul>
    </form>

<?php get_footer(); ?>
