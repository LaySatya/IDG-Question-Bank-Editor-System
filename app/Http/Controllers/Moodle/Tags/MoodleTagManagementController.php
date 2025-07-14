<?php

namespace App\Http\Controllers\Moodle\Tags;

use App\Http\Controllers\Controller;
use App\Services\Tags\MoodleTagManagementService;
use Illuminate\Http\Request;

class MoodleTagManagementController extends Controller
{
    protected MoodleTagManagementService $moodleTagManagementService;

    public function __construct(MoodleTagManagementService $moodleTagManagementService)
    {
        $this->moodleTagManagementService = $moodleTagManagementService;
    }

    // Get all tags with pagination
    public function showAllTags(Request $request){
        try {
            $page = $request->input('page', 0);
            $perPage = $request->input('perPage', 10);

            $result = $this->moodleTagManagementService->getAllTags($page, $perPage);

            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }
}
