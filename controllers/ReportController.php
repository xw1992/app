<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class ReportController extends BaseController {
	public function showReports(){
		return View::make('reports');
	}
}