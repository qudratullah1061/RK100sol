
<!-- BEGIN PAGE HEADER-->
<!-- BEGIN PAGE BAR -->
<div class="page-bar">
    <ul class="page-breadcrumb">
        <li>
            <a href="index.html">Home</a>
            <i class="fa fa-circle"></i>
        </li>
        <li>
            <span>Dashboard</span>
        </li>
    </ul>
</div>
<!-- END PAGE BAR -->
<!-- BEGIN PAGE TITLE-->
<h1 class="page-title"> Konsorts Dashboard
    <small>Total Memberships, Service Members, Guest Members , Pending Approval Accounts</small>
</h1>
<!-- END PAGE TITLE-->
<!-- END PAGE HEADER-->
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-green-sharp">
                        <span data-counter="counterup" data-value="<?php echo isset($total_payment) ? $total_payment : 0; ?>"><?php echo isset($total_payment) ? $total_payment : 0; ?></span>
                        <small class="font-green-sharp">$</small>
                    </h3>
                    <small>TOTAL PAYMENTS</small>
                </div>
                <div class="icon">
                    <i class="fa fa-money"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 56%;" class="progress-bar progress-bar-success green-sharp">
                        <span class="sr-only">56% progress</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> progress </div>
                    <div class="status-number"> 56% </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-red-haze">
                        <span data-counter="counterup" data-value="<?php echo isset($total_companions) ? $total_companions : 0; ?>"><?php echo isset($total_companions) ? $total_companions : 0; ?></span>
                    </h3>
                    <small>SERVICE MEMBERS</small>
                </div>
                <div class="icon">
                    <i class="icon-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 20%;" class="progress-bar progress-bar-success red-haze">
                        <span class="sr-only">20% completed</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> completed </div>
                    <div class="status-number"> 20% </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-blue-sharp">
                        <span data-counter="counterup" data-value="<?php echo isset($total_guests) ? $total_guests : 0; ?>"><?php echo isset($total_guests) ? $total_guests : 0; ?></span>
                    </h3>
                    <small>GUEST MEMBERS</small>
                </div>
                <div class="icon">
                    <i class="icon-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 20%;" class="progress-bar progress-bar-success blue-sharp">
                        <span class="sr-only">20% completed</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> completed </div>
                    <div class="status-number"> 20% </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat2 ">
            <div class="display">
                <div class="number">
                    <h3 class="font-purple-soft">
                        <span data-counter="counterup" data-value="<?php echo isset($users_this_month) ? $users_this_month : 0; ?>"><?php echo isset($users_this_month) ? $users_this_month : 0; ?></span>
                    </h3>
                    <small>USERS THIS MONTH</small>
                </div>
                <div class="icon">
                    <i class="icon-users"></i>
                </div>
            </div>
            <div class="progress-info">
                <div class="progress">
                    <span style="width: 30%;" class="progress-bar progress-bar-success purple-soft">
                        <span class="sr-only">30% change</span>
                    </span>
                </div>
                <div class="status">
                    <div class="status-title"> change </div>
                    <div class="status-number"> 30% </div>
                </div>
            </div>
        </div>
    </div>
</div>
