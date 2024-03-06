<?php

function display_table_rows($id ,$item1, $item2, $item3, $type)
{

    if ($type === "fund") {
        $link = "display-fund.php";
    } else {
        $link = "display-grant.php";
    }

    $encodeId = urlencode($id);

    ?>
    <tr>
        <td>
            <a href="<?php echo "$link?query=$encodeId" ?>">
                <?php echo $item1 ?>
            </a>
        </td>
        <td>
            <?php echo $item2 ?>
        </td>
        <td>
            <?php echo $item3 ?>
        </td>
    </tr>
    <?php
}