<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Docket;
use App\Traits\AuditTrailLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DocketController extends Controller
{
    use AuditTrailLog;
    public function showCases()
    {
        // create audit
        $this->createAuditTrail('Visited cases page.');

        return view('dashboard.dockets.index');
    }

    public function createCase()
    {
        $categories = Category::query()->orderBy('name', 'asc')->get();

        // create audit
        $this->createAuditTrail('Visited case creation page.');

        return view('dashboard.dockets.create', compact('categories'));
    }

    public function saveCase(Request $request)
    {
//        return $request;
        $request->validate([
            'suit_number' => ['required', 'string', 'regex:/^[A-Z]{2,5}\/\d{4,5}\/\d{4}$/'],
            'case_title' => ['required', 'string'],
            'case_category' => ['required', 'integer'],
            'location' => ['required', 'integer'],
            'priority_level' => ['required', 'string'],
        ]);

        // check if suit number exist
        if($this->isCaseRegistered()){
            return back()->withInput()->withErrors(['suit_number' => 'The suit number is already taken.']);
        }

        $case = Docket::query()->create([
            'slug' => $slug = Str::slug($request->suit_number),
            'suit_number' => $request->suit_number,
            'case_title' => $request->case_title,
            'category_id' => $request->case_category,
            'location_id' => $request->location,
            'priority_level' => $request->priority_level,
            'status' => 'Filed',
            'created_by' => Auth::id(),
        ]);


        $this->createAuditTrail("Case with suit no $case->suit_no submitted for assignment");

        return back()->with('success', 'cases assigned successfully.');
    }

    /**
     * @return bool
     */
    public function isCaseRegistered(): bool
    {
        return Docket::query()->where(['suit_number' => request()->suit_number, 'category_id' => request()->case_category, 'location_id' => request()->location])->exists();
    }

}
