<?php if($order['Order']['is_orderapproved']==0){ ?>
    <?php if($order['Order']['lightspeed_orderid']){ ?>
            <div style='width:100px;'><input type="button" value="Approve" onClick="$('#OrderId2Edit').val(<?php echo $order['Order']['id']; ?>); $('#OrderIsApproved').val(1); $('#OrderApprovalForm').submit();" /></div>
    <?php }else{ ?>
            <div style='width:100px;'><input type="button" value="Approve" disabled="true" /></div>
    <?php } ?>
<?php } else { ?>
        <div style='width:100px;'><i>Approved</i></div>
<?php } ?>