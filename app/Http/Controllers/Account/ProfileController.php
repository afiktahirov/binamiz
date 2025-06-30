<?php

namespace App\Http\Controllers\Account;

use App\Helpers\AuthSessionHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AuthSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Jenssegers\Agent\Agent;
class ProfileController extends Controller
{
    
    public function index()
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        
        return view('account.profile.index',[
            'userSessions' => userSessions()
        ]);
    }
    
    public function deleteSession(Request $request) 
    {
        $sessionId = $request->session_id;
        
        $session = AuthSession::where('id',$sessionId)
            ->where('user_id',auth()->user()->id)
            ->first();

        if(empty($session))
            return response()->json(['status'=> 'error','message' => 'Sessiya mövcud deyil'],404);
        
        if($sessionId == request()->session()->getId())
            return response()->json(['status'=> 'error','message' => 'Cari Sessiya silinə bilməz'],404);
        
        $session->delete();
        
        return response()->json(['status'=> 'success','message' => 'Sessiya uğurla silindi'],200);
    }
    
    public function deleteOtherSessions(Request $request)
    {
        $currentSessionId = request()->session()->getId();

        AuthSession::where('user_id',auth()->user()->id)
            ->where('id','!=',$currentSessionId)
            ->delete();

        return response()->json(['status'=> 'success','message' => 'Digər Sessiyalar uğurla silindi'],200);
    }
    
    
}
