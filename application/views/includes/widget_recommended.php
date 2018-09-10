<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/22/2018
 * Time: 6:26 PM
 */
?>

<?php if (!empty($recommendations)): ?>
<!-- widget -->
<div class="widget">
    <h4 class="widget-title">Recomandari</h4>
    <ul class="list-unstyled recommended-posts">
        <?php foreach ($recommendations as $recommendation): ?>
            <li>
                <div class="post-entry-sidebar clearfix">
                    <a href="#" class="left">
                        <img src="<?php echo assets_uploads_files_url() . strtolower(str_replace(' ', '', $recommendation['company_name'])) . '/' . $recommendation['poster']; ?>"
                             class="img-responsive img-centered thumbnail-img">
                    </a>
                    <div class="right">
                        <h4 class="media-heading post-title"><a href="#"><?php echo $recommendation['title']; ?></a></h4>
                        <span class="timestamp"><?php echo $recommendation['creation_date']; ?></span>
                    </div>
                </div>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- end widget -->
<?php endif; ?>
