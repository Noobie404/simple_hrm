<?php $__env->startSection('title', __('Add Expence')); ?>

<?php $__env->startSection('main_content'); ?>
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
     <?php echo __('ADD EXPENSES'); ?> 
    </h1>
    <ol class="breadcrumb">
      <li><a href="<?php echo url('/dashboard'); ?>"><i class="fa fa-dashboard"></i> <?php echo __('Dashboard'); ?></a></li>
      <li><a><?php echo __('HRM'); ?></a></li>
      <li><a href="<?php echo url('/hrm/expence/manage-expence'); ?>"><?php echo __('Add new expeses'); ?></a></li>
      <li class="active"><?php echo __('Add expeses'); ?></li>
    </ol>
  </section>

  <!-- Main content -->
  <section class="content">

    <!-- SELECT2 EXAMPLE -->
    <div class="box box-default">
      <div class="box-header with-border">
        <h3 class="box-title"><?php echo __('Add expeses'); ?></h3>

        <div class="box-tools pull-right">
          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
        </div>
      </div>
      <!-- /.box-header -->
      <form action="<?php echo url('/hrm/expence/store'); ?>" method="post" name="add_form_expence">
        <?php echo csrf_field(); ?>

        <div class="box-body">
          <div class="row">
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
              <?php else: ?>
              <p class="text-yellow"><?php echo __('Enter New Accounts details. All field are required.'); ?> </p>
              <?php endif; ?>
            </div>
            <!-- /.Notification Box -->

            <div class="col-md-6">

<input type="hidden" name="deletion_status" value="0">

          <label for="balance_amount"><?php echo __('Expense Date'); ?> <span class="text-danger">*</span></label>
            <div class="form-group">
              <input type="date" name="expense_date" id="theDate1" class="form-control">

            
            </div>

           
            <script type="text/javascript">
            var date = new Date();
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            if (month < 10) month = "0" + month;
            if (day < 10) day = "0" + day;
            var today = year + "-" + month + "-" + day;
            document.getElementById('theDate1').value = today;
            </script>
                                      

              <label for="employee_id"><?php echo __('Expense Purpose'); ?> <span class="text-danger">*</span></label>
            <div class="form-group<?php echo $errors->has('employee_id') ? ' has-error' : ''; ?> has-feedback">
              <select name="exp_purpose"  class="form-control">
                <option value="" selected disabled><?php echo __('Select one'); ?></option>
            <?php $expcats= \App\ExpPurpose::all()->where('created_by', Auth::user()->id);?>
                <?php $__currentLoopData = $expcats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $expcat): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo $expcat->exp_name; ?>"> <?php echo $expcat->exp_name; ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
               
              </select>
            
            </div>


            <label for="employee_id"><?php echo __('Employee Name'); ?> <span class="text-danger">*</span></label>
            <div class="form-group<?php echo $errors->has('employee_id') ? ' has-error' : ''; ?> has-feedback">
              <select name="employee_id"  class="form-control">
                <option value="" selected disabled><?php echo __('Select one'); ?></option>
                <?php $__currentLoopData = $employees; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $employee): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <option value="<?php echo $employee['id']; ?>"> <?php echo $employee['name']; ?> </option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php if($errors->has('employee_id')): ?>
              <span class="help-block">
                <strong><?php echo $errors->first('employee_id'); ?></strong>
              </span>
              <?php endif; ?>
            </div>
            <!-- /.form-group -->


              <label for="balance_amount"><?php echo __('Expense amount'); ?> <span class="text-danger">*</span></label>
            <div class="form-group<?php echo $errors->has('balance_amount') ? ' has-error' : ''; ?> has-feedback">
              <input type="text" name="exp_amount" id="balance_amount" class="form-control" value="<?php echo old('balance_amount'); ?>" placeholder="<?php echo __('Enter Balance amount..'); ?>">
              <?php if($errors->has('balance_amount')): ?>
              <span class="help-block">
                <strong><?php echo $errors->first('balance_amount'); ?></strong>
              </span>
              <?php endif; ?>
            </div>


            <label for="balance_amount"><?php echo __('Cheque No.?'); ?></label>
            <div class="form-group">
              <input type="text" name="cheque_no" class="form-control" value="<?php echo old('balance_amount'); ?>" placeholder="<?php echo __('Enter Cheque No.'); ?>">
            </div>


            </div>
            <!-- /.col -->
            <div class="col-md-12">
              <label for="remarks_if_any"><?php echo __('Remarks, if any'); ?> <span class="text-danger"></span></label>
              <div class="form-group<?php echo $errors->has('remarks_if_any') ? ' has-error' : ''; ?> has-feedback">
                <textarea class="textarea text-description" name="particular"  placeholder="<?php echo __('Enter Purchased Details..'); ?>"><?php echo old('remarks_if_any'); ?></textarea>
                <?php if($errors->has('remarks_if_any')): ?>
                <span class="help-block">
                  <strong><?php echo $errors->first('remarks_if_any'); ?></strong>
                </span>
                <?php endif; ?>
              </div>
              <!-- /.form-group -->
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.box-body -->
        <div class="box-footer">
          <a href="<?php echo url('/hrm/expence/manage-expence'); ?>" class="btn btn-danger btn-flat"><i class="icon fa fa-close"></i> <?php echo __('Cancel'); ?></a>
          <button type="submit" class="btn btn-primary btn-flat"><i class="icon fa fa-plus"></i> <?php echo __('Add expeses'); ?></button>
        </div>
      </form>
    </div>
    <!-- /.box -->


  </section>
  <!-- /.content -->
</div>
<script type="text/javascript">
document.forms['add_form_expence'].elements['publication_status'].value = "<?php echo old('publication_status'); ?>";
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('administrator.master', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>