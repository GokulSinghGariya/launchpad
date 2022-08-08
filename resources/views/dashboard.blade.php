@extends('layouts.app')

@section('content')
    {{-- {{ Auth::user()->name }} {{ __('Dashboard') }} --}}
    {{-- Studets Details Form --}}

    @include('student_details')


    {{-- Student Details Form --}}


    {{-- Teachers Form --}}
    @include('teachers_details')

    @include('admin_dashboard')



    {{-- Modal --}}
    <div id="myModal_student" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Student Details</h4>
                    <button type="button" class="close" id="myModal_student_close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <span class="float"><img src="" id="profile_picture" alt="" width="100"></span>
                    <form action="{{ route('student.approve') }}" method="post" id="approve_student_form">
                        @csrf
                        <input type="hidden" id="id" name="id">
                        <input type="hidden" id="profile_pictures" name="profile_pictures">
                        <input type="hidden" id="student_id" name="student_id">
                        <div class="form-group">
                            <label for="Parents_detals"> Parents Detals</label>
                            <input class="form-control" type="text" id="parents_details" name="parents_details" required
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Current School</label>
                            <input class="form-control" type="text" id="current_school" name="current_school" required
                                readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Previous School</label>
                            <input class="form-control" type="text" id="previous_school" name="previous_school" required
                                readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <input class="form-control" type="text" id="address" name="address" required readonly>
                        </div>

                        <div class="form-group">

                            <input class="btn btn-danger" type="submit" value="Approve">
                        </div>
                        {{-- <input type="text" id="id"> --}}


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    {{-- Modal --}}
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Teachers Details</h4>
                    <button type="button" class="close" id="mymodal_close" data-dismiss="modal">&times;</button>

                </div>
                <div class="modal-body">
                    <span class="float"><img src="" id="teacher_profile_picture" alt=""
                            width="100"></span>
                    <form action="" method="post" id="approve_teacher_form">
                        @csrf
                        <input type="hidden" id="t_id" name="t_id">
                        <input type="hidden" id="teacher_profile_pictures" name="teacher_profile_pictures">
                        <input type="hidden" id="teacher_id" name="teacher_id">
                        <div class="form-group">
                            <label for="Parents_detals"> Experience</label>
                            <input class="form-control" type="text" id="teacher_experience" name="teacher_experience"
                                required readonly>
                        </div>
                        <div class="form-group">
                            <label for="Parents_detals"> Expertise</label>
                            <input class="form-control" type="text" id="teacher_expertise" name="teacher_expertise"
                                required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Current School</label>
                            <input class="form-control" type="text" id="teacher_current_school"
                                name="teacher_current_school" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Previous School</label>
                            <input class="form-control" type="text" id="teacher_previous_school"
                                name="teacher_previous_school" required readonly>
                        </div>

                        <div class="form-group">
                            <label for="">Address</label>
                            <input class="form-control" type="text" id="teacher_address" name="teacher_address"
                                required readonly>
                        </div>

                        <div class="form-group">

                            <input class="btn btn-danger" type="submit" value="Approve">
                        </div>
                        {{-- <input type="text" id="id"> --}}


                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    {{-- Teachers Form --}}
@endsection

