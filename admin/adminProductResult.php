<?php

require "../connection.php";

$product_rs = Database::search("SELECT * FROM `product`");
$product_num = $product_rs->num_rows;

for ($x = 0; $x < $product_num; $x++) {

    $product_data = $product_rs->fetch_assoc();

?>
    <tr>
        <th><?php echo ($x + 1); ?></th>
        <td class="tm-product-name c-pointer" onclick="window.location = 'editProduct.php?id=<?php echo $product_data['id']; ?>';"><?php echo $product_data["title"]; ?></td>
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
            <a class="tm-product-delete-link" onclick="deleteProduct(<?php echo $product_data['id']; ?>);">
                <i class="far fa-trash-alt tm-product-delete-icon"></i>
            </a>
        </td>
    </tr>
<?php
}
?>