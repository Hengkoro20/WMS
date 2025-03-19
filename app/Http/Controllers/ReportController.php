<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function index()
{
    $reports = Report::all();

    return response()->json([
        'status' => 200,
        'message' => 'Reports retrieved successfully.',
        'data' => $reports
    ], 200);
}

    public function store(Request $request)
    {
        $request->validate([
            'id_Item' => 'required|exists:items,id_Item',
            'current_stock' => 'required|integer',
            'report_date' => 'required|date',
            'total_in' => 'required|integer',
            'total_out' => 'required|integer'
        ]);

        $report = Report::create($request->all());
        return response()->json($report, 201);
    }

    public function show($id)
    {
        $report = Report::with('item')->find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        return response()->json($report, 200);
    }

    public function update(Request $request, $id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $request->validate([
            'current_stock' => 'integer',
            'report_date' => 'date',
            'total_in' => 'integer',
            'total_out' => 'integer'
        ]);

        $report->update($request->all());
        return response()->json($report, 200);
    }

    public function destroy($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        $report->delete();
        return response()->json(['message' => 'Report deleted successfully'], 200);
    }
}
