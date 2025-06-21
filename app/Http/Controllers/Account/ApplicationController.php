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
    public function index(Request $request)
    {
        $query = auth()
            ->user()
            ->applications()
            ->with("assignedUser:id,name,full_name");

        // Search functionality
        if ($request->filled("search")) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where("title", "like", "%{$search}%")
                    ->orWhere("content", "like", "%{$search}%")
                    ->orWhere("type", "like", "%{$search}%")
                    ->orWhere("department", "like", "%{$search}%")
                    ->orWhereHas("assignedUser", function ($subQuery) use (
                        $search
                    ) {
                        $subQuery
                            ->where("name", "like", "%{$search}%")
                            ->orWhere("full_name", "like", "%{$search}%");
                    });
            });
        }

        // Sorting functionality
        $sortBy = $request->get("sort_by", "created_at");
        $sortDirection = $request->get("sort_direction", "desc");

        $allowedSorts = [
            "title",
            "created_at",
            "type",
            "status",
            "department",
            "assigned_user",
        ];
        if (in_array($sortBy, $allowedSorts)) {
            if ($sortBy === "assigned_user") {
                $query
                    ->leftJoin(
                        "users",
                        "applications.assigned_user_id",
                        "=",
                        "users.id"
                    )
                    ->orderBy("users.name", $sortDirection)
                    ->select("applications.*");
            } else {
                $query->orderBy($sortBy, $sortDirection);
            }
        } else {
            $query->orderBy("created_at", "desc");
        }

        // Pagination
        $perPage = $request->get("per_page", 10);
        $allowedPerPage = [10, 25, 50, 100];
        if (!in_array($perPage, $allowedPerPage)) {
            $perPage = 10;
        }

        $applications = $query->paginate($perPage);
        $applications->appends($request->query());
        $applications->withPath(request()->url());

        // Return JSON for AJAX requests
        if ($request->ajax()) {
            return response()->json([
                "html" => view(
                    "account.application.table",
                    compact("applications")
                )->render(),
                "pagination" => [
                    "current_page" => $applications->currentPage(),
                    "last_page" => $applications->lastPage(),
                    "per_page" => $applications->perPage(),
                    "total" => $applications->total(),
                    "from" => $applications->firstItem(),
                    "to" => $applications->lastItem(),
                    "links" => $applications
                        ->links("custom.pagination")
                        ->render(),
                ],
            ]);
        }

        // Prepare current state for JavaScript
        $currentState = [
            "search" => $request->get("search", ""),
            "sort_by" => $sortBy,
            "sort_direction" => $sortDirection,
            "per_page" => $perPage,
            "page" => $applications->currentPage(),
        ];

        return view("account.application.index", [
            "applications" => $applications,
            "title" => "Müraciətlər",
            "currentState" => $currentState,
        ]);
    }

    public function create()
    {
        return view("account.application.create", [
            "title" => "Müraciət Yarat",
        ]);
    }

    public function store(StoreApplicationRequest $request)
    {
        try {
            $data = [
                "type" => $request->type,
                "department" => $request->department,
                "title" => $request->title,
                "content" => $request->content,
                "user_id" => auth()->id(),
                "status" => ApplicationStatusEnum::PENDING,
            ];

            $application = Application::create($data);

            if ($request->hasFile("attachments")) {
                foreach ($request->file("attachments") as $file) {
                    $application
                        ->addMedia($file)
                        ->toMediaCollection("attachments");
                }
            }

            return to_route("account.application.index");
        } catch (\Exception $e) {
            return to_route("account.application.index");
        }
    }

    public function show($id)
    {
        $application = Application::with([
            "assignedUser:id,name,full_name", 
            "comments" => function($q){
                $q->with('user:id,name,full_name');
            }])->findOrFail($id);
        // return ($application);
        return view("account.application.show", [
            "application" => $application,
            'comments' => $application->comments
        ]);
    }

    public function edit($id)
    {
        $application = Application::findOrFail($id);
        $application->load(["comments" => function($q){
            $q->with('user:id,name,full_name');
        }]);

        // Check if user owns this application
        if (
            $application->user_id !== auth()->id() ||
            $application->status !== ApplicationStatusEnum::PENDING
        ) {
            return back()->with(
                "error",
                "Bu müraciəti redaktə etmək üçün icazəniz yoxdur."
            );
        }

        return view("account.application.edit", [
            "application" => $application,
            "comments" => $application->comments
        ]);
    }

    public function update(UpdateApplicationRequest $request, $id)
    {
        try {
            $application = Application::findOrFail($id);
            // Check if user owns this application
            if (
                $application->user_id !== auth()->id() ||
                $application->status !== ApplicationStatusEnum::PENDING
            ) {
                return back()->with(
                    "error",
                    "Bu müraciəti redaktə etmək üçün icazəniz yoxdur."
                );
            }

            $data = $request->validated();

            $application->update($data);

            // Handle file removals
            if ($request->has("remove_attachments")) {
                foreach ($request->remove_attachments as $mediaId) {
                    $media = $application->media()->find($mediaId);
                    if ($media) {
                        $media->delete();
                    }
                }
            }

            // Handle new attachments
            if ($request->hasFile("attachments")) {
                foreach ($request->file("attachments") as $file) {
                    $application
                        ->addMedia($file)
                        ->toMediaCollection("attachments");
                }
            }

            if($request->has('comment')) {
                $application->comments()->create([
                    'comment' => $request->comment,
                    'user_id' => auth()->user()->id
                ]);
            }

            return redirect()
                ->route("account.application.show", $application->id)
                ->with("success", "Müraciət uğurla yeniləndi");
        } catch (\Exception $e) {
            return back()->with(
                "error",
                "Xəta baş verdi. Zəhmət olmasa yenidən cəhd edin."
            );
        }
    }

    public function download(Application $application, $media)
    {
        $mediaItem = $application
            ->getMedia("attachments")
            ->firstWhere("id", $media);

        if (!$mediaItem) {
            abort(404);
        }

        return response()->download(
            $mediaItem->getPath(),
            $mediaItem->file_name
        );
    }
}
