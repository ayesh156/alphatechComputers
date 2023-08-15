<?php

require "../connection.php";

$category_rs = Database::search("SELECT * FROM `category`");
$category_num = $category_rs->num_rows;

for ($x = 0; $x < $category_num; $x++) {

  $category_data = $category_rs->fetch_assoc();

?>
  <tr>
    <td class="tm-category-name c-pointer" style="height:65px" onclick="adminCategorySearch(<?php echo $category_data['id']; ?>)"><?php echo $category_data["name"]; ?></td>
  </tr>
<?php
}

?>