<?php $__env->startSection('title', __('Update Attendance')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <h1>
           <?php echo __('ALREADY ATTENDANCED'); ?> 
        </h1>
        <ol class="breadcrumb">
            <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i><?php echo __('Dashboard'); ?>  </a></li>
            <li><a><?php echo __('Attendance'); ?> </a></li>
            <li class="active"><?php echo __('Update Attendance'); ?> </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title btn-danger"><?php echo __('Completed Attendance'); ?>  </h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                </div>
            </div>
            <div class="box-body">
                <div class="col-md-12">
                    <form action="<?php echo url('/hrm/attendance/set'); ?>" method="post">
                        <?php echo csrf_field(); ?>

                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-6">
                                <div class="input-group margin">
                                    <div class="input-group-addon"><i class="fa fa-calendar"></i></div>
                                    <input type="text" name="date" class="form-control" id="datepicker3" value="<?php echo $date; ?>">
                                    <span class="input-group-btn">
                                      <button type="submit" class="btn btn-info btn-flat"><i class="icon fa fa-arrow-right"></i> <?php echo __('Go'); ?></button>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
              <!-- /. end col -->
              <div class="col-md-12">
                <?php if(!empty(Session::get('message'))): ?>
                <div class="alert alert-success alert-dismissible" id="notification_box">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                    <i class="icon fa fa-check"></i> <?php echo Session::get('message'); ?>

                </div>
                <?php elseif(!empty(Session::get('exception'))): ?>
                <div class="alert alert-warning alert-dismissible" id="notification_box">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">??</button>
                    <i class="icon fa fa-warning"></i> <?php echo Session::get('exception'); ?>

                </div>
                <?php endif; ?>
            </div>
            <!-- /.Notification Box -->
            <form action="<?php echo url('/hrm/attendance/update'); ?>" name="attendance_update_form" method="post">
                <?php echo csrf_field(); ?>

                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th><?php echo __('SL#'); ?></th>
                            <th><?php echo __('Employee Name'); ?></th>
                            <th><?php echo __('Designation'); ?></th>
                            <th  class="text-center"><?php echo __('Attendance'); ?></th>
                            <th><?php echo __('Leave Category'); ?></th>
                            <th><?php echo __('In Time'); ?></th>
                            <th><?php echo __('Out Time'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php ($sl = 1); ?>
                        <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo $sl++; ?></td>
                            <td>
                                <a href="<?php echo url('/hrm/attendance/details/' . $employee['id']); ?>"><?php echo $employee['name']; ?></a>
                                <input type="hidden" name="user_id[]" value="<?php echo $employee['id']; ?>">
                                <input type="hidden" name="attendance_date[]" value="<?php echo $date; ?>">
                            </td>
                            <td><?php echo $employee['designation']; ?></td>
                            <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php if($employee['id'] == $attendance['user_id']): ?>
                            <input type="hidden" name="attendance_id[]" value="<?php echo $attendance['id']; ?>">

                            <td  class="text-center">
                                <div class="form-group">
                                    <div class="checkbox">
                                        <label>

                                            <?php if($attendance['attendance_status'] == 1): ?>
                                                <input type="hidden" name="attendance_status[]" value="1"><input checked type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                            <?php else: ?>
                                                <input type="hidden" name="attendance_status[]" value="0"><input type="checkbox" onclick="this.previousSibling.value=1-this.previousSibling.value">
                                            <?php endif; ?>
                                        </label>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <select name="leave_category_id[]" id="leave_category_id_<?php echo $employee['id']; ?>" class="form-control">
                                        <option selected value="0"><?php echo __('Select one'); ?></option>
                                        <?php $__currentLoopData = $leave_categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $leave_category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo $leave_category['id']; ?>"><?php echo $leave_category['leave_category']; ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>
                            </td>
                            <script type="text/javascript">
                                document.forms['attendance_update_form'].elements['leave_category_id_<?php echo $employee['id']; ?>'].value = "<?php echo $attendance['leave_category_id']; ?>";
                            </script>
                            <td>
                                <div class="form-group">
                                    <input type="text" name="check_in[]" value="<?php echo $attendance['check_in']; ?>" class="form-control">
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="form-group">
                                        <input type="text" name="check_out[]" value="<?php echo $attendance['check_out']; ?>" class="form-control">
                                    </div>
                                </div>
                            </td>
                            <?php endif; ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td><button type="submit" class="btn btn-primary btn-flat pull-right"><i class="icon fa fa-edit"></i> <?php echo __('Update'); ?></button></td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
        <!-- /.box-body -->
    </div>
    <!-- /.box -->
</section>
<!-- /.content -->
</div>
<script type="text/javascript">
    $(document).ready(function(){

    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>