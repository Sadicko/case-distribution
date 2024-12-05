<?php

use App\Models\Category;
use App\Models\Court;
use App\Models\Judge;
use App\Models\Location;
use App\Models\Registry;
use Carbon\Carbon;

function status()
{

    return [
        'Published',
        'Archived',
        'Draft',
    ];
}

function editStatus()
{

    return [
        'Published',
        'Archived',
        'Draft',
        //        'Move to trash',
    ];
}

function priority_level()
{
    return [
        "normal",
        "urgent"
    ];
}



function user_status()
{

    return [
        'Active' => "Active",
        'Suspended' => "Suspended",
        'Banned' => "Blocked",
    ];
}


//all user access levels. Limited levels are added below this
function access_level()
{

    return [
        'Court Staff' => "Court Staff",
        'Filing Clerk' => "Filing Clerk",
        'Docket Clerk' => "Docket Clerk",
        'Process Clerk' => "Process Clerk",
        'Registrar' => "Registrar",
        'Court Manager' => "Court Manager",
        'Director' => "Director",
        'Judge' => "Judge",
        'Management' => "Management",
        'Developer' => "Developer",
        'General Admin' => "General Admin",
        'System Admin' => "System Admin",
        'Super Admin' => 'Super Admin',
    ];
}

//used when creating users that belongs to registries
function registry_level()
{

    return [
        'Court Staff',
        'Filing Clerk',
        'Docket Clerk',
        'Process Clerk',
        'Registrar',
        'Judge',
    ];
}

//used when creating users for court rooms
function court_room_level()
{

    return [
        'Court Staff',
        'Judge',
    ];
}

function limited_access_level()
{
    return [
        'court_staff',
        'filing_clerk',
        'docket_clerk',
        'process_clerk',
        'court_registrar',
        'judge',
    ];
}

function registry_access_level()
{

    return [
        'docket_clerk',
        'process_clerk',
        'filing_clerk',
        'court_registrar',
    ];
}

function court_room_access_level()
{

    return [
        'judge',
        'court_staff',
    ];
}



function role_status()
{

    return [
        'Active' => "Active",
        'Inactive' => "Inactive",
    ];
}

function regions()
{
    return [
        'AF',
        'AH',
        'BO',
        'BE',
        'CP',
        'EP',
        'AA',
        'NP',
        'NE',
        'OT',
        'SV',
        'UE',
        'UW',
        'TV',
        'WP',
        'WN',
    ];
}

function fetch_locations($id)
{

    return Location::query()->where('courttype_id', $id)->get();
}

function fetch_registries($id)
{

    return Registry::query()->where('location_id', $id)->get();
}

function fetch_courts($id)
{

    return Court::query()->where('registry_id', $id)->get();
}


function court_judges($court_id)
{
    return $judges = Judge::query()->whereHas('courts', function ($query) use ($court_id) {
        $query->where('court_id', $court_id);
    })->orderBy('name', 'asc')->get();
}

/**
 * @param $date
 * @return string
 */
function getCustomLocalTime($date)
{

    $newDateTime = date('g:i A', strtotime($date));

    $new_date = $date->format('d M, Y') . ' at ' . $newDateTime;

    return $new_date;
}


function getCustomLocalDate($date)
{

    $new_date = Carbon::parse($date)->format('jS F Y');

    return $new_date;
}


// function turn_around_time($bail){


// 	$start_date = $bail->date_granted;
// 	$end_date = $bail->released_date;

// 	$startDateTime = Carbon::parse($start_date);
// 	$endDateTime = Carbon::parse($end_date);

// 	$turnaroundTime = $endDateTime->diffForHumans($startDateTime);


// 	return $turnaroundTime;

// }




function legalYear()
{

    // Get the current date
    $currentDate = Carbon::now();
    $currentYear = Carbon::now()->year;

    // Check if the current date is on or after October 1st of the current year
    if ($currentDate->month >= 10) {
        // If it is, set the legal year start to October 1st of the current year
        $legalYearStart = Carbon::create($currentDate->year, 10, 1);
        $legalYearEnd = $legalYearStart->copy()->addYear()->subDay();
    } else {
        // If it's before October 1st, set the legal year start to October 1st of the previous year
        $legalYearStart = Carbon::create($currentDate->year - 1, 10, 1);
        $legalYearEnd = Carbon::create($currentDate->year, 9, 30);
    }


    return [
        'currentDate' => $currentDate,
        'currentYear' => $currentYear,
        'legalYearStart' => $legalYearStart,
        'legalYearEnd' => $legalYearEnd,
    ];
}


function subcategories($category)
{
    $subCategory = [];

    if ($category) {

        $category = Category::query()->with('children')->where('name', $category)->first();

        $subCategory = $category->children;

    }

    return $subCategory;
}




function getInitials($name)
{
    $words = explode(' ', $name);
    $initials = '';

    foreach ($words as $word) {
        $initials .= substr($word, 0, 1);
    }

    return strtoupper($initials); // Convert to uppercase if desired
}


function commercial_type()
{
    return [
        'Pre-Trial',
        'Motion',
        'Trial'
    ];
}
