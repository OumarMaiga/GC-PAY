<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;
use App\Repositories\RequeteRepository;
use App\Repositories\NotificationRepository;
use App\Repositories\UserRepository;
use App\Models\Structure;
use App\Models\Service;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller
{
    protected $notificationRepository;
    protected $requeteRepository;
    protected $userRepository;

    public function __construct(UserRepository $userRepository, NotificationRepository $notificationRepository, RequeteRepository $requeteRepository) {
        $this->middleware('admin-structure-and-agent-only', ['only' => ['index', 'show']]);
        $this->notificationRepository = $notificationRepository;
        $this->requeteRepository = $requeteRepository;
        $this->userRepository = $userRepository;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notifications = Notification::where('structure_id', Auth::user()->structure_id)->where('destinateur', 'structure')->get();
        return view('dashboards.notification.index',compact('notifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        
        $notification = $this->notificationRepository->getBySlug($slug);
        $requete = $notification->requete()->associate($notification->user_id)->requete;
        $user = $this->userRepository->getById($requete->usager_id);
        $structure = Structure::where('id', $requete->structure_id)->first();
        $service = Service::where('id', $requete->service_id)->first();

        if ($notification->vue == false) {
            Notification::where('id', $notification->id)->update([
                'vue' => true
            ]);
        }
        

        return view('dashboards.requetes.show', compact('service', 'user','structure','requete'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function edit(Notification $notification)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notification $notification)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notification  $notification
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notification $notification)
    {
        //
    }
}
