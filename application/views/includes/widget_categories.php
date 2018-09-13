<?php
/**
 * Created by PhpStorm.
 * User: Mihai
 * Date: 8/22/2018
 * Time: 6:27 PM
 */
?>

<?php if (!empty($categories)): ?>
<!-- widget -->
<div class="widget">
    <h4 class="widget-title">Categorii</h4>
    <ul class="list-unstyled category-list">
        <?php foreach ($categories as $category): ?>
        <li>
            <a href="<?php echo base_url() . 'categorie/' . $category['id_category']; ?>"><?php echo $category['name'] . ($category['articles_number'] > 1 ? ' (' . $category['articles_number'] . ')' : '');  ?></a>
        </li>
        <?php endforeach; ?>
    </ul>
</div>
<!-- end widget -->
<?php endif; ?>