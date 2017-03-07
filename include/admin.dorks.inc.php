<?php $dataRow = showDorks('admin'); ?>
<section class="admin">
    <div class="admin_dorks">
        <?php
        if ($getDork != "no_data") {
            echo "<h2>Manage Dorks</h2>";    
        }
        ?>
        
        <table class="admin_table">
            <tr>
                <th class="data_col">First Name</th>
                <th class="data_col">Last Name</th>
                <th class="data_col">Dork Name</th>
                <th class="admin_col">Insert/Delete</th>
            </tr>
            
            <?php echo $dataRow; ?>
            
            <tr class="newdatarow">
                <td><input class="newdata" type="text" name="dork_first_name" value=""></td>
                <td><input class="newdata" type="text" name="dork_last_name" value=""></td>
                <td><input class="newdata" type="text" name="dork_dork_name" value=""></td>
                <td class="insertcell"><div class="insert hidden"></div></td>
            </tr>
        </table>
        
    </div>
</section>