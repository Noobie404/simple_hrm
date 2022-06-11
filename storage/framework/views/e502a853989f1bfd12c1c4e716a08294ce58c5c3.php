
<div class="invoice">
  <div class="heeading">
    <div class="invo"><b><?php echo __('Attendance Sheet'); ?></b></div></div>
    <div class="row">
      <div class="column">
        
        <img src="<?php echo asset('public/profile_picture/'.auth()->user()->avatar); ?>" class="img"><br><br><br>
        
        <?php $users= \App\User::all();
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
        <b>
        <?php echo __('EMP ID NO:'); ?> <?php echo $empid; ?><br>
        
        <?php echo __('Name:'); ?> <?php echo $empname; ?><br>
        <?php $desig= \App\Designation::find($designation)->designation;?>
        <?php echo __('Designation:'); ?> <?php echo $desig; ?><br>
        </b>
        
        
      </div>
      
      <div class="column">
      </div>
      <div class="column">
        <br>
        <p>
          <?php echo __('Date of Birth:'); ?> <?php echo $datebirth; ?><br>
          <?php echo __('Joining Date:'); ?> <?php echo $joindate; ?><br>
          <?php echo __('Contact:'); ?> <?php echo $contact; ?><br>
          <?php echo __('Present Address:'); ?> <?php echo $prsaddress; ?><br>
        <?php echo __('Permanent Address:'); ?> <?php echo $prmaddress; ?></p>
      </div>
    </div>
    
    <div class="row">
      <table class="mytable" border="1">
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
            <td><?php echo __('ATTD'); ?><?php echo $attd->id; ?></td>
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
            <th colspan="7"><?php echo __('Total'); ?></th>
            <th><?php echo $attendance->count(); ?> days</th>
          </tr>
          <tr>
            <th colspan="7"><?php echo __('Total'); ?></th>
            <th><?php echo $attds->count(); ?> <?php echo __('Present'); ?></th>
          </tr>
          <tr>
            <th colspan="7"><?php echo __('Total'); ?></th>
            <th><?php echo $abs->count(); ?> <?php echo __('Absence'); ?></th>
          </tr>
        </tbody>
      </table>
      
      <div class="column1">
      </div>
      <div class="column1">
      </div>
      <div class="column1">
        
        
      </div>
    </div>
    <div class="row">
      <div class="column1">
      </div>
      <div class="column1">
        
      </div>
      <div class="column1"><br><br><br><br>
        <b>-------------</b><br>
        <b><?php echo __('Authorized'); ?></b><br>
      </div>
    </div>
    <br>
    <p><?php echo __('Please contact us for more information about payment options'); ?></p>
    <p><?php echo __('Thank you for your booking'); ?></p>
    <div class="heeading"></div>
  </div>