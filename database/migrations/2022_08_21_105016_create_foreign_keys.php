<?php

use App\Models\My_Parent;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
use League\CommonMark\Reference\Reference;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->foreign('grade_id')->references('id')->on('grades')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
        Schema::table('sections', function(Blueprint $table) {
            $table->foreign('grade_id')->references('id')->on('grades')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
        Schema::table('sections', function(Blueprint $table) {
            $table->foreign('class_id')->references('id')->on('classrooms')
                        ->onDelete('cascade')
                        ->onUpdate('cascade');
        });
        Schema::table('my__parents',function(Blueprint $table){
            $table->foreign('nationality_father_id')->references('id')->on('nationalities');
            $table->foreign('nationality_mother_id')->references('id')->on('nationalities');
            $table->foreign('blod_type_father_id')->references('id')->on('bloods');
            $table->foreign('blod_type_mother_id')->references('id')->on('bloods');
            $table->foreign('religion_father_id')->references('id')->on('religions');
            $table->foreign('religion_mother_id')->references('id')->on('religions');
        });
	}

	public function down()
	{
		Schema::table('classrooms', function(Blueprint $table) {
			$table->dropForeign('classrooms_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_grade_id_foreign');
		});
		Schema::table('sections', function(Blueprint $table) {
			$table->dropForeign('sections_class_id_foreign');
		});
		Schema::table('my__parents', function(Blueprint $table) {
			$table->dropForeign('my_parents_nationality_father_id_foreign');
			$table->dropForeign('my_parents_nationality_mother_id_foreign');
			$table->dropForeign('my_parents_blod_type_father_id_foreign');
			$table->dropForeign('my_parents_blod_type_mother_id_foreign');
			$table->dropForeign('my_parents_religion_father_id_foreign');
			$table->dropForeign('my_parents_religion_mother_id_foreign');
		});
	}
}
