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

    // Get all courses from category
    public function getCoursesByCategory(int $categoryId){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_courses_by_category',
            'categoryid' => $categoryId
        ]);
        return $this->sendRequest($params);
    }

    //local_idgqbank_get_question_categories_by_course_category

}
