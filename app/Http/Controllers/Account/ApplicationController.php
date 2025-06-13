<?php

namespace App\Http\Controllers\Account;

use App\Enums\ApplicationStatusEnum;
use App\Helpers\Swal;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = auth()->user()->applications;
        
        return view('account.application.index',[
            'applications' => $applications
        ]);
    }

    public function create() 
    {
        return view('account.application.create');
    }

    public function store(StoreApplicationRequest $request)
    {
        try {
            $data = [
                'type' => $request->type,
                'department' => $request->department,
                'title' => $request->title,
                'content' => $request->content,
                'user_id' => auth()->id(),
                'status' => ApplicationStatusEnum::PENDING
            ];

            $application = Application::create($data);

            if ($request->hasFile('attachment')) {
                $application->addMediaFromRequest('attachment')->toMediaCollection('attachments');
            }

            Swal::toastSuccess('Application created successfully');

            return redirect()->route('account.application.index');

        } catch (\Exception $e) {
            Swal::toastError('Failed to create application');
            return redirect()->route('account.application.index');
        }
    }

    public function detail($id)
    {
        dd('ApplicationController');
        return view('account.application.detail');
    }
}
