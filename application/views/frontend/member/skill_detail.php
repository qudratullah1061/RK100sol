
    <!-- BEGIN CONDENSED TABLE PORTLET-->
    <div class="portlet box red">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-picture"></i>Skill Details</div>
            <div class="tools">
                <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title=""> </a>
                <a href="javascript:;" class="reload" data-original-title="" title=""> </a>
                <a href="javascript:;" class="remove" data-original-title="" title=""> </a>
            </div>
        </div>
        <div class="portlet-body">
            <div class="table-scrollable">
                <table class="table table-condensed table-hover">
                    <thead>
                        <tr>
                            <th> # </th>
                            <th> Sub Category Name </th>
                            <th> Rate </th>
                            <th> Description </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; foreach ($sub_category_rates as $rate) { ?>
                            <tr>
                                <td> <?php echo $i; ?> </td>
                                <td> <?php echo getSubCategoryNameById($rate['sub_category_id']); ?> </td>
                                <td> <?php echo $rate['rate']; ?> </td>
                                <td> <?php echo $rate['description']; ?> </td>
                            </tr>
                        <?php $i++; } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn default" data-dismiss="modal">Close</button>
        </div>
    </div>
    <!-- END CONDENSED TABLE PORTLET-->