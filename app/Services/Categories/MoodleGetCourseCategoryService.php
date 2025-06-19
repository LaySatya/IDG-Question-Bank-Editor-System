<?php

namespace App\Services\Categories;
use App\Services\MoodleBaseService;


class MoodleGetCourseCategoryService extends MoodleBaseService
{

    // Get all course categories from moodle
    public function getAllCourseCategories(){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_course_get_categories',
        ]);
        return $this->sendRequest($params);
    }


}
