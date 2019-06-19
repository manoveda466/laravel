<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Session;
use PDF;

class masterController extends Controller
{
   public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
    	$getRecordsAll      =   student::get();
    
        return view('master', ['studentRecords' => $getRecordsAll]);
    }

    public function masterInsert(Request $request)
    {
    	$validatedData 	= 	$request->validate([
						        'student_name' 			=> 'required',
						        'student_phone' 		=> 'required',
						        'student_email' 		=> 'required',
                                'student_address'       => 'required',
						        'file_path' 		    => 'required'
						    	]);

        if($request->student_id == '')
        {
            // $file = $request->file('file_path');
            // $file->move(base_path('/upload'), $file->getClientOriginalName());

            // $path = public_path().'/upload/'.$file->getClientOriginalName();

            $path = $request->file('file_path')->store('upload');

    		$result 		=	Student::create([
    												'student_name'      => $request->student_name,
    												'student_phone'     => $request->student_phone,
    												'student_email'     => $request->student_email,
                                                    'student_address'   => $request->student_address,
    												'file_path'         => $path,
    											]);

            $data   = ['title' => 'Welcome to HDTuto.com'];
            $pdf    = PDF::loadView('myPDF', $data);
            $pdf->setEncryption('manoj');
            $pdf->save(storage_path('app/upload_pdf/myPDF.pdf'));
            
      
            //return $pdf->download('itsolutionstuff.pdf');

    		if($result)
    		{
    			Session::flash('message', 'Sucessfully Submited!!!'); 
    			Session::flash('alert-class', 'alert-success'); 
    			return redirect('/master');
    		}
        }
        else
        {

            $result         =   Student::where('student_id', $request->student_id)->update([
                                                    'student_name'      => $request->student_name,
                                                    'student_phone'     => $request->student_phone,
                                                    'student_email'     => $request->student_email,
                                                    'student_address'   => $request->student_address,
                                                ]);

            $data   = ['title' => 'Welcome to HDTuto.com'];
            $pdf    = PDF::loadView('myPDF', $data);
            $pdf->setEncryption('manoj');
            $pdf->save(storage_path('app/upload_pdf/myPDF.pdf'));
            
            if($result)
            {
                Session::flash('message', 'Sucessfully Updated!!!'); 
                Session::flash('alert-class', 'alert-success'); 
                return redirect('/master');
            }
        }
    }

    public function studentExport()
    {
        return Excel::download(new UsersExport, 'students.xlsx');
    }

    public function masterEdit($student_id)
    {
        $getRecordsAll      =   student::get();
        $getStudent         =   student::where('student_id', $student_id)->get();
    
        return view('master', ['studentDtails' => $getStudent->toArray(), 'studentRecords' => $getRecordsAll]);
    }

    public function masterDelete($student_id)
    {
        $result = student::where('student_id',$student_id)->delete();

        if($result)
        {
            Session::flash('message', 'Sucessfully Deleted!!!'); 
            Session::flash('alert-class', 'alert-danger'); 
            return redirect('/master');
        }
    }
}
