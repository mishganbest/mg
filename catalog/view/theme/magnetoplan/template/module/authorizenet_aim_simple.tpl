<div class="simplecheckout-block" id="authorizenet_aim_simple">
    <div class="simplecheckout-block-heading"><?php echo $text_credit_card; ?></div>
    <?php if ($simple_create_order && $error_warning) { ?>
        <div class="simplecheckout-warning-block"><?php echo $error_warning ?></div>
    <?php } ?> 
    <div class="simplecheckout-block-content">
        <table class="form" id="authorizenet_aim_simple_inputs">
            <tr>
                <td><?php echo $entry_cc_owner; ?></td>
                <td><input type="text" onchange="customer_field_changed()" name="simple_cc_owner" value="<?php echo $simple_cc_owner ?>" /></td>
            </tr>
            <tr>
                <td><?php echo $entry_cc_number; ?></td>
                <td><input type="text" onchange="customer_field_changed()" name="simple_cc_number" value="<?php echo $simple_cc_number ?>" /></td>
            </tr>
            <tr>
                <td><?php echo $entry_cc_expire_date; ?></td>
                <td>
                    <select onchange="customer_field_changed()" name="simple_cc_expire_date_month">
                        <?php foreach ($months as $month) { ?>
                        <option value="<?php echo $month['value']; ?>" <?php echo $simple_cc_expire_date_month == $month['value'] ? ' selected="selected"' : '' ?>><?php echo $month['text']; ?></option>
                        <?php } ?>
                    </select>
                    /
                    <select onchange="customer_field_changed()" name="simple_cc_expire_date_year">
                        <?php foreach ($year_expire as $year) { ?>
                        <option value="<?php echo $year['value']; ?>" <?php echo $simple_cc_expire_date_year == $year['value'] ? ' selected="selected"' : '' ?>><?php echo $year['text']; ?></option>
                        <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><?php echo $entry_cc_cvv2; ?></td>
                <td><input onchange="customer_field_changed()" type="text" name="simple_cc_cvv2" value="<?php echo $simple_cc_cvv2 ?>" size="3" /></td>
            </tr>
        </table>
    </div>
</div>