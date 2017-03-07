<?php $dataRow = showThings('admin'); ?>

<section class="admin">
    <div class="admin_things">
        <?php
        if (!isset($getThing) || $getThing != "no_data") {
            echo "<h2>Manage Things</h2>";
        }
        ?>
        
        <table class="admin_table">
            <tr>
                <th class="data_col">Thing Name</th>
                <th class="data_col description">Thing Description</th>
                <th class="admin_col">Insert/Delete</th>
            </tr>
            
            <?php echo $dataRow; ?>
            
            <tr class="newdatarow">
                <td><input class="newdata" type="text" name="thing_name" value=""></td>
                <td><input class="newdata description" type="text" name="thing_description" value=""></td>
                <td class="insertcell"><div class="insert hidden"></div></td>
            </tr>
        </table>
    </div>
</section>