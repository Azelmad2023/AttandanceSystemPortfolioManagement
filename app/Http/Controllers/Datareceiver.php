<?php

namespace App\Http\Controllers;

use App\Models\AttendanceResult;
use App\Models\Datareceiverattandances;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use PDF;

class Datareceiver extends Controller
{
    // public function index()
    // {
    //     return view('admin.index');
    // }
    public function index()
    {
        $today = date('Y-m-d');

        // Fetch the total number of teachers from the datareceiverattandances table
        $totalTeachers = Datareceiverattandances::where('day_date', $today)->distinct('teacher_name')->count('teacher_name');

        // Fetch the number of present teachers from the attendance_results table
        $numPresent = AttendanceResult::whereHas('teacherAttendance', function ($query) use ($today) {
            $query->where('day_date', $today);
        })->where('attendance_state', 'present')->count();

        // Fetch the number of absent teachers
        $numAbsent = AttendanceResult::whereHas('teacherAttendance', function ($query) use ($today) {
            $query->where('day_date', $today);
        })->where('attendance_state', 'absent')->count();

        return view('admin.index', compact('totalTeachers', 'numPresent', 'numAbsent'));
    }
    public function getDataFromApi()
    {
        // Make a GET request to the API endpoint
        $response = Http::get('http://localhost:3000/weeks');

        // Check if the request was successful
        if ($response->successful()) {
            // Extract the JSON data from the response body
            $data = $response->json();

            // Display the data using dd()
        } else {
            // Display an error if the request was not successful
            abort(500, 'Failed to fetch data from the API');
        }
    }


    public function storeDataFromApi()
    {
        $response = Http::get('http://localhost:3000/data');
        if ($response->successful()) {
            $data = $response->json();

            foreach ($data['weeks'] as $week) {
                // Iterate over days directly within each week
                foreach ($week['days'] as $day) {
                    // Create a new instance of the DataReceiverAttendance model
                    $attendance = new Datareceiverattandances();

                    // Assign values from the API data to the model attributes
                    $attendance->week_id = $week['week_number'];
                    $attendance->start_date = $week['start_date'];
                    $attendance->end_date = $week['end_date'];
                    $attendance->day_date = $day['date'];
                    $attendance->day_of_week = $day['day_of_week'];
                    $attendance->teacher_name = $day['teacher'];

                    // Convert time strings to the correct format
                    $attendance->class_time_from = date('H:i:s', strtotime($day['class']['from']));
                    $attendance->class_time_to = date('H:i:s', strtotime($day['class']['to']));
                    $attendance->class_group = $day['class']['group'];

                    // Save the model instance to the database
                    $attendance->save();
                }
            }

            return response()->json(['message' => 'Data stored successfully']);
        } else {
            return response()->json(['error' => 'Failed to fetch data from the API'], 500);
        }
    }

    public function fetchdatafromattandances(Request $request)
    {

        // Get today's date
        $today = date('Y-m-d');
        $existingAttendance = Datareceiverattandances::where('day_date', $today)
            ->has('attendanceResults')
            ->exists();
        if ($existingAttendance) {
            return redirect()->route('admin.search_result_by_date', ['search_date' => $today]);
        }

        // Fetch teachers for today
        $teachers = Datareceiverattandances::where('day_date', $today)->get();

        // Pass data to dashboard view
        return view('admin.dashboard', compact('teachers'));
    }


    public function fetchdatafromattandancesbyday(Request $request)
    {
        $existingAttendance = Datareceiverattandances::where('day_date', $request->search_date)
            ->has('attendanceResults')
            ->exists();
        if ($existingAttendance) {
            return redirect()->route('admin.search_result_by_date', ['search_date' => $request->search_date]);
        }

        // Validate the date input
        $request->validate([
            'search_date' => 'required|date',
        ]);

        // Get the selected date
        $searchDate = $request->input('search_date');

        // Fetch teachers for the selected date
        $teachers = Datareceiverattandances::where('day_date', $searchDate)->get();

        // Pass data to a new view
        return view('admin.searchAttandanceByDay', compact('teachers', 'searchDate'));
    }


    // public function registerAttendance(Request $request, $searchDate)
    // {
    //     // Validate the form data
    //     $request->validate([
    //         'attendance' => 'required|array',
    //         'attendance.*' => 'required|in:present,absent',
    //         'teacher_names' => 'required|array',
    //     ], [
    //         'attendance.required' => 'All attendance fields are required.',
    //         'attendance.*.required' => 'Each attendance entry is required.',
    //         'attendance.*.in' => 'Each attendance entry must be either present or absent.',
    //     ]);

    //     // Loop through the submitted attendance data and store each entry
    //     foreach ($request->attendance as $attendanceId => $state) {
    //         $attendanceResult = new AttendanceResult();
    //         $attendanceResult->attendance_id = $attendanceId;
    //         $attendanceResult->teacher_name = $request->teacher_names[$attendanceId];
    //         $attendanceResult->attendance_state = $state;
    //         $attendanceResult->save();
    //     }

    //     // Redirect back or to another page after saving the attendance
    //     return redirect()->route('admin.search_result_by_date', ['search_date' => $searchDate]);
    // }
    public function registerAttendance(Request $request, $searchDate)
    {
        // Validate the form data
        $request->validate([
            'attendance' => 'required|array',
            'attendance.*' => 'required|in:present,absent',
            'teacher_names' => 'required|array',
        ]);
        // Loop through the submitted attendance data and store each entry
        foreach ($request->attendance as $attendanceId => $state) {
            $attendanceResult = new AttendanceResult();
            $attendanceResult->attendance_id = $attendanceId;
            $attendanceResult->teacher_name = $request->teacher_names[$attendanceId];
            $attendanceResult->attendance_state = $state;
            $attendanceResult->save();
        }
        // Redirect back or to another page after saving the attendance
        return redirect()->route('admin.search_result_by_date', ['search_date' => $searchDate]);
    }


    public function searchAttendanceByDateResult(Request $request)
    {
        $searchDate = $request->validate([
            'search_date' => 'required|date',
        ])['search_date'];

        // Fetch attendance results for the selected date along with teacher data
        $attendanceResults = Datareceiverattandances::with('attendanceResults')
            ->whereDate('day_date', $searchDate)
            ->get();

        return view('admin.attandanceResultstable', compact('attendanceResults', 'searchDate'));
    }
    public function editAttandanceState($id)
    {
        $attendance = AttendanceResult::findOrFail($id);
        $day_date = request('day_date');
        // dd($day_date); // Retrieve the day_date query parameter
        return view('admin.attendanceEditState', compact('attendance', 'day_date'));
    }
    // public function editAttandanceState($id)
    // {
    //     $attendance = AttendanceResult::findOrFail($id);
    //     return view('admin.attendanceEditState', compact('attendance'));
    // }
    // public function updateAttandanceStateSubmit(Request $request, $id)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'attendance_state' => 'required|in:present,absent',
    //         'justification' => 'sometimes|boolean',
    //         'justification_type' => 'required_if:justification,1|string|nullable',
    //         'justification_document' => 'required_if:justification,1|file|nullable',
    //     ]);

    //     $today = $request->day_date;
    //     // Find the AttendanceResult instance by ID
    //     $attendanceResult = AttendanceResult::findOrFail($id);

    //     // Handle file upload
    //     if ($request->hasFile('justification_document')) {
    //         // Store the file in the storage directory (without creating subdirectories)
    //         $path = $request->file('justification_document')->store('justification_documents', 'local');
    //         // Update the justification_document column with the file path
    //         $validatedData['justification_document'] = $path;
    //     }
    //     if ($request->input('attendance_state') == 'present') {
    //         // Remove justification_type and justification_document
    //         $validatedData['justification'] = null;
    //     }
    //     // Check if justification is being updated to not justified
    //     if ($request->input('justification') == 0) {
    //         // Remove justification_type and justification_document
    //         $validatedData['justification_type'] = null;
    //         $validatedData['justification_document'] = null;
    //     }

    //     // Update the AttendanceResult instance with the validated data
    //     $attendanceResult->update($validatedData);
    //     return redirect()->route('admin.search_result_by_date', ['search_date' => $today]);
    // }
    public function updateAttandanceStateSubmit(Request $request, $id)
    {
        // Determine if justification fields should be required
        $attendanceState = $request->input('attendance_state');

        // Base validation rules
        $rules = [
            'attendance_state' => 'required|in:present,absent',
            'justification' => 'sometimes|boolean',
        ];

        // Add conditional validation rules
        if ($attendanceState === 'absent') {
            $rules['justification_type'] = 'required_if:justification,1|string|nullable';
            $rules['justification_document'] = 'required_if:justification,1|file|nullable';
        }

        // Validate the request data
        $validatedData = $request->validate($rules);

        $today = $request->input('day_date');

        // Find the AttendanceResult instance by ID
        $attendanceResult = AttendanceResult::findOrFail($id);

        // Handle file upload
        if ($request->hasFile('justification_document')) {
            // Store the file in the storage directory (without creating subdirectories)
            $path = $request->file('justification_document')->store('justification_documents', 'local');
            // Update the justification_document column with the file path
            $validatedData['justification_document'] = $path;
        }

        // Check if attendance state is being updated to present
        if ($attendanceState === 'present') {
            // Remove justification and related fields
            $validatedData['justification'] = null;
            $validatedData['justification_type'] = null;
            $validatedData['justification_document'] = null;
        }

        // Check if justification is being updated to not justified
        if ($request->input('justification') == 0) {
            // Remove justification_type and justification_document
            $validatedData['justification_type'] = null;
            $validatedData['justification_document'] = null;
        }

        // Update the AttendanceResult instance with the validated data
        $attendanceResult->update($validatedData);

        // Redirect back with a success message
        return redirect()->route('admin.search_result_by_date', ['search_date' => $today])->with('success', 'Attendance updated successfully');
    }

    // public function updateAttandanceStateSubmit(Request $request, $id)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'attendance_state' => 'required|in:present,absent',
    //         'justification' => 'sometimes|boolean',
    //         'justification_type' => 'required_if:justification,1|string|nullable',
    //         'justification_document' => 'required_if:justification,1|file|nullable',
    //     ]);

    //     // Find the AttendanceResult instance by ID
    //     $attendanceResult = AttendanceResult::findOrFail($id);

    //     // Handle file upload
    //     if ($request->hasFile('justification_document')) {
    //         // Store the file in the storage directory (without creating subdirectories)
    //         $path = $request->file('justification_document')->store('justification_documents', 'local');

    //         // Update the justification_document column with the file path
    //         $validatedData['justification_document'] = $path;
    //     }

    //     // Check if justification is being updated to not justified
    //     if ($request->input('justification') == false) {
    //         // Remove justification_type and justification_document
    //         $attendanceResult->justification_type = null;
    //         $attendanceResult->justification_document = null;
    //     }

    //     // Update the AttendanceResult instance with the validated data
    //     $attendanceResult->update($validatedData);

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Attendance updated successfully');
    // }
    // the original method for udpating attandance
    // public function updateAttandanceStateSubmit(Request $request, $id)
    // {
    //     // Validate the request data
    //     $validatedData = $request->validate([
    //         'attendance_state' => 'required|in:present,absent',
    //         'justification' => 'sometimes|boolean',
    //         'justification_type' => 'required_if:justification,1|string|nullable',
    //         'justification_document' => 'required_if:justification,1|file|nullable',
    //     ]);

    //     // Find the AttendanceResult instance by ID
    //     $attendanceResult = AttendanceResult::findOrFail($id);

    //     // Handle file upload
    //     if ($request->hasFile('justification_document')) {
    //         // Store the file in the storage directory (without creating subdirectories)
    //         $path = $request->file('justification_document')->store('justification_documents', 'local');

    //         // Update the justification_document column with the file path
    //         $validatedData['justification_document'] = $path;
    //     }

    //     // Update the AttendanceResult instance with the validated data
    //     $attendanceResult->update($validatedData);

    //     // Redirect back with a success message
    //     return redirect()->back()->with('success', 'Attendance updated successfully');
    // }



    public function show($filename)
    {
        // Retrieve the file path from the storage disk
        $filePath = Storage::disk('local')->path($filename);

        // Check if the file exists
        if (!Storage::disk('local')->exists($filename)) {
            abort(404, 'The file does not exist.');
        }

        // Return the file with appropriate headers
        return response()->file($filePath);
    }

