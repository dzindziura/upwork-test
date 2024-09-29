<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessSubmissionJob;
use Exception;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiController extends BaseController
{
    public function index(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        try {
            ProcessSubmissionJob::dispatch($validatedData);

            return response()->json(['success' => 'Data received and job dispatched'], 200);
        } catch (Exception $e) {
            Log::error('Error dispatching job: ' . $e->getMessage());

            return response()->json(['error' => 'Unable to process the request'], 500);
        }
    }
}
