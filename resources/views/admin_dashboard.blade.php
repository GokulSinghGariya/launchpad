<?php
if(Auth::user()->user_type=='admin' ){
   // print_r($teachers);

    ?>
   <div class="container">

<h1>Teachers</h1>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Email</th>
            <th>Action</th>
        </tr>
        <?php
            foreach ($teachers as $key => $teacher) {
                # code...

        ?>
        <tr>
            <td>{{ $key + 1 }}</td>
            <td>{{ $teacher->name }}</td>
            <td>{{ $teacher->email }}</td>
            <td>
                <?php if($teacher->is_verified!=null){
                    echo '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
                }else{ ?>
                <button class="btn btn-danger view_data" data-toggle="modal" data-target="#myModal" data-backdrop="static"
                    data-keyboard="false" data="{{ $teacher->id }}">View</button>

                <?php } ?>

            </td>
        </tr>

        <?php   } ?>
    </thead>
</table>

<h1>Students</h1>
<table class="table table-stripped">
    <thead>
        <tr>
            <th>SN</th>
            <th>Name</th>
            <th>Email</th>
            <th>Asign Teacher</th>
            <th>Action</th>


        </tr>
        <?php

        foreach ($students as $key => $student) {
            # code...

    ?>
        <tr>
            <td>{{ $key }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->email }}</td>
            <td>
                <select class="form-control asign_teacher" name="teacher" id="assign_teacher" student_id="{{$student->id}}">
                    <option value="">--select--</option>
                    <?php $teachs=DB::table('users')->where('user_type','Teacher')->get();
                    foreach ($teachs as $key => $teach) { ?>
                        <option value="{{$teach->name}}">{{$teach->name}}</option>
                    <?php } ?>
                </select>
            </td>
            <td>
                <?php if($student->is_verified!=null){
            echo '<span class="badge badge-success"><i class="fa fa-check"></i> Approved</span>';
        }else{ ?>
                <button class="btn btn-danger view_data_student" data-toggle="modal" data-target="#myModal_student"
                    data-backdrop="static" data-keyboard="false" data="{{ $student->id }}">View</button>

                <?php } ?>

            </td>

        </tr>

        <?php } ?>
    </thead>
</table>
   </div>
<?php }

?>
