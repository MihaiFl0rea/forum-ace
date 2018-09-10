<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/22/2018
 * Time: 6:28 PM
 */
?>

<?php if (!empty($tags)): ?>
<!-- widget -->
<div class="widget">
    <h3 class="widget-title">Tag-uri</h3>
    <ul class="list-inline tag-list">
        <?php foreach ($tags as $tag): ?>
        <li>
            <a href="<?php echo base_url() . 'tag/' . $tag['id_tag']; ?>"><?php echo $tag['name']; ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- end widget -->
<?php endif; ?>