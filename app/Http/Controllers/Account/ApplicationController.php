<?php

namespace App\Http\Controllers\Account;

use App\Enums\ApplicationStatusEnum;
use App\Helpers\Swal;
use App\Models\Application;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreApplicationRequest;
use App\Http\Requests\UpdateApplicationRequest;
use Illuminate\Support\Facades\Session;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = auth()->user()->applications()
            ->with('assignedUser:id,name,full_name')
            ->orderBy('created_at', 'desc')
            ->get();
        
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

            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $application->addMedia($file)->toMediaCollection('attachments');
                }
            }

            return to_route('account.application.index');

        } catch (\Exception $e) {
            return to_route('account.application.index');
        }
    }

    public function show($id)
    {
        $application = Application::with(['assignedUser', 'media'])->findOrFail($id);
        
        return view('account.application.show', [
            'application' => $application
        ]);
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);

        // Check if user owns this application
        if ($application->user_id !== auth()->id() || $application->status !== ApplicationStatusEnum::PENDING) {
            return back()->with('error', 'Bu müraciəti redaktə etmək üçün icazəniz yoxdur.');
        }

        return view('account.application.edit', [
            'application' => $application
        ]);
    }

    public function update(UpdateApplicationRequest $request, $id)
    {
        try {
            $application = Application::findOrFail($id);

            // Check if user owns this application
            if ($application->user_id !== auth()->id() || $application->status !== ApplicationStatusEnum::PENDING) {
                return back()->with('error', 'Bu müraciəti redaktə etmək üçün icazəniz yoxdur.');
            }

            $data = [
                'type' => $request->type,
                'content' => $request->content,
            ];

            $application->update($data);

            // Handle file removals
            if ($request->has('remove_attachments')) {
                foreach ($request->remove_attachments as $mediaId) {
                    $media = $application->media()->find($mediaId);
                    if ($media) {
                        $media->delete();
                    }
                }
            }

            // Handle new attachments
            if ($request->hasFile('attachments')) {
                foreach ($request->file('attachments') as $file) {
                    $application->addMedia($file)->toMediaCollection('attachments');
                }
            }

            return redirect()->route('account.application.show', $application->id)
                ->with('success', 'Müraciət uğurla yeniləndi');

        } catch (\Exception $e) {
            return back()->with('error', 'Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin.');
        }
    }

    public function download(Application $application, $media)
    {
        $mediaItem = $application->getMedia('attachments')->firstWhere('id', $media);
        
        if (!$mediaItem) {
            abort(404);
        }

        return response()->download($mediaItem->getPath(), $mediaItem->file_name);
    }
}
