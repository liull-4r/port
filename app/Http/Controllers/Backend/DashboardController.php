<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Controllers\HomeController;
use Illuminate\Http\Request;
use \resources\views\backend\auth\login;
use App\Models\HomeModel;
use GrahamCampbell\ResultType\Success;
use Illuminate\Support\Str;
use Nette\Utils\Random;
use Random\Randomizer;

class DashboardController extends Controller
{
    public function dashboard(Request $request)
    {
        return view('backend.dashboard.list');
    }
    public function admin_home(Request $request)
    {
        $data['getrecord'] = HomeModel::all();
        return view('backend.home.list', $data);
    }
    public function admin_home_post(Request $request)
    {
        // Determine if adding a new record or updating an existing one
        if ($request->add_to_update == 'Add') {
            // Validation for adding a new record
            $insertRecord = $request->validate(['profile' => 'required']);
            $insertRecord = new HomeModel;
        } else {
            // Find the existing record for updating
            $insertRecord = HomeModel::find($request->id);
            if (!$insertRecord) {
                return redirect()->back()->with('error', 'Record not found.');
            }
        }

        // Populate the model with the data
        $insertRecord->your_name = trim($request->your_name);
        $insertRecord->work_experience = trim($request->work_experience);
        $insertRecord->description = trim($request->description);

        // Handle profile image upload
        if ($request->hasFile('profile')) {
            // Delete the old profile image if it exists
            if (!empty($insertRecord->profile) && file_exists('public/images/' . $insertRecord->profile)) {
                unlink('public/images/' . $insertRecord->profile);
            }

            // Upload the new profile image
            $file = $request->file('profile');
            $randomStr = Str::random(30); // Use Str::random instead of Str::unvis
            $filename = $randomStr . '.' . $file->getClientOriginalExtension();
            $file->move('public/images/', $filename);
            $insertRecord->profile = $filename;
        }

        // Save the record (either creating a new one or updating the existing one)
        $insertRecord->save();
        return redirect()->back()->with('success', 'Home Page Successfully Saved');
    }

    public function admin_about(Request $request)
    {
        return view('backend.about.list');
    }
    public function admin_services(Request $request)
    {
        return view('backend.services.list');
    }
    public function admin_portfolio(Request $request)
    {
        return view('backend.portfolio.list');
    }
    public function admin_contact(Request $request)
    {
        return view('backend.contact.list');
    }
}
