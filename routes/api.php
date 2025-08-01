<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\MoodleUserController;
use App\Http\Controllers\Moodle\Categories\MoodleGetCourseCategoryController;
use App\Http\Controllers\Moodle\Categories\MoodleGetQuestionCategoryController;
use App\Http\Controllers\Moodle\Comments\MoodleActionQuestionCommentController;
use App\Http\Controllers\Moodle\Questions\MoodleGetQuestionController;
use App\Http\Controllers\Moodle\Questions\MoodlePreviewQuestionController;
use App\Http\Controllers\Moodle\Questions\MoodleUpdateQuestionController;
use App\Http\Controllers\Moodle\Tags\MoodleActionsQuestionTagsController;
use App\Http\Controllers\Moodle\Tags\MoodleGetTagController;
use App\Http\Controllers\Moodle\Tags\MoodleTagManagementController;

// Public route for login
Route::post('/users', [MoodleUserController::class, 'login']);


// Protected routes
// Route::middleware(['moodle.token'])->group(function () {


    // User routes
    Route::prefix('users')->controller(MoodleUserController::class)->group(function () {
        Route::get('/','showAllUsers');
        Route::get('/user-role', 'showUsersByRole');
        Route::get('/user-by-username', 'showUserByUsername');
        Route::get('/roles', 'showAllRoles');
    });


    // GET Question routes
    Route::prefix('questions')->controller(MoodleGetQuestionController::class)->group(function () {
        // Route::get('/', 'showAllQuestions');
        Route::get('/category', 'showAllQuestionsByCategory');
        Route::get('/pagination', 'showAllQuestionPaginations');
        Route::get('/pagination/category', 'showPaginationQuestionsByCategory');
        Route::get('/question', 'showQuestionById');
        Route::get('/tags-with-category','showAllQuestionsByTagWithSpecificCategory');
        Route::get('/qtypes','showAllQuestionTypes');
        Route::get('/questions-by-qtype','showQuestionsByQtype');
        Route::get('/filters','fullFilterQuestions');
        Route::get('/history','trackQuestionVersions');
    });

    // Preview questions
    Route::prefix('questions')->controller(MoodlePreviewQuestionController::class)->group(function () {
        Route::get('/preview','previewQuestion');
        Route::get('/preview_moodle_question','previewMoodleQuestionMode');
        Route::get('/import', 'importQuestionsMoodle');
        Route::get('/multi_preview', 'previewQuestionsInCategory');
        Route::get('/export', 'exportQuestionsMoodle');
        Route::get('/overview','questionOverview');
        Route::get('/create', 'addNewQuestion');
    });



    // Bulk update questions
    Route::prefix('questions')->controller(MoodleUpdateQuestionController::class)->group(function(){
        Route::put('/','updateQuestionName');
        Route::post('/status','bulkUpdateQuestionStatus');
        Route::post('/set-question-status', 'setQuestionStatusByQuestionId');
        Route::post('/bulk-tags','bulkEditAddQuestionsTags');
        Route::delete('/bulk-tags','bulkEditRemoveTagsFromQuestions');
        Route::get('/full_edit_moodle_form', 'fullEditQuestionMoodleForm');
        Route::get('/duplicate_moodle_form', 'duplicateQuestionMoodleForm');
        Route::delete('/delete_all_versions', 'deleteQuestionAllVersions');
        Route::delete('/delete_specific_versions', 'deleteQuestionsSpecificVersions');
        Route::put('/move', 'moveQuestionToCategory');
    });



    // Question category routes
    Route::prefix('questions')->controller(MoodleGetQuestionCategoryController::class)->group(function () {
        Route::get('/categories', action: 'showAllQuestionCategories');
        Route::get('/question_categories','showQuestionCategoriesByCourse');
    });



     // Course category routes
    Route::prefix('questions')->controller(MoodleGetCourseCategoryController::class)->group(function () {
        Route::get('/course-categories', 'showAllCourseCategories');
        Route::get('/courses','showCoursesByCategory');
        Route::get('/allcourses', 'showAllCourses');
        Route::get('/searchcourses', 'searchCourses');
    });



    // Tags routes
    Route::prefix('questions')->controller(MoodleGetTagController::class)->group(function () {
        Route::get('/tags', 'showAllTags');
        Route::get('/tag', 'showTagById');
        Route::get('/question-tags', 'showTagsByQuestionId');
    });



    // Add-remove tags to-from a question
    Route::prefix('questions')->controller(MoodleActionsQuestionTagsController::class)->group(function () {
        Route::post('/tags', 'addTagsToAQuestion');
        Route::delete('/tags', 'removeTagsFromAQuestion');
    });



    // Question Comments
     Route::prefix('questions')->controller(MoodleActionQuestionCommentController::class)->group(function () {
        Route::get('/comments', 'showQuestionComments');
        Route::post('/comments', 'addCommentQuestion');
        Route::delete('/comments','removeCommentQuestion');
    });


    // Tags Management
    Route::prefix('questions')->controller(MoodleTagManagementController::class)->group(function (){
        Route::get('/tag_collection', 'showTagCollections');
        Route::get('/manage_tags', 'showAllTags');
        Route::get('/manage_tag', 'showTagById');
        Route::post('/manage_tags', 'createTag');
        Route::put('/manage_tags', 'updateTag');
        Route::delete('/manage_tags', 'deleteTag');
    });

// });
