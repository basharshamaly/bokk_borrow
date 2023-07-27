<?php

namespace App\Http\Controllers;

use App\Models\doctors;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = doctors::OrderBy('id', 'desc')->paginate(10);
        return response()->view('cms.doctor.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $doctors = doctors::FindOrFail($id);
        return response()->view('cms.doctor.edit', compact('doctors'));
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
            $doctors = doctors::findOrFail($id);

            $doctors->faculty = $request->input('faculty');
            $doctors->mobile = $request->input('mobile');


            $updated = $doctors->save();
            if ($updated) {
                $users = $doctors->user;
                $users->name = $request->input('name');
                $users->Password = $request->input('Password');


                $users->actor()->associate($doctors);
                $isupdated = $users->save();

                return ['redirect' => route('doctors.index')];
            } else {
                return response()->json([
                    'icon' => 'error',
                    'title' => ' failed process update doctors user ',
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
        //
    }
}
