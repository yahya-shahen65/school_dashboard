<?php
namespace App\Repository;

interface TeacherRepositoryInterface{

    public function getAllTeachers();

    public function getAllSpecilization();

    public function getAllGender();

    public function storeTeacher($request);

    public function updateTeacher($request);

    public function deleteTeacher($id);
}
