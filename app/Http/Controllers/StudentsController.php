<?php

namespace App\Http\Controllers;

use App\Models\Students;
use App\Http\Requests\StoreStudentsRequest;
use App\Http\Requests\UpdateStudentsRequest;
use Symfony\Component\HttpFoundation\Request;

class StudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->query('search');

        if(!empty($search)){
            $dataStudents = Students::where('students.idstudents','like','%'.$search.'%')->orWhere('students.fullname','like','%'.$search.'%')->paginate(10)->onEachSide(2)->fragment('std');
        }else{
            $dataStudents = Students::paginate(10)->onEachSide(2)->fragment('std');
        }

        return view('students.data')->with([
            'students'=>$dataStudents,
            'search' => $search
        ]);
    }

    public function store(StoreStudentsRequest $request)
    {
        $validate = $request->validated();

        $students = new Students;
        $students ->idstudents = $request ->txtid;
        $students ->fullname = $request ->txtfullname;
        $students ->address = $request ->txtaddress;
        $students ->gender = $request ->txtgender;
        $students -> phone = $request ->txtphone;
        $students ->emailaddress = $request ->txtemail;
        $students -> save();

        return redirect ('students') ->with('msg','Add New Student Succesfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Students $students,$idstudents)
    {
        $data = $students ->find($idstudents);
        return view('students.formedit')->with ([
            'txtid' => $idstudents,
            'txtfullname'=>$data-> fullname,
            'txtaddress' =>$data->address,
            'txtemail'=>$data-> emailaddress,
            'txtphone' =>$data->phone,
            'txtgender'=>$data->gender,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Students $students)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentsRequest $request, Students $students,$idstudents)
    {
        $data = $students ->find($idstudents);
        $data ->idstudents = $request ->txtid;
        $data ->fullname = $request ->txtfullname;
        $data ->address = $request ->txtaddress;
        $data ->gender = $request ->txtgender;
        $data -> phone = $request ->txtphone;
        $data ->emailaddress = $request ->txtemail;
        $data -> save();

        return redirect ('students') ->with('msg','Data dengan nama students '.$data->fullname.' berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Students $students,$idstudents)
    {
        $data =$students->find($idstudents);
        $data->delete();
        return redirect ('students') ->with('msg','Data dengan nama students '.$data->fullname.' berhasil dihapus');
    }
}
