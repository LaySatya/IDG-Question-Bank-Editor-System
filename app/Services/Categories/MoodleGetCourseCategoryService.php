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

    // Get all courses from moodle - Pagination
    public function getPaginationCourses(?int $page, ?int $perPage){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'local_idgqbank_get_all_pagination_courses',
            'page' => $page,
            'perpage' => $perPage
        ]);
        return $this->sendRequest($params);
    }

    // Search courses
    public function searchCourses($criteriaName, $criteriaValue, ?int $page, ?int $perPage){
        $params = array_merge($this->getBaseParams(), [
            'wsfunction' => 'core_course_search_courses',
            'criterianame' => $criteriaName,
            'criteriavalue' => $criteriaValue,
            'page' => $page,
            'perpage' => $perPage
        ]);
        return $this->sendRequest($params);
    }






}
