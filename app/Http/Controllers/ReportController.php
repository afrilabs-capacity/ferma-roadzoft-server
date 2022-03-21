<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;

class ReportController extends Controller
{
    
    public function getUserReportsByProject($projectId,$userId){
        return Project::where('id',$projectId)->where('user_id',$userId)->get();
    }
}