    public function showDocument($id)
    {
        // Find the attendance result by ID
        $attendanceResult = AttendanceResult::findOrFail($id);

        // Get the document path
        $documentPath = $attendanceResult->justification_document;

        // Check if the document exists
        if (!Storage::exists($documentPath)) {
            abort(404, 'Document not found');
        }

        // Determine the file type and return the response accordingly
        $file = Storage::get($documentPath);
        $mimeType = Storage::mimeType($documentPath);

        return new Response($file, 200, [
            'Content-Type' => $mimeType,
            'Content-Disposition' => 'inline; filename="' . basename($documentPath) . '"'
        ]);
    }

    public function showTeacherRapport()
    {
        $teachers = Teacher::all();
        return view('admin.teacherRapport', compact('teachers'));
    }

    public function generateAttendanceReport(Request $request)
    {
        $request->validate([
            'teacher_name' => 'required|string',
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $teacherName = $request->input('teacher_name');
        $month = $request->input('month');
        $year = $request->input('year');

        return redirect()->route('admin.teacherLastResultAttendanceReportView', ['teacherName' => $teacherName, 'month' => $month, 'year' => $year]);
    }

    public function viewAttendanceReportTeacherlastResult(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');
        $teacherName = $request->query('teacherName');

        $attendanceRecords = Datareceiverattandances::where('teacher_name', $teacherName)
            ->whereMonth('day_date', $month)
            ->whereYear('day_date', $year)
            ->with('attendanceResults:attendance_id,attendance_state,justification')
            ->get();

        return view('admin.teacherattendanceReport', compact('attendanceRecords', 'teacherName', 'month', 'year'));
    }

    public function showMonthRapport()
    {
        $teachers = Teacher::all();
        return view('admin.monthRapport', compact('teachers'));
    }

    public function generateAttendanceReportAllTeachersMonth(Request $request)
    {
        $request->validate([
            'month' => 'required|integer|between:1,12',
            'year' => 'required|integer|min:2000|max:' . date('Y'),
        ]);

        $month = $request->input('month');
        $year = $request->input('year');

        return redirect()->route('admin.monthAttendanceReportView', ['month' => $month, 'year' => $year]);
    }
    public function viewAttendanceReportAllTeachersMonth(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        // Fetch and group attendance records for the selected month and year
        $attendanceRecords = Datareceiverattandances::whereMonth('day_date', $month)
            ->whereYear('day_date', $year)
            ->with('attendanceResults')
            ->get()
            ->groupBy('teacher_name');
        return view('admin.monthattendanceReport', compact('attendanceRecords', 'month', 'year'));
    }

    // public function viewAttendanceReportAllTeachersMonth(Request $request)
    // {
    //     $month = $request->query('month');
    //     $year = $request->query('year');

    //     // Fetch attendance records for the selected month and year
    //     $attendanceRecords = Datareceiverattandances::whereMonth('day_date', $month)
    //         ->whereYear('day_date', $year)
    //         ->with('attendanceResults')
    //         ->get();

    //     return view('admin.monthattendanceReport', compact('attendanceRecords', 'month', 'year'));
    // }


    public function downloadTeacherReportPdf(Request $request)
    {

        $teacherName = $request->query('teacherName');
        $month = $request->query('month');
        $year = $request->query('year');

        $attendanceRecords = Datareceiverattandances::where('teacher_name', $teacherName)
            ->whereMonth('day_date', $month)
            ->whereYear('day_date', $year)
            ->with('attendanceResults:attendance_id,attendance_state,justification')
            ->get();

        $pdf = PDF::loadView('admin.downloadpdflastpageTeacher', compact('attendanceRecords', 'teacherName', 'month', 'year'));
        return $pdf->download('teacher_attendance_report.pdf');
    }
    public function downloadMonthReportPdf(Request $request)
    {
        $month = $request->query('month');
        $year = $request->query('year');

        $attendanceRecords = Datareceiverattandances::whereMonth('day_date', $month)
            ->whereYear('day_date', $year)
            ->with('attendanceResults:attendance_id,attendance_state,justification')
            ->get();

        $pdf = PDF::loadView('admin.downloadpdfpageMonth', compact('attendanceRecords', 'month', 'year'));
        return $pdf->download('month_attendance_report.pdf');
    }
}
