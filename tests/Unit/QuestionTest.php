<?php

namespace Tests\Unit;

use App\Models\GroupTeacher;
use App\Models\Teacher;
use App\Models\TeacherSurvey;
use Tests\TestCase;

class QuestionTest extends TestCase
{
    /** @test */
    public function test_example()
    {
        $teacher = TeacherSurvey::find(1)->test;
        $this->assertInstanceOf(Teacher::class, $teacher);
    }
}
