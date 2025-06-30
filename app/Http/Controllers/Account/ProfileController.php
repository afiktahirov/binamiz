<?php

namespace App\Http\Controllers\Account;

use App\Helpers\AuthSessionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ProfileUpdateRequest;
use App\Models\AuthSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;

class ProfileController extends Controller
{
    public function index()
    {
        return view("account.profile.index", [
            "userSessions" => userSessions(),
        ]);
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        $user->update([
            "full_name" => $request->full_name,
            "email" => $request->email,
            // "gender" => $request->gender,
            "birthdate" => $request->birthdate,
        ]);

        // Handle contact numbers if you have a relation or specific field for it
        // This depends on your User model structure

        \App\Helpers\Swal::toastSuccess("Profil məlumatları uğurla yeniləndi");
        return back();
    }

    public function deleteSession(Request $request)
    {
        $sessionId = $request->session_id;

        $session = AuthSession::where("id", $sessionId)
            ->where("user_id", auth()->user()->id)
            ->first();

        if (empty($session)) {
            return response()->json(
                ["status" => "error", "message" => "Sessiya mövcud deyil"],
                404
            );
        }

        if ($sessionId == request()->session()->getId()) {
            return response()->json(
                [
                    "status" => "error",
                    "message" => "Cari Sessiya silinə bilməz",
                ],
                404
            );
        }

        $session->delete();

        return response()->json(
            ["status" => "success", "message" => "Sessiya uğurla silindi"],
            200
        );
    }

    public function deleteOtherSessions(Request $request)
    {
        $currentSessionId = request()->session()->getId();

        AuthSession::where("user_id", auth()->user()->id)
            ->where("id", "!=", $currentSessionId)
            ->delete();

        return response()->json(
            [
                "status" => "success",
                "message" => "Digər Sessiyalar uğurla silindi",
            ],
            200
        );
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors([
                "current_password" => "Current password is incorrect.",
            ]);
        }

        Auth::user()->update([
            "password" => Hash::make($request->new_password),
        ]);

        // optional toast
        \App\Helpers\Swal::toastSuccess("Şifrə uğurla yeniləndi");
        return back();
    }
}
