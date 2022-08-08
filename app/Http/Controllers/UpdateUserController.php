<?php

namespace App\Http\Controllers;

use App\Models\StudentDetails;
use App\Models\TeachersDetails;
use App\Models\User;
use App\Notifications\ProfileApproved;
use App\Notifications\ProfileComplete;
use App\Notifications\TeacherAsign;
use App\Notifications\UserRegisteration;
use Illuminate\Auth\Events\Failed;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UpdateUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // $userSchema=User::where('user_type','admin')->first();
        // $notify_now = [
        //     'name' => 'BOGO',
        //     'body' => 'You received an offer.',
        //     'thanks' => 'Thank you',
        //     'offerText' => 'Check out the offer',
        //     'offerUrl' => url('/'),
        //     'offer_id' => 007
        // ];
        // Notification::send($userSchema, new UserRegisteration($notify_now));
        // dd($userSchema->notifications);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = new StudentDetails;
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        if ($files = $request->file('image')) {
            $name = $files->getClientOriginalName();
            $files->move('images', $name);

            $data->profile_picture = $name;

            $data->student_id = $request->student_id;
            $data->address = $request->address;
            $data->current_school = $request->current_school;
            $data->previous_school = $request->previous_school;
            $data->parents_details = $request->parents_details;
        }
        $store = $data->save();
        if ($store) {


            return back()->with('success', 'You have successfully upload file.');
        }
    }
    public function teachers_store(Request $request)
    {

        $data = new TeachersDetails;
        $request->validate([
            'image' => 'required|mimes:jpg,png,jpeg|max:2048',
        ]);
        if ($files = $request->file('image')) {
            $name = $files->getClientOriginalName();
            $files->move('images', $name);

            $data->profile_picture = $name;

            $data->teachers_id = $request->teachers_id;
            $data->address = $request->address;
            $data->current_school = $request->current_school;
            $data->previous_school = $request->previous_school;
            $data->experience = $request->experience;
            $data->expertise = $request->expertise;
        }
        $store = $data->save();
        if ($store) {
            return back()->with('success', 'You have successfully upload file.');
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request->all());
        if ($files = $request->file('image')) {

            $name = $files->getClientOriginalName();
            $files->move('images', $name);
            // $data->profile_picture=$name;

            $affected = DB::table('students_details')
                ->where('student_id', $request->student_id)
                ->update([
                    'address' => $request->address,
                    'profile_picture' => $name,
                    'current_school' => $request->current_school,
                    'previous_school' => $request->previous_school,
                    'parents_details' => $request->parents_details,
                ]);
                // notify
                $userSchema=User::where('user_type','admin')->first();
                $notify_now = [
                    'id' => $request->student_id,
                    'action' => 'Student Details Updated',
                ];
                Notification::send($userSchema, new ProfileComplete($notify_now));

            return redirect()->back()->with('success', 'Details updated successfully');
        } else {
            $affected = DB::table('students_details')
                ->where('student_id', $request->student_id)
                ->update([
                    'address' => $request->address,
                    'current_school' => $request->current_school,
                    'previous_school' => $request->previous_school,
                    'parents_details' => $request->parents_details,
                ]);
                // Notify
                $userSchema=User::where('user_type','admin')->first();
                $notify_now = [
                    'id' => $request->student_id,
                    'action' => 'Student Details Updated',
                ];
                Notification::send($userSchema, new ProfileComplete($notify_now));
            return redirect()->back()->with('success', 'Details updated successfully');
        }

    }

    public function teachers_update(Request $request)
    {
        //dd($request->all());
        if ($files = $request->file('image')) {

            $name = $files->getClientOriginalName();
            $files->move('images', $name);
            // $data->profile_picture=$name;

            $affected = DB::table('teachers_details')
                ->where('teachers_id', $request->teachers_id)
                ->update([
                    'address' => $request->address,
                    'profile_picture' => $name,
                    'current_school' => $request->current_school,
                    'previous_school' => $request->previous_school,
                    'experience' => $request->experience,
                    'expertise' => $request->expertise,

                ]);
                // Notify
                $userSchema=User::where('user_type','admin')->first();
                $notify_now = [
                    'id' => $request->student_id,
                    'action' => 'Teacher Details Updated',
                ];
                Notification::send($userSchema, new ProfileComplete($notify_now));
            return redirect()->back()->with('success', 'Details updated successfully');
        } else {
            $affected = DB::table('teachers_details')
                ->where('teachers_id', $request->teachers_id)
                ->update([
                    'address' => $request->address,
                    'current_school' => $request->current_school,
                    'previous_school' => $request->previous_school,
                    'experience' => $request->experience,
                    'expertise' => $request->expertise,

                ]);
                // Notify
                $userSchema=User::where('user_type','admin')->first();
                $notify_now = [
                    'id' => $request->student_id,
                    'action' => 'Teacher Details Updated',
                ];
            return redirect()->back()->with('success', 'Details updated successfully');
        }
    }



    public function get_studenet_details($id)
    {

        $data = DB::table('users')->select('user_type', 'id')->where('id', $id)->first();

        if ($data->user_type == 'Student') {
            $student_data = DB::table('students_details')->where('student_id', $data->id)->first();
            $new_data = json_encode($student_data);

            return response()->json(array('data' => $new_data), 200);
        } else if ($data->user_type == 'Teacher') {
            $get_t_details = DB::table('teachers_details')->where('teachers_id', $data->id)->first();
            $teacher_data = json_encode($get_t_details);

            return response()->json(array('data' => $teacher_data), 200);
        } else {
            return response()->json(array('data' => 'Something went wrong'), 199);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function students_approve(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'student_id' => 'required',
            'address' => 'required',
            'current_school' => 'required',
            'parents_details' => 'required',
            'previous_school' => 'required',
            'student_id' => 'required',
            'profile_pictures' => 'required',
        ]);

        if ($validatedData) {
            // return response()->json(array('data' => $request->all()), 200);student_id
            if ($validatedData) {

                $approve = DB::table('users')->where('id', $request->student_id)
                    ->update([
                        'is_verified' => 1
                    ]);
                if ($approve) {
                    //notify
                $userSchema=User::where('id',$request->student_id)->first();
                $notify_now = [
                    'id' => $request->teacher_id,
                    'action' => 'Profile Approved',
                ];
                Notification::send($userSchema, new ProfileApproved($notify_now));
                // notify
                    return response()->json(array('data' => 'Student Approved Successfully!'), 200);
                }
            }
        } else {
            return response()->json(array('data' => 'Details Not completed!!'), 400);
        }
    }
    public function teachers_approve(Request $request)
    {
        // return response()->json(array('data' => $request->all()), 200);
        $validatedData = $request->validate([
            't_id' => 'required',
            'teacher_id' => 'required',
            'teacher_address' => 'required',
            'teacher_current_school' => 'required',
            'teacher_experience' => 'required',
            'teacher_expertise' => 'required',
            'teacher_previous_school' => 'required',
            'teacher_profile_pictures' => 'required',
        ]);
        if ($validatedData) {

            $approve = DB::table('users')->where('id', $request->teacher_id)
                ->update([
                    'is_verified' => 1
                ]);
            if ($approve) {
                //notify
                $userSchema=User::where('id',$request->teacher_id)->first();
                $notify_now = [
                    'id' => $request->teacher_id,
                    'action' => 'Profile Approved',
                ];
                Notification::send($userSchema, new ProfileApproved($notify_now));
                // notify
                return response()->json(array('data' => 'Teacher Approved Successfully!'), 200);
            }
        }
    }
    public function asign_teacher(Request $request)
    {
       // return response()->json(array('data' =>  $request->all()), 200);

        // $request->all();
        $teacher=$request->teacher;
        $student=$request->student;

        $approve = DB::table('students_details')->where('student_id',$student)
                ->update([
                    'asigned_teacher' => $teacher
                ]);
            if ($approve) {

                $userSchema=User::where('id',$student)->first();
                $notify_now = [
                    'name' => $userSchema->name,
                    'email'=>$userSchema->email,
                    'action' => 'Teacher Asigned',
                    'teacher_name' => $userSchema->teacher_name,
                ];
                Notification::send($userSchema, new TeacherAsign($notify_now));
                return response()->json(array('data' => 'Teacher Asigned Successfully!'), 200);
            }

    }

    public function read_notification($id)
    {
        $read=DB::table('notifications')->where('id',$id)
        ->update([
            'read_at'=>Carbon::now()->toDateTimeString()
        ]);
        if($read){
            return redirect()->back()->with('success', 'Removed successfully');

        }
    }
}
