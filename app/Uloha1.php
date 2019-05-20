<?php

namespace App;

use Illuminate\Support\Facades\DB;

class Uloha1
{

	public function getAllSubjects($fromAisUser = false)
	{
		$result = DB::table('u1_predmety');

		if ($fromAisUser !== false)
		{
			$result->where('nahral', $fromAisUser);
		}

		return $result->get();

		/*$result = $result->get();
		return ($result->isEmpty()) ? null : $result->toArray();*/
	}

	public function getAllPoints4Subject($predmetId)
	{
		$subject = DB::table('u1_predmety')->where('id', $predmetId)->get();
		$points = DB::table('u1_predmety_body')->where('predmet_id', $predmetId)->get();

		if (!$subject->isEmpty())
		{
			$subject = $subject->first();

			$subject->columns = json_decode($subject->columns);
			$subject->points = array();

			foreach ($points as $point) {
				$subject->points[] = array_merge(array($point->ais_id, $point->student_name), json_decode($point->results));
			}

		}

		return $subject;
	}

	public function getAllSubjects4AisId($ais_id)
	{
		$subjects = DB::table('u1_predmety_body')->where('ais_id', $ais_id)->join('u1_predmety', 'u1_predmety_body.predmet_id', '=', 'u1_predmety.id')->get();

		if (!$subjects->isEmpty())
		{
			$subjects = $subjects->map(function($subject) {
				$subject->columns = json_decode($subject->columns);
				$subject->points = array_merge(array($subject->ais_id, $subject->student_name), json_decode($subject->results));

				$uploadedBy = DB::table('users')->select('name')->where('ais_id', $subject->nahral)->get();
				$subject->createdBy = (!$uploadedBy->isEmpty()) ? $uploadedBy->first()->name : 'Anonymous';

				return $subject;
			});
		}

		return $subjects;
	}

	public function save($data, $csv_data)
	{
		// Get pre ID of the newly created subject
		$subjectId = DB::table('u1_predmety')->insertGetId($data);

		// Point rows to make batch insert
		$subjectPoints = array();

		// Collect data to rows
		foreach ($csv_data as $pointData) {
			$subjectPoints[] = [
				'predmet_id' => $subjectId,
				'ais_id' => $pointData[0],
				'student_name' => $pointData[1],
				'results' => json_encode(array_slice($pointData, 2))
			];
		}

		// Write in points too
		DB::table('u1_predmety_body')->insert($subjectPoints);

		// Return true
		return true;
	}

	public function delete($id)
	{
		$subjectId = DB::table('u1_predmety')->where('id', $id)->delete();
		$subjectId = DB::table('u1_predmety_body')->where('predmet_id', $id)->delete();
	}

	public function csvToArray($filepath, $delimiter = ',')
	{

		if ($delimiter == ';')
		{
			$rows = array_map(function($v){return str_getcsv($v, ';');}, file($filepath));
		}
		else
		{
			$rows = array_map(function($v){return str_getcsv($v, ',');}, file($filepath));
		}

        //$header = array_shift($rows);
        /*$csv_data = [];
        foreach($rows as $row)
        {
            $csv_data[] = array_combine($header, $row);
        }

        return $csv_data;*/

        return $rows;
    }

}