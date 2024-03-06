<?php

function grant_table_rows($id, $item1, $item2, $item3, $read_status)
{
    $encodeId = urlencode($id);

    ?>
    <tr>
        <td>
            <a href="<?php echo "display-grant.php?query=$encodeId&read=$read_status" ?>">
                <?php echo $item1 ?>
            </a>
        </td>
        <td>
            <?php echo $item2 ?>
        </td>
        <td>
            <?php echo $item3 ?>
        </td>
        <td class="d-flex justify-content-center">
            <?php
            if ($read_status) {
                ?>
                <span class="badge bg-danger">Un Read</span>
                <?php
            } else {
                ?>
                <span class="badge bg-success">Read</span>
                <?php
            }
            ?>
        </td>
    </tr>
    <?php
}