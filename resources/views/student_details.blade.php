<?php
if(Auth::user()->user_type=='Student' ){ ?>

<?php

// print_r($user_details);
?>

<div class="container">
    <div class="row">
       <div class="col-md-12">
        <div class="card mt-5">
            <div class="card-body">
                @if ($message = Session::get('success'))
        <div class="alert alert-success alert-block">
            <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
        </div>
        @endif
              <h5 class="card-title">Details</h5>
              <?php if($user_details){  ?>
              <form action="{{route('update_profile_data')}}" method="post" enctype="multipart/form-data">
              <?php }else{ ?>
                <form action="{{route('update_profile')}}" method="post" enctype="multipart/form-data">
                <?php } ?>

                @csrf
                <input type="hidden" value="{{Auth::user()->id}}" name="student_id" >
                <div class="form-group">
                    <label for="Address">Address</label>
                    <input type="text" class="form-control" placeholder="Address" name="address" value='<?php if($user_details){ echo $user_details->address; } ?>' required>
                </div>
                <div class="form-group">
                    <label for="">Profile Picture</label>

                                    <input type="file" class="form-control" placeholder="profile" name="image" value='<?php if($user_details){ echo $user_details->profile_picture; } ?>'>
                    <?php if($user_details){  ?><img src="/images/{{$user_details->profile_picture}}" width="200"> <?php  } ?>
                </div>
                <div class="form-group">
                    <label for="Address">Current school</label>
                    <input type="text" class="form-control" placeholder="current School" name="current_school" value='<?php if($user_details){ echo $user_details->current_school; } ?>' required>
                </div>
                <div class="form-group">
                    <label for="Address">Previous school</label>
                    <input type="text" class="form-control" placeholder="Previous School" name="previous_school" value='<?php if($user_details){ echo $user_details->previous_school; } ?>' required>
                </div>
                <div class="form-group">
                    <label for="Address">Parents Details</label>
                    <input type="text" class="form-control" placeholder="Parents Details" name="parents_details" value='<?php if($user_details){ echo $user_details->parents_details; } ?>' required>
                </div>
                <div class="form-group">
                    <input type="submit" class="btn btn-success" value="Save Details">
                </div>
            </form>
            </div>
       </div>
        </div>
        </div>
    </div>

<?php }

?>
