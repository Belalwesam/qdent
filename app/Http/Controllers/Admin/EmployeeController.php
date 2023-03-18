<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Employee;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $page_title = __("List of Employees");
        $page_description = __("View all Employees");
        $data =  Employee::query();
        if ($request->ajax()) {

            return DataTables::of($data)
                ->addColumn('action', function ($data) {
                    $button = '  <a href="' . route('employee.edit', $data) . '" data-href="' . route('employee.edit', $data) . '" data-entity_id="' . $data->id . '"  class="btn  btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Edit">
                                                     <i class="fa fa-edit"></i> </a>';


                    $button .= '<a href="javascript:;" data-href="' . route('employee.deletes', $data->id) . '" data-entity_id="' . $data->id . '" data-token="' . csrf_token() . '" class="btn delete-btn btn-sm btn-clean btn-icon" data-toggle="tooltip" title="Delete">
                            <i class="fa fa-trash"></i>
                        </a>';
                    return $button;
                })->addColumn('created_at', function ($data) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('Y-m-d');
                })
                ->rawColumns(['action', 'order'])
                ->make(true);
        }
        return view('admin.employee.datatables', compact('page_title', 'page_description', 'data'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Create Employee Form
        $page_title = __("Create Employee");
        $page_description = __("Create New Employee");

        return view('admin.employee.create', compact('page_title', 'page_description'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Store Employee
        $validator = \Validator::make($request->all(), [
            'phone' => ['numeric'],
            'email' => ['email', 'unique:employees'],
            'name' => ['string'],
            'job_position' => ['string'],
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->messages()->first()
            ], 403);
        }
        $emolyee = new Employee();
        $emolyee->fill($request->all());

        if ($request->img != null) {
            $path = $request->img->store('employees/imgs');
            $emolyee->img = $path;
        }
        $status =  $emolyee->save();


        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'Added was successfully   ',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'فشل الحفظ رجاء محاوله مرة أخرى',
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);
        // Edit Employee Form
        $page_title = __("Edit Employee");
        $page_description = __("Edit Employee");
        return view('admin.employee.catEdit', compact('page_title', 'page_description', 'employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $validator = \Validator::make($request->all(), [
            'phone' => ['numeric'],
            'email' => ['email'],
            'name' => ['string'],
            'job_position' => ['string'],
        ]);
        // costume validator for phone  countery

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => $validator->messages()->first()
            ], 403);
        }
        $employee = Employee::find($request->id);
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->whatsapp = $request->whatsapp;
        $employee->job_position = $request->job_position;
        if ($request->img != null) {
            $path = $request->img->store('employees/imgs');
            $employee->img = $path;
        }
        $status = $employee->save();
        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'Updated was successfully   ',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'فشل التعديل رجاء محاوله مرة أخرى',
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee, Request $request)
    {
        //
        $employee    =   Employee::find($request->id);
        $status      =   $employee->delete();
        if ($status) {
            return response()->json([
                'status'  => true,
                'message' => 'Deleted was successfully   ',
            ]);
        } else {
            return response()->json([
                'status'  => false,
                'message' => 'فشل الحذف رجاء محاوله مرة أخرى',
            ]);
        }
    }
}
