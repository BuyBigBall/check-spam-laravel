<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Settings;
use App\Models\Post;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use DB;
use Hash, Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::where('role', 'user')->get();
        $users = DB::table('users')
            ->join('test_results', 'test_results.user_id', '=', 'users.id', 'left')
            ->join('balances', 'balances.user_id', '=', 'users.id', 'left')
            //->join('profiles', 'profiles.user_id','=', 'users.id', 'left')
            ->select(DB::raw('count( distinct test_results.id) as test_counts') ,
                    DB::raw('sum(balances.price*balances.qty) as charge'), 
                    DB::raw('sum(balances.supply) as supply'), 
                    DB::raw('sum(balances.supply)-sum(balances.used) as remain'), 
                    DB::raw("(SELECT concat(firstname, ' ', lastname) FROM profiles WHERE default_address=1 AND user_id=users.id) as fullname"), 
                    'users.id' 
                    ,'users.name' 
                    ,'users.created_at' 
                    ,'users.mode' 
                    // ,'profiles.firstname'
                    // ,'profiles.lastname'
                    // ,'profiles.company'
                    // ,'profiles.address'
                    // ,'profiles.postcode'
                    // ,'profiles.city'
                    // ,'profiles.telephone'
                    // ,'profiles.country'
                    // ,'profiles.state'
                     )
                     ->where('users.role', DB::raw('\'user\''))
           //          ->where(DB::raw('IFNULL(profiles.default_address,1)'), '1')

            ->groupBy( ['users.id', 'users.name', 'users.created_at', 'users.mode'] )
            ->get();
        
        return view('backend.users.index')->with('users', $users);//->with('msg', $msg);
    }

    public function profile($id)
    {
        //print_r($id); die;
        $user_profile = Profile::where('user_id', $id)->get()->first();
        // if($user_profile==null)
        // {
        //     return redirect( route('users.index'))->with('msg', __('Could not found user information'));    
        // }
        return view('backend.users.profile')
                ->with('user_id', $id)
                ->with('user_profile', $user_profile);
    }
    public function saveprofile(Request $request)
    {
        //print_r($request); die;

        $request->validate([
            'firstname' => 'required|max:255|min:2',
            'lastname'  => 'required|max:255|min:2',
            'country'   => 'required|max:255|min:2',
            'address'   => 'required|max:255|min:2',
            'city'      => 'required|max:255|min:2',
            'state'     => 'required|max:255|min:2',
            'mail_addr' => 'email|required|max:255|min:2',
            'telephone' => 'required|max:12|min:8|regex:/[0-9]/', //|regex:/(01)[0-9]{9}/
            'state'     => 'required|max:255|min:2',
            'postcode'  => 'required|max:255|min:6',
        ]);
        
        $data = [
            'user_id'   =>$request->user_id,
            'firstname' => $request->firstname ,
            'lastname'  => $request->lastname ,
            'company'   => $request->company ,
            'country'   => $request->country   ,
            'address'   => $request->address   ,
            'city'      => $request->city      ,
            'state'     => $request->state     ,
            'mail_addr' => $request->mail_addr ,
            'telephone' => $request->telephone ,
            'state'     => $request->state     ,
            'postcode'  => $request->postcode  ,
            'default_address' => 1
        ];
        $user_profile = Profile::where('user_id', $request->user_id)->get()->first();
        if($user_profile==null)
        {
            $profile = new Profile();
            $profile->user_id        = $request->user_id;
            $profile->firstname      = $request->firstname;
            $profile->lastname       = $request->lastname;
            $profile->company        = $request->company;
            $profile->country        = $request->country;
            $profile->address        = $request->address;
            $profile->city           = $request->city;
            $profile->state          = $request->state;
            $profile->mail_addr      = $request->mail_addr;
            $profile->telephone      = $request->telephone;
            $profile->state          = $request->state;
            $profile->postcode       = $request->postcode;
            $profile->default_address= 1;
            $new_id = $profile->save();
           // print_r($new_id); die;
        }
        else
        {
            $result = Profile::where('user_id', $request->input('user_id'))->update($data);
        }
        

        session()->flash('success', 'User Updated Successfuly');
        return redirect(route('users.index'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //die;
        //validate the user fields
        $request->validate([
            'name' => 'required|max:255|min:2',
        ]);
        if($request->password!=$request->confirmpassword)
        {
            session()->flash('error', 'User password no matched.');
            return redirect(route('users.index'));
        }
        $user = new User();
        $user->name = $request->name;
        if( !empty($request->password) )
        {
            $user->password = Hash::make($request->password);
        }

        $user->mode = $request->status;
        //$users->slug = SlugService::createSlug(User::class, 'slug', $request->name);
        $user->save();

        session()->flash('success', 'User Created Successfuly');
        return redirect(route('users.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        $user = User::where('slug', $user)->first();

        $title = translate('Default Title', 'seo');
        $description = translate('Default Description', 'seo');
        $keyword = translate('Default keywords', 'seo');
        $canonical = url()->current();
        SEOMeta::setTitle($title . ' ' .Settings::selectSettings('separator'). ' ' . $user->name);
        SEOMeta::setDescription($description);
        SEOMeta::setKeywords($keyword);
        SEOMeta::setCanonical($canonical);
        OpenGraph::setTitle($title . ' ' .Settings::selectSettings('separator'). ' ' . $user->name);
        OpenGraph::setDescription($description);
        OpenGraph::setSiteName(Settings::selectSettings('name'));
        OpenGraph::addImage(asset(Settings::selectSettings('og_image')));
        OpenGraph::setUrl($canonical);
        OpenGraph::addProperty('type', 'article');


        $limit = Settings::selectSettings('max_posts');
        $test_results = TestResult::where("user_id", "=", $user->id)->orderBy('created_at', 'DESC')->paginate($limit);

        return view('frontend.user', compact('test_results', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if($user->id==null)
        {
            return redirect( route('users.index'))->with('msg', __('Could not found user information'));    
        }
        return view('backend.users.edit')->with('user', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {

        $request->validate([
            'name' => 'required|max:255|min:2',
            //'slug' => 'required|unique:users,slug,' . $user->id,
        ]);

        if($request->password!=$request->confirmpassword)
        {
            session()->flash('error', 'User password no matched.');
            return redirect(route('users.index'));
        }
        $data = [];
        if( !empty($request->password) )
        {
            $data['password'] = Hash::make($request->password);
        }
        $data = [
            'name' => $request->name,
            'mode' => $request->status,
            'email' => $request->email,
            //'slug' => SlugService::createSlug(User::class, 'slug', $request->slug, ['unique' => false])
        ];

        $user->update( $data );

        session()->flash('success', 'User Updated Successfuly');
        return redirect(route('users.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $users
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //print_r($user); die;
        $user->delete();

        session()->flash('success', 'User Deleted Successfuly');

        return redirect(route('users.index'));
    }


    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(User::class, 'slug', $request->name);

        return response()->json(['slug' => $slug]);
    }
}
