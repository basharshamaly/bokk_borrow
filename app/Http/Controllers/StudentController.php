<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $users = User::all();
        $students = Student::OrderBy('id', 'desc')->paginate(10);
        return response()->view('cms.student.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();

        $students = User::all();
        return response()->view('cms.student.create', compact('users', 'students'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {
        $validator = Validator($request->all(), [
            'university_id' => 'required|min:3|max:9',

        ], [
            'university_id' => 'jop_title should be  and min caructer 3 max caructer 3',

        ]);
        if (!$validator->fails()) {
            $students = new Student();
            $students->university_id = $request->input('university_id');
            $students->faculty = $request->input('faculty');


            $save = $students->save();
            if ($save) {
                $users = new User();
                $users->name = $request->input('name');
                $users->password = $request->input('password');
                // $users->MAX_BORROW_COUNT = $request->input('MAX_BORROW_COUNT');
                $users->actor()->associate($students);

                $isSave = $users->save();
                if ($isSave) {
                    return response()->json([
                        'icon' => 'success',
                        'title' => 'succefuly process create employee user Done',
                    ], Response::HTTP_OK);
                } else {
                    return response()->json([
                        'icon' => 'error',
                        'title' => ' failed process create employee user ',
                    ], Response::HTTP_BAD_REQUEST);
                }
                return response()->json([
                    'icon' => 'success',
                    'title' => 'succefuly process create employee user Done',
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => ' failed process create employee user ',
                ], Response::HTTP_BAD_REQUEST);
            }
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
        // $users = User::all();
        $students = Student::FindOrFail($id);
        return response()->view('cms.student.edit', compact('students'));
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
            'faculty' => 'required|min:3|max:9',

        ], [
            'faculty' => 'faculty should be  and min caructer 3 max caructer 3',

        ]);
        if (!$validator->fails()) {
            $students = Student::findOrFail($id);
            // $students->university_id = $request->input('university_id');
            $students->faculty = $request->input('faculty');
            // $employees->user_id = $request->input('user_id');

            $updated = $students->save();
            if ($updated) {
                $users = $students->user;
                $users->name = $request->input('name');
                $users->Password = $request->input('Password');
                // $users->username = $request->input('username');

                $users->actor()->associate($students);
                $isupdated = $users->save();

                return ['redirect' => route('students.index')];
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => ' failed process update students user ',
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
        $students = Student::destroy($id);
    }
}
