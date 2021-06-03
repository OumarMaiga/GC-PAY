<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Repositories\UserRepository;

class RegisteredUserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository) {
        $this->middleware('admin-systeme-only', ['only' => ['index']]);
        $this->userRepository = $userRepository;
    }
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            
            'email' => 'required|string|email|max:255|unique:users',
            'telephone' => 'required|string|max:255',
            'password' => ['required', 'confirmed', Rules\Password::min(8)],
        ]);

        $user = User::create([
            'type' => 'usager',
            'email' => $request->email,
            'telephone' => $request->telephone,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function index()
    {
        //$users=user::all();
       $users = user::where('type','usager')->get();
        return view('dashboards.usager.index')->with('users',$users);
    }


    public function show($email)
    {
        $user = $this->userRepository->getByEmail($email);
        
        
        // show the view and pass the user to it
        return view('dashboards.usager.show',compact('user'));
       
    }

    public function bloquer($id,Request $request)
    {
        $user = $this->userRepository->getById($id);
        if($user->etat==true)
        {
            $request->merge([
                'etat' => false,
            ]);
        }
        else
        {
            $request->merge([
                'etat' => true,
            ]);
        }
        
            
        $this->userRepository->update($id, $request->all());
        
        return redirect('/dashboard/usagers/')->withStatus("L'état de l'utilisateur vient d'être changer");

       

    }
   
}