@section('script')
    ;

    <script>
        $(".view_data_student").click(function() {
            // $('#approve_student_form').reset();
            $('#approve_student_form')[0].reset();
            $('#profile_picture').attr('src', '');
            var data = $(this).attr('data');
            $.ajaxSetup({
                headers: {
                    'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'student/details/' + data,
                method: 'get',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    console.log(response);
                    var res = JSON.parse(response.data);
                    console.log(res);
                    var id = res.id;
                    var student_id = res.student_id;
                    var student_address = res.address;
                    var student_profile = 'images/' + res.profile_picture;
                    var student_profile_ = res.profile_picture;
                    var parents_details = res.parents_details;
                    var previous_school = res.previous_school;
                    var current_school = res.current_school;


                    $('#id').val(id);
                    $('#student_id').val(student_id);
                    $('#parents_details').val(parents_details);
                    $('#current_school').val(current_school);
                    $('#previous_school').val(previous_school);
                    $('#profile_picture').attr('src', student_profile);
                    $('#profile_pictures').val(student_profile_);
                    $('#address').val(student_address);


                    var row = '<tr>';
                    row += '<th scope="row">' + res.student_id + '</th>';
                    row += '<td>' + res.address + '</td>';
                    row += '<td>' + res.profile_picture + '</td>';
                    row += '</tr>';

                    $('#Res_table').find('tbody').prepend(row);
                    // $(form).trigger("reset");
                    // $(modal).modal('hide');
                },
                error: function(response) {
                    console.log(response);
                }
            });

        });

        // teachers
        $(".view_data").click(function() {
            // $('#approve_student_form').reset();
            $('#approve_teacher_form')[0].reset();
            $('#teacher_profile_picture').attr('src', '');
            var data = $(this).attr('data');
            $.ajaxSetup({
                headers: {
                    'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: 'student/details/' + data,
                method: 'get',
                dataType: 'JSON',
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {

                    var res = JSON.parse(response.data);
                    console.log(res);
                    var id = res.id;
                    var teacher_id = res.teachers_id;
                    var teacher_address = res.address;
                    var teacher_profile = 'images/' + res.profile_picture;
                    var teacher_profile_ = res.profile_picture;
                    var teacher_experience = res.experience;
                    var teacher_expertise = res.expertise;
                    var teacher_previous_school = res.previous_school;
                    var teacher_current_school = res.current_school;


                    $('#t_id').val(id);
                    $('#teacher_id').val(teacher_id);
                    $('#teacher_experience').val(teacher_experience);
                    $('#teacher_expertise').val(teacher_expertise);
                    $('#teacher_current_school').val(teacher_current_school);
                    $('#teacher_previous_school').val(teacher_previous_school);
                    $('#teacher_profile_picture').attr('src', teacher_profile);
                    $('#teacher_profile_pictures').val(teacher_profile_);
                    $('#teacher_address').val(teacher_address);
                },
                error: function(response) {
                    console.log(response);
                }
            });

        });

        //teacher approve req
        $("#approve_teacher_form").submit(function(e) {
            //prevent Default functionality
            e.preventDefault();
            //do your own request an handle the results
            $.ajaxSetup({
                headers: {
                    'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('teacher.approve') }}',
                type: 'post',
                dataType: 'JSON',
                data: $("#approve_teacher_form").serialize(),
                success: function(response) {
                    //console.log(response);
                    $("#mymodal_close").trigger("click");
                    swal({
                        title: "Good job!!",
                        text: response.data,
                        icon: "success"
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(response) {
                    console.log(response.responseJSON.message);
                    swal("ooops!", response.responseJSON.message, "error");
                }
            });
        });
        // student_approve
        $("#approve_student_form").submit(function(e) {
            //prevent Default functionality
            e.preventDefault();
            //do your own request an handle the results
            $.ajaxSetup({
                headers: {
                    'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('student.approve') }}',
                type: 'post',
                dataType: 'JSON',
                data: $("#approve_student_form").serialize(),
                success: function(response) {
                    console.log(response);
                    $("#myModal_student_close").trigger("click");
                    swal({
                        title: "Good job!!",
                        text: response.data,
                        icon: "success"
                    }).then(function() {
                        location.reload();
                    });
                },
                error: function(response) {
                    console.log(response.responseJSON.message);
                    swal("oooops!!", response.responseJSON.message, "error");
                }
            });
        });
        // asign teacher
        $(".asign_teacher").change(function() {
            var teacher_name = $(this).val();
            var student = $(this).attr('student_id');
            console.log(teacher_name);
            console.log(student);
            $.ajaxSetup({
                headers: {
                    'X-CSSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: '{{ route('student.asign_teacher') }}',
                type: 'post',
                dataType: 'JSON',
                data: {
                    "_token": "{{ csrf_token() }}",
                    "teacher": teacher_name,
                    "student": student
                },
                success: function(response) {
                    console.log(response);
                    // swal({
                    //     title: "Good job!!",
                    //     text: response.data,
                    //     icon: "success"
                    // }).then(function() {
                    //     location.reload();
                    // });
                },
                error: function(response) {
                    console.log(response);
                }
            });

        });

        // notifications
            $.ajax({
            url: '{{ route('get_notifications') }}',
            type: 'get',
            dataType: 'JSON',
            success: function(response) {
                console.log(response.data.length);
                $('#count_notification').html(response.data.length);

                $.each(response.data, function(k, v) {
                    var res = JSON.parse(v.data);
                    console.log(res.name);
                    $('#res_notification').append('<a class="dropdown-item" id=' + v.id +
                        ' href="/read_notification/' + v.id + '">' + res.action +
                        ' Successfully</a>');
                });
            },
            error: function(response) {
                console.log("no");
                console.log(response);
            }
        });

    </script>
@endsection
