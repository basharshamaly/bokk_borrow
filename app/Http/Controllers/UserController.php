<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\doctors;
use App\Models\Employee;
use App\Models\Student;
use App\Models\User;
use Dotenv\Validator;
use Faker\Documentor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use League\CommonMark\Node\Block\Document;
use Symfony\Component\HttpFoundation\Response;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::orderBy('id', 'desc')->paginate(10);
        return response()->view('cms.employee.index', compact('employees'));
        // $users = User::OrderBy('id', 'desc')->paginate(10);
        // return response()->view('cms.user.index', compact('users'));
    }
    public function create_view()
    {

        $users = User::all();
        $employees = Employee::all();

        return response()->view('cms.user.create', compact('employees', 'users'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()

    {
        // $users = User::all();
        // return response()->view('cms.user.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function  storeis($usertype, Request $request)
    // {


    //     // افحص نوع المستخدم المطلوب
    //     if ($request->input('user' === 'student')) {
    //         // إنشاء مستخدم ومعلومات Student
    //         $users = new User();
    //         $users->name = $request->input('name');
    //         $users->username = $request->input('username');
    //         $users->password = Hash::make($request->input('password'));
    //         $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');


    //         $students = new Student();
    //         $students->faculty = $request->input('faculty');
    //         $students->university_id = $request->input('university_id');
    //         // $students->university_id = 1111111;
    //         // $students->user_id = 2;
    //         // $students->user_id = $request->input('user_id_std');
    //         // $students->user_id = 11;
    //         $users->actor()->associate($students);
    //         $students->save();
    //         $users->save();

    //         // return response()->json([
    //         //     'icon' => 'success',
    //         //     'title' => 'succefuly user student  type',
    //         // ], 400);
    //     } elseif ($request->input('user') === 'employee') {
    //         // إنشاء مستخدم ومعلومات Employee
    //         $users = new User();
    //         $users->name = $request->input('name');
    //         $users->username = $request->input('username');
    //         $users->password = Hash::make($request->input('password'));
    //         $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');


    //         $employees = new Employee();
    //         $employees->jop_title = $request->input('jop_title');
    //         $employees->user_id = $request->input('user_id');
    //         $users->actor()->associate($employees);
    //         $employees->save();
    //         $users->save();

    //         // return response()->json([
    //         //     'icon' => 'success',
    //         //     'title' => 'succefuly user employees  type',
    //         // ], 400);
    //     } elseif ($request->input('user') === 'doctor') {
    //         // إنشاء مستخدم ومعلومات Employee
    //         $users = new User();
    //         $users->name = $request->input('name');
    //         $users->username = $request->input('username');
    //         $users->password = Hash::make($request->input('password'));
    //         $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');


    //         $doctors = new doctors();
    //         $doctors->mobile = $request->input('mobile');
    //         $doctors->faculty = $request->input('faculty_doc');
    //         // $doctors->user_id = 12;
    //         // $doctors->user_id = $request->input('user_id_doc');
    //         $users->actor()->associate($doctors);
    //         $doctors->save();
    //         $users->save();
    //         // return response()->json([
    //         //     'icon' => 'success',
    //         //     'title' => 'succefuly user doctors  type',
    //         // ], 400);
    //     } else {
    //         // لم يتم تحديد نوع المستخدم بشكل صحيح
    //         return response()->json([
    //             'icon' => 'error',
    //             'title' => 'Invalid user type',
    //         ], 400);
    //     }
    // }
    public function  store($usertype, Request $request)
    {
        // افحص نوع المستخدم المطلوب
        if ($request->input('user') === 'student') {
            $users = new User();
            $users->name = $request->input('name');
            $users->username = $request->input('username');
            $users->password = Hash::make($request->input('password'));
            $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');
            $users->actor_type = "App\Models\Student";
            $users->save();

            $students = new Student();
            $students->faculty = $request->input('faculty');
            $students->university_id = $request->input('university_id');
            $students->user_id = $users->id;
            $students->save();
            $users->actor_id = $students->id;
            $users->save();
        } elseif ($request->input('user') === 'employee') {
            // إنشاء مستخدم ومعلومات Employee
            $users = new User();
            $users->name = $request->input('name');
            $users->username = $request->input('username');
            $users->password = Hash::make($request->input('password'));
            $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');
            $users->actor_type = "App\Models\Employee";
            $users->save();

            $employees = new Employee();
            $employees->jop_title = $request->input('jop_title');

            // dd($employees->toArray());
            $employees->user_id = $users->id;
            $employees->save();
            $users->actor_id = $employees->id;
            $users->save();
        } elseif ($request->input('user') === 'doctor') {
            // إنشاء مستخدم ومعلومات Employee
            $users = new User();
            $users->name = $request->input('name');
            $users->username = $request->input('username');
            $users->password = Hash::make($request->input('password'));
            $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');
            $users->actor_type = "App\Models\doctors";
            $users->save();

            $doctors = new doctors();
            $doctors->mobile = $request->input('mobile');
            $doctors->faculty = $request->input('faculty_doc');
            $doctors->user_id = $users->id;

            $doctors->save();
            $users->actor_id = $doctors->id;
            $users->save();
        } else {
            // لم يتم تحديد نوع المستخدم بشكل صحيح
            return response()->json([
                'icon' => 'error',
                'title' => 'Invalid user type',
            ], 400);
        }
        return response()->json([
            'icon' => 'success',
            'title' => "created usersss done",
        ], 200);
    }


    // {
    //     $validator = Validator($request->all(), [
    //         'name' => 'string|min:3',
    //         'username' => 'required',
    //         'password' => 'required',
    //         // 'jop_title' => 'string|min:3|nullable',
    //         // 'university_id' => 'required',
    //         'user_id' => 'nullable',
    //         // 'faculty' => 'string|min:3',
    //         // 'mobile' => 'required',

    //     ], [
    //         // 'jop_title' => 'jop title required'
    //     ]);

    //     if (!$validator->fails()) {




    //         $employees = new Employee();
    //         $students = new Student();
    //         // $doctors = new doctors();

    //         $employees->jop_title = $request->input('jop_title');
    //         $employees->jop_title = 'jop_title';
    //         $employees->user_id = $request->input('user_id');


    //         $students->faculty = $request->input('faculty');
    //         $students->university_id = $request->input('university_id');
    //         $students->user_id = 1;
    //         // $students->university_id = 12;



    //         //     //     $doctors = new doctors();
    //         //     //     $doctors->mobile = $request->input('mobile');
    //         //     //     $doctors->faculty_doc = $request->input('faculty_doc');



    //         $saved = $employees->save();
    //         $saved = $students->save();
    //         // if ($students) {

    //         // } else {
    //         // $saved = $employees->save();
    //         // }
    //         // $saved = $doctors->save();
    //         // $k=[$saved_1,$saved_2,$saved_1];

    //         if ($saved) {

    //             $users = new User();
    //             $users->name = $request->input('name');
    //             $users->username = $request->input('username');
    //             $users->password = Hash::make($request->input('password'));
    //             $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');

    //             $users->actor()->associate($students);
    //             $users->actor()->associate($employees);
    //             // $users->actor()->associate($doctors);

    //             $issaved = $users->save();

    //             if ($issaved) {
    //                 return response()->json([
    //                     'icon' => 'success',
    //                     'title' => 'succefuly process create  user Done_1',
    //                 ], 200);
    //             } else {
    //                 return response()->json([
    //                     'icon' => 'error',
    //                     'title' => 'failed process create  user_1 ',
    //                 ], 400);
    //             }
    //             return response()->json([
    //                 'icon' => 'success',
    //                 'title' => 'succefuly process create  user Done_2',
    //             ], 200);
    //         } else {
    //             return response()->json([
    //                 'icon' => 'error',
    //                 'title' => 'failed process create  user _2',
    //             ], 400);
    //         }
    //     } else {
    //         return response()->json([
    //             'icon' => 'error',
    //             'title' => 'failed process create  user _3',
    //         ], 400);
    //     }
    // }


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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $employees = Employee::destroy($id);
    }
}