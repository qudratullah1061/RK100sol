<!-- BEGIN CONDENSED TABLE PORTLET-->
<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
    <h4 class="modal-title">Skills Details</h4>
</div>
<div class="modal-body"> 
    <div class="portlet-body form">
        <div class="form-body">
            <div class="table-scrollable">
                <table class="table table-condensed table-bordered table-hover">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Sub Category Name </th>
                            <th> Rate </th>
                            <th> Description </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 1;
                        foreach ($sub_category_rates as $rate) {
                            ?>
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo getSubCategoryNameById($rate['sub_category_id']); ?> </td>
                                <td> <?php echo $rate['rate']; ?> </td>
                                <td> <?php echo $rate['description']; ?> </td>
                            </tr>
                            <?php
                            $i++;
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="button" class="btn default" data-dismiss="modal">Close</button>
</div>
<!--</div>-->
<!-- END CONDENSED TABLE PORTLET-->