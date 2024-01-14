<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use  Illuminate\Pagination\Paginator;
use Illuminate\Validation\ValidationException;
use App\Http\Resources\GeneralCollection;
use App\Models\Employee;
use App\Models\Task;


class TaskController extends Controller
{
    /** Add Employee */
    public function addEmployee(Request $request)
    {
        // dd($request->all());
        try{
            DB::beginTransaction();
            $editEmp = Employee::where('id',$request->contactNo)->first();
            if(empty($editEmp))
            {
                $addEmp = new Employee;
                $addEmp->name             = $request->name;
                $addEmp->contactNo        = $request->contactNo;
                $addEmp->jobTitle         = $request->jobTitle;
                $addEmp->status           = $request->status;
                $addEmp->save();
                DB::commit();
                return array('success' => true, 'msg'=>['Employee Added']);
            }else{
                $editEmp->name         = $request->name;
                $editEmp->contactNo    = $request->contactNo;
                $editEmp->jobTitle     = $request->jobTitle;
                $editEmp->status       = $request->status;
                $editEmp->update();

                DB::commit();
                return array('success' => true, 'msg'=>['Employee Updated']);
            }
        }catch(\Exception $e){
            DB::rollBack();
            return array('success' => false, 'msg'=>$e->errorInfo[2],'Exception'=>$e);
           
        }
    }
 
     /**  Employee List */
    public function getAllEmployee()
    {
        //return ChamberTable::orderBy('chamberName','ASC')->get();
        return new GeneralCollection(Employee::orderBy('created_at','DESC')->paginate(5)) ;
    }

    /** Employee Delete */
    public function deleteEmployee($employeeId)
    {
        // dd("hi");
        Employee::where('id',$employeeId)->delete();
        $checkEmployee= Employee::where('id',$employeeId)->first();
        if(empty($checkEmployee)){
            return array('success' => true, 'msg'=>['Employee Deleted']); 
        }
    }

    /**  Employee Edit*/
    public function getEmployeeDetails($employeeId)
    {
        return Employee::where('id',$employeeId)->first();
    }

     /** Update Employee */
    public function updateEmployee(Request $request)
    {
        // dd($request->all());
        try{
            DB::beginTransaction();

            $editChamber = Employee::where('id',$request->EmpId)->first();
           // dd($editChamber);
            $editChamber->name               = $request->name;
            $editChamber->contactNo          = $request->contactNo;
            $editChamber->jobTitle           = $request->jobTitle;
            $editChamber->status             = $request->status; 
            $editChamber->update();
            DB::commit();    

            return array('success' => true, 'msg'=>['Employee Updated']);

        }catch(\Exception $e)
        {
            return array('success' => false, 'msg'=>['Error']);
        }
    }

    /** Only Employee Name List */
    public function onlyEmployeesName(){
        $employeesName = Employee::where('status',1)->get();
        return $employeesName;
    }

    /** Add Task */
    public function addTask(Request $request)
    {
        //dd($request->all());
        $lastId = 0;
        $getId = Task::orderBy('id','DESC')->first();
        if(empty($getId)){
            $lastId = 0;
        }else{
            $lastId = intval(explode('-',$getId->taskId)[1]); #"TASK-000001";
        }
        $tid = $lastId+1; #new task id

        $employee_name = Employee::where('id',$request->employeeId)->first()->name;
        try{
            DB::beginTransaction();
           
            $addTask = new Task;
            $addTask->taskId          = "TASK-".str_pad($tid, 5, "0", STR_PAD_LEFT);
            $addTask->employeeId      = $request->employeeId;
            $addTask->employeeName    = $employee_name;
            $addTask->title           = $request->title;
            $addTask->description     = $request->description;
            $addTask->date            = $request->date;
            $addTask->status          = $request->status;
            $addTask->save();
            DB::commit();
            return array('success' => true, 'msg'=>['New Task Added']);
            
        }catch(\Exception $e){
            DB::rollBack();
            return array('success' => false, 'msg'=>$e->errorInfo[2],'Exception'=>$e);
           
        }
    }

    /**  Task List */
    public function getAllTask()
    {
        return new GeneralCollection(Task::orderBy('created_at','DESC')->paginate(10)) ;
    }

    /** Task Edit */
    public function getTaskDetails($taskId)
    {
        return Task::where('id',$taskId)->first();
    }

    /** Update Task */
    public function updateTask(Request $request)
    {
        //dd($request->all());
        $employee_name = Employee::where('id',$request->employeeId)->first()->name;
        try{
            DB::beginTransaction();

            $editTask = Task::where('id',$request->id)->first();
           $editTask->employeeId      = $request->employeeId;
           $editTask->employeeName    = $employee_name;
           $editTask->title           = $request->title;
           $editTask->description     = $request->description;
           $editTask->date            = $request->date;
           $editTask->status           = $request->status;
           $editTask->update();
            DB::commit();    

            return array('success' => true, 'msg'=>['Task Updated']);

        }catch(\Exception $e)
        {
            return array('success' => false, 'msg'=>['Error']);
        }
    }
    
    /** Delete Task */
    public function deleteTask($taskId)
    {
        Task::where('id',$taskId)->delete();
        $checkEmployee= Task::where('id',$taskId)->first();
        if(empty($checkEmployee)){
            return array('success' => true, 'msg'=>['Task Deleted']); 
        }
    }

    /** search Task */
    public function filterTask(Request $request){
        // dd($request->all());

        // $task_name = $request->taskName;
        // $date = $request->date;
        // $status = $request->status;

        if(!empty($request->taskName) && empty($request->date) && empty($request->status)){
            $filterData = Task::orderBy('created_at','DESC')->where('description','LIKE','%'.$request->taskName.'%')->paginate(2);
        }
        else if(!empty($request->date) && empty($request->taskName) && empty($request->status)){
            $filterData = Task::orderBy('created_at','DESC')->where('date','LIKE','%'.$request->date.'%')->paginate(2);
        }
        else if(empty($request->date) && empty($request->taskName) && !empty($request->status)){
            $filterData = Task::orderBy('created_at','DESC')->where('status','LIKE','%'.$request->status.'%')->paginate(2);
        }
       
        
        /** task & date */
        else if(!empty($request->taskName) && !empty($request->date) && empty($request->status)){
            $filterData = Task::orderBy('created_at','DESC')
                ->where('date','LIKE','%'.$request->date.'%')
                ->where('description','LIKE','%'.$request->taskName.'%')
                ->paginate(2);
        }
        /** task & status */
        else if(!empty($request->taskName) && !empty($request->status) && !empty($request->date)){
            $filterData = Task::orderBy('created_at','DESC')
                ->where('status','LIKE','%'.$request->status.'%')
                ->where('description','LIKE','%'.$request->taskName.'%')
                ->paginate(2);
        }
        /** status & date */
        else if(empty($request->taskName) && !empty($request->date) && !empty($request->status)){
            $filterData = Task::orderBy('created_at','DESC')
                ->where('date','LIKE','%'.$request->date.'%')
                ->where('status','LIKE','%'.$request->status.'%')
                ->paginate(2);
        } 

        else if(!empty($request->taskName) && !empty($request->date) && !empty($request->status) ){
            $filterData = Task::orderBy('created_at','DESC')
                ->where('description','LIKE','%'.$request->status.'%')
                ->where('date','LIKE','%'.$request->date.'%')
                ->where('status','LIKE','%'.$request->status.'%')
                ->paginate(2);
        }

        //dd($filterData);

        return new GeneralCollection($filterData);

        

        
        
    }

    /** Admin Total Task */
    public function getDashboardCard()
    {
        $data = array();
        $data['task'] = Task::count();
        return $data;
    }

    /** User Task List */
    public function userTaskDetails(Request $request){
        //dd($request->phone);
        $phone = $request->phone;
        $employee_count = Employee::where('contactNo',$phone)->count();
       
        if($employee_count > 0){
            $employee = Employee::where('contactNo',$phone)->first();
            $emp_id = $employee->id;
    
            return new GeneralCollection(Task::where('employeeId',$emp_id)->orderBy('created_at','DESC')->paginate(10)) ;
        }

    }

    /** User Total Task */
    public function getDashboardCardUser(Request $request,$phone)
    {

        $employee_count = Employee::where('contactNo',$phone)->count();
        if($employee_count > 0){

            $employee = Employee::where('contactNo',$phone)->first();
            $emp_id = $employee->id;

            $data = array();
            $data['task'] = Task::where('employeeId',$emp_id)->count();
            $data['activetask'] = Task::where('employeeId',$emp_id)->where('status',1)->count();
            $data['inactivetask'] = Task::where('employeeId',$emp_id)->where('status',2)->count();
            return $data;

        }

       
    }

    /** User Task Only Employee Name List */
    public function onlyUserEmployeesName($phone){
        $employee_count = Employee::where('contactNo',$phone)->count();
        if($employee_count > 0){
            $employee = Employee::where('contactNo',$phone)->first();
            $emp_id = $employee->id;

            $employeesName = Employee::where('id',$emp_id)->where('status',1)->get();
            return $employeesName;

        }
        
    }

     /** search Task */
     public function filterEmployee(Request $request){

        if(!empty($request->name) ){
            $filterData = Employee::orderBy('created_at','DESC')->where('name','LIKE','%'.$request->name.'%')->paginate(5);
        }

        return new GeneralCollection($filterData);
   
    }

    

}
