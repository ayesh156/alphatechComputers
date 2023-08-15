<?php

require "../connection.php";

$keyword = $_GET["k"];

if (!empty($keyword)) {
    $product_rs = Database::search("SELECT `product`.`id`, `product`.`title`, `product`.`price`, `product`.`qty`, `product`.`condition_id`, `product`.`status_id` FROM `product` INNER JOIN `brand_has_model` ON product.brand_has_model_id = brand_has_model.id INNER JOIN `brand` ON brand_has_model.brand_id = brand.id WHERE `title` LIKE '%" . $keyword . "%' OR `description` LIKE '%" . $keyword . "%' OR `brand`.`name` LIKE '%" . $keyword . "%'");
} else {
    $product_rs = Database::search("SELECT * FROM `product`");
}

$product_num = $product_rs->num_rows;

for ($x = 0; $x < $product_num; $x++) {

    $product_data = $product_rs->fetch_assoc();

?>
    <tr>
        <td><?php echo ($x + 1); ?></td>
        <td class="tm-product-name c-pointer" onclick="window.location = 'updateProduct.php?id=<?php echo $product_data['id']; ?>';"><?php echo $product_data["title"]; ?></td>
        <td>Rs.<?php echo $product_data["price"]; ?>.00</td>
        <td><?php echo $product_data["qty"]; ?></td>
        <?php

        if ($product_data["condition_id"] == 1) {

        ?>
            <td>Brand new</td>
        <?php
        } else {

        ?>
            <td>Used</td>
        <?php
        }
        ?>
        <td>
            <?php

            if ($product_data["status_id"] == 1) {
            ?>
                <button class="btn-red" id="pb<?php echo $product_data["id"]; ?>" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Deactive</button>
            <?php
            } else {
            ?>
                <button class="btn-blue" id="pb<?php echo $product_data["id"]; ?>" onclick="blockProduct('<?php echo $product_data['id']; ?>');">Active</button>
            <?php
            }
            ?>
        </td>
        <td>
            <a class="tm-product-delete-link" onclick="deleteProduct(<?php echo $product_data['id']; ?>);">
                <i class="far fa-trash-alt tm-product-delete-icon"></i>
            </a>
        </td>
    </tr>
<?php
}


?>