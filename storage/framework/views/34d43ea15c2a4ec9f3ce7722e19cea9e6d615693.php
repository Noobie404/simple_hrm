<?php $__env->startSection('title', __('Attendance Statement')); ?>
<?php $__env->startSection('main_content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
        <?php echo __('Attendance Statement'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
            <li><a>Attendance</a></li>
            <li class="active"><?php echo __('Attendance Statement'); ?></li>
        </ol>
    </section>
    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title"><?php echo __('Attendance Statement'); ?>    </h3>
                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="btn-body">
                    <a href="<?php echo url('/hrm/attendance/details/report/go'); ?>" class="tip btn btn-primary btn-flat"><i class="fa fa-plus"></i><?php echo __('add new Attendance Statement'); ?> </a>
                    
                    <form action="<?php echo url('/hrm/attendance/details/report/pdf'); ?>" method="get">
                        <?php echo csrf_field(); ?>

                        <input type="hidden" name="emp_id" value="<?php echo $empid; ?>">
                        <input type="hidden" name="date1" value="<?php echo $startdate; ?>">
                        <input type="hidden" name="date2" value="<?php echo $enddate; ?>">
                        
                        <button type="submit" class="tip btn btn-primary btn-flat"><?php echo __('PDF'); ?> </button>
                        
                    </form>
                </div>
                <hr>
                <!-- Notification Box -->
                <div class="col-md-12">
                    <?php if(!empty(Session::get('message'))): ?>
                    <div class="alert alert-success alert-dismissible" id="notification_box">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fa fa-check"></i> <?php echo Session::get('message'); ?>

                    </div>
                    <?php elseif(!empty(Session::get('exception'))): ?>
                    <div class="alert alert-warning alert-dismissible" id="notification_box">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fa fa-warning"></i> <?php echo Session::get('exception'); ?>

                    </div>
                    <?php endif; ?>
                </div>
                <!-- /.Notification Box -->
                
                <div class="st-left-body">
                    <h4>
                    <?php
                    $users= \App\User::all()->where('access_label', 2)->where('id', $empid);
                    foreach($users as $user){
                    $empname=$user->name;
                    $idno=$user->id_number;
                    $joindate=$user->joining_date;
                    $contact=$user->contact_no_one;
                    $datebirth=$user->date_of_birth;
                    $designation=$user->designation_id;
                    $prsaddress=$user->present_address;
                    $prmaddress=$user->permanent_address;
                    }
                    
                    ?>
                    <?php echo __('EMP ID NO:'); ?>  <?php echo $empid; ?><br>
                    <?php echo __('Name:'); ?> <?php echo $empname; ?><br>
                    <?php $desig= \App\Designation::find($designation)->designation;?>
                    <?php echo __('Designation:'); ?> <?php echo $desig; ?><br>
                    <?php echo __('Date of Birth:'); ?> <?php echo $datebirth; ?><br>
                    <?php echo __('Joining Date:'); ?> <?php echo $joindate; ?><br>
                    <?php echo __('Contact:'); ?> <?php echo $contact; ?><br>
                    </h4>
                </div>
                <div class="st-center-body">
                    <div class="img-body"><img src="<?php echo asset('public/profile_picture/'.auth()->user()->avatar); ?>" class="img"></div>
                    <h2><?php echo __('Attendence Statement'); ?></h2>
                    <center><b><?php echo date("F Y", strtotime($startdate)); ?> to <?php echo date("F Y", strtotime($enddate)); ?><br>
                    <?php $users= \App\User::all()->where('employee_id', $empid);
                    foreach($users as $user){
                    $empname=$user->name;
                    }
                    
                    ?>
                    
                    </b></center>
                </div>
                <div class="st-right-body">
                    <h4>
                    <?php echo __('Present Address: '); ?><?php echo $prsaddress; ?><br>
                    <?php echo __('Permanent Address:'); ?> <?php echo $prmaddress; ?>

                    
                    </h4>
                </div>
                <div id="printable_area">
                    
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th><?php echo __('SL'); ?></th>
                                <th><?php echo __('User ID'); ?></th>
                                <th><?php echo __('Attendend By'); ?></th>
                                <th><?php echo __('Attendance Date'); ?></th>
                                <th><?php echo __('Attendance Status'); ?></th>
                                <th><?php echo __('Leave Category'); ?></th>
                                <th><?php echo __('In Time'); ?></th>
                                <th><?php echo __('Out Time'); ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $sl=1;?>
                            <?php $__currentLoopData = $attendance; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attd): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo $sl++; ?></td>
                                <td>ATTD<?php echo $attd->id; ?></td>
                                <td><?php echo Auth::user()->name; ?></td>
                                <td><?php echo $attd->attendance_date; ?></td>
                                <td>
                                    <?php if($attd->attendance_status==1): ?>
                                    <b class="btn btn-success"><?php echo __('Present'); ?></b>
                                    <?php else: ?>
                                    <b class="btn btn-danger"><?php echo __('Absence'); ?></b>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if($attd->leave_category_id==0): ?>
                                    <b class="btn btn-primary"><?php echo __('No Leave'); ?></b>
                                    <?php else: ?>
                                    <b class="btn btn-success"><?php echo __('Leave'); ?></b>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $attd->check_in; ?></td>
                                <td><?php echo $attd->check_out; ?></td>
                                
                            </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th><?php echo __('Total'); ?></th>
                                <th><?php echo $attendance->count(); ?> days</th>
                            </tr>
                            <tr>
                                <th><?php echo __('Total'); ?></th>
                                <th><?php echo $attds->count(); ?> <?php echo __('Present'); ?></th>
                            </tr>
                            <tr>
                                <th><?php echo __('Total'); ?></th>
                                <th><?php echo $abs->count(); ?> <?php echo __('Absence'); ?></th>
                            </tr>
                        </tbody>
                    </table>
                    </div><!--printable-->
                    <div class="sign-body-l">-----------------------------------<br><?php echo __('Employee'); ?></div>
                    <div class="sign-body-r">-----------------------------------<br><?php echo __('Authorized'); ?></div>
                </div>
                <!-- /.box-body -->
            </div>
            <!-- /.box -->
        </section>
        <!-- /.content -->
    </div>
    <?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>