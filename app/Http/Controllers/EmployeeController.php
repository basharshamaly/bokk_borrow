<?php

namespace App\Http\Controllers;

use App\Models\doctors;
use App\Models\Employee;
use App\Models\Student;
use App\Models\User;
use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class EmployeeController extends Controller
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
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $employees = Employee::all();
        return response()->view('cms.employee.create', compact('users', 'employees'));
    }


    public function create_view()
    {

        $users = User::all();
        $employees = Employee::all();

        return response()->view('cms.employee.create', compact('employees', 'users'));
    }

    public function  store(Request $request)
    {
        $validator = Validator($request->all(), [
            'name' => 'string|min:3',
            'username' => 'required',
            'password' => 'required',
            'jop_title' => 'string|min:3',
            'user_id' => 'required',
            'faculty' => 'string|min:3',
            'mobile' => 'required',

        ], []);
        if (!$validator->fails()) {

            // $users = new User();
            // $users->name = $request->input('name');
            // $users->username = $request->input('username');
            // $users->password = hash::make($request->input('password'));
            // $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');


            $employees = new Employee();
            $students = new Student();
            $doctors = new doctors();

            $employees->jop_title = $request->input('jop_title');
            $employees->user_id = $request->input('user_id');

            $students->faculty = $request->input('faculty');
            $students->university_id = $request->input('university_id');


            $doctors->mobile = $request->input('mobile');
            $doctors->faculty_doc = $request->input('faculty_doc');

            $saved = $employees->save();
            $saved = $students->save();
            $saved = $doctors->save();
            // $k=[$saved_1,$saved_2,$saved_1];

            if ($saved) {


                $users = new User();
                $users->name = $request->input('name');
                $users->username = $request->input('username');
                $users->password = Hash::make($request->input('password'));
                $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');
                $users->actor()->associate($employees);
                $users->actor()->associate($students);
                $users->actor()->associate($doctors);

                $issave = $users->save();

                if ($issave) {
                    return response()->json([
                        'icon' => 'success',
                        'title' => 'succefuly process create  user Done',
                    ], 200);
                }

                // $users->actor()->associate($employees);
                // $users->actor()->associate($students);
                // $users->actor()->associate($doctors);

            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => ' failed process create  user ',
                ], 400);
            }
        }
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $validator = Validator($request->all(), [
    //         'jop_title' => 'string|min:3',
    //         'user_id' => 'required',
    //     ], [
    //         'jop_title' => 'jop_title should be string and min caructer 3',
    //         'user_id' => 'please user_id required',
    //     ]);
    //     if (!$validator->fails()) {
    //         $employees = new Employee();
    //         $employees->jop_title = $request->input('jop_title');
    //         $employees->user_id = $request->input('user_id');

    //         $saved = $employees->save();
    //         if ($saved) {
    //             $users = new User();
    //             $users->name = $request->input('name');
    //             $users->password = Hash::make($request->input('password'));
    //             $users->username = $request->input('username');
    //             $users->actor()->associate($employees);

    //             $isSave = $users->save();
    //             //     if ($isSave) {
    //             //         return response()->json([
    //             //             'icon' => 'success',
    //             //             'title' => 'succefuly process create employee user Done',
    //             //         ], Response::HTTP_OK);
    //             //     } else {
    //             //         return response()->json([
    //             //             'icon' => 'error',
    //             //             'title' => ' failed process create employee user ',
    //             //         ], Response::HTTP_BAD_REQUEST);
    //             //     }
    //             //     return response()->json([
    //             //         'icon' => 'success',
    //             //         'title' => 'succefuly process create employee user Done',
    //             //     ], Response::HTTP_OK);
    //         }
    //         // else {
    //         //     return response()->json([
    //         //         'icon' => 'error',
    //         //         'title' => ' failed process create employee user ',
    //         //     ], Response::HTTP_BAD_REQUEST);
    //         // }
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
        $users = User::all();
        $employees = Employee::FindOrFail($id);
        return response()->view('cms.employee.edit', compact('users', 'employees'));
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
        $validator = Validator($request->all(), [
            'jop_title' => 'string|min:3',

        ], [
            'jop_title' => 'jop_title should be string and min caructer 3',

        ]);
        if (!$validator->fails()) {
            $employees = Employee::findOrFail($id);
            $employees->jop_title = $request->input('jop_title');
            // $employees->user_id = $request->input('user_id');

            $updated = $employees->save();
            if ($updated) {
                $users = $employees->user;
                $users->name = $request->input('name');
                // $users->Password = $request->input('Password');
                // $users->username = $request->input('username');
                // $users->Password = $request->input('Password');
                $users->actor()->associate($employees);
                $isupdated = $users->save();
                // return redirect()->route('employees.index');
                return ['redirect' => route('employees.index')];
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => ' failed process update employee user ',
                ], Response::HTTP_BAD_REQUEST);
            }
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
        $employees = Employee::destroy($id);
    }
}