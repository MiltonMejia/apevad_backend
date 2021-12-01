<?php

namespace Database\Seeders;

use App\Models\Administrative;
use App\Models\AdministrativeCategory;
use App\Models\AdministrativeSurvey;
use App\Models\Degree;
use App\Models\EmployeeCategory;
use App\Models\Group;
use App\Models\GroupTeacher;
use App\Models\Question;
use App\Models\QuestionCategory;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\TeacherSurvey;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Teacher::factory(10)->create();
        Degree::factory(16)->create();
        Group::factory(2560)->create();
        GroupTeacher::factory(25)->create();
        AdministrativeCategory::factory(10)->create();
        Student::factory(25)->create();
        EmployeeCategory::factory(2)->create();
        Administrative::factory(10)->create();
        QuestionCategory::factory(10)->create();
        Question::factory(50)->create();
        AdministrativeSurvey::factory(50)->create();
        TeacherSurvey::factory(50)->create();

    }
}
