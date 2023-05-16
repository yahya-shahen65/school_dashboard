<?php
namespace App\Repository;

interface StudentRepositoryInterface{
    public function Get_Student();

    public function Create_Student();

    public function Store_Student($request);

    public function Edit_student($id);

    public function update_student($request);

    public function delete_student($id);

    public function show_student($id);

    public function Upload_attachment($request);

    public function Delete_attachment($request);

    public function dwonload_attachment($i,$b);
}
