<?php

require "../connection.php";

$keyword = $_GET["k"];

if(!empty($keyword)) {
    $user_rs = Database::search("SELECT * FROM `user` WHERE `email` LIKE '%" . $keyword . "%' OR `fname` LIKE '%" . $keyword . "%' OR `lname` LIKE '%" . $keyword . "%' OR `mobile` LIKE '%" . $keyword . "%'");
}else {
    $user_rs = Database::search("SELECT * FROM `user`");
}

$user_num = $user_rs->num_rows;

for ($x = 0; $x < $user_num; $x++) {

    $user_data = $user_rs->fetch_assoc();

?>
    <tr>
        <td><?php echo ($x + 1); ?></td>
        <td class="tm-user-name"><?php echo $user_data["fname"] . " " . $user_data["lname"]; ?></td>
        <td><?php echo $user_data["email"]; ?></td>
        <td><?php echo $user_data["mobile"]; ?></td>
        <?php
        $phpDateObject = strtotime($user_data["joined_date"]);
        $strDate = date('Y-m-d', $phpDateObject);
        ?>
        <td><?php echo $strDate; ?></td>
        <td>
            <?php

            if ($user_data["status"] == 1) {
            ?>
                <button class="btn-red" id="ub<?php echo $user_data["email"]; ?>" onclick="blockUser('<?php echo $user_data['email']; ?>');">Block</button>
            <?php
            } else {
            ?>
                <button class="btn-blue" id="ub<?php echo $user_data["email"]; ?>" onclick="blockUser('<?php echo $user_data['email']; ?>');">Unblock</button>
            <?php
            }
            ?>
        </td>
    </tr>
<?php
}
?>