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

     // Show tag by tags id
    public function showTagById(Request $request)
    {
        try {
            $tagIds = $request->input('tags.id', []);
            if (empty($tagIds) || !is_array($tagIds)) {
                return response()->json(['error' => 'Invalid tag ID'], 400);
            }

            $tag = $this->moodleTagManagementService->getTagById($tagIds);
            return response()->json($tag);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Create new tag
    public function createTag(Request $request){
        try {
            $name = $request->input('name');
            $rawname = $request->input('rawname');
            $description = $request->input('description', null);
            $isstandard = $request->input('isstandard', false);

            if (!$name || !$rawname) {
                return response()->json(['error' => 'Name and rawname are required'], 400);
            }

            $result = $this->moodleTagManagementService->createTag($name, $rawname, $description, $isstandard);
            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Update existing tag
    public function updateTag(Request $request){
        try {
            $tagId = $request->input('id');
            $rawname = $request->input('rawname');
            $description = $request->input('description', null);
            $isstandard = $request->input('isstandard', 0);

            if (!$tagId || !$rawname) {
                return response()->json(['error' => 'Tag ID and rawname are required'], 400);
            }

            $result = $this->moodleTagManagementService->updateTag($tagId, $rawname, $description, $isstandard);
            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Delete tag
    public function deleteTag(Request $request){
        try {
            $tagIds = $request->input('tagids', []);
            if (empty($tagIds) || !is_array($tagIds)) {
                return response()->json(['error' => 'Invalid tag ID'], 400);
            }

            $result = $this->moodleTagManagementService->deleteTag($tagIds);
            return response()->json($result);
        } catch (\Throwable $e) {
            return response()->json([
                'error' => 'Server error',
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ], 500);
        }
    }

    // Show tag collections
    public function showTagCollections(){
        try {
            $result = $this->moodleTagManagementService->getTagCollections();
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
