<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ReportController extends BaseController {
	public function showReports(){
		$userTrips = UserTrip::with('user')->get();
		$users = [];
		$totalNum = 0;
		$maleNum = 0;
		$studentNum = 0;
		$year_array = [];
		foreach ($userTrips as $userTrip) {
			$totalNum++;
			if($userTrip->user->gender == 'male'){
				$maleNum++;
			}
			if($userTrip->user->student_id){
				$studentNum++;
				if(array_key_exists($userTrip->user->class_year, $year_array)){
					$year_array[$userTrip->user->class_year] += 1;
				}else{
					$year_array[$userTrip->user->class_year] = 1;
				}
			}
		}
		ksort($year_array);

		return View::make('reports', compact('totalNum','maleNum','studentNum','year_array'));
	}
}