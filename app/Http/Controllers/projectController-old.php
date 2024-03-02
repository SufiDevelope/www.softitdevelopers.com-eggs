<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RegisteredUser;
use App\Models\Admin;
use App\Models\Review;
use App\Models\Customer;
use App\Mail\RegisterMail;
use Auth;
use Mail;
use Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use GuzzleHttp\Client;



class projectController extends Controller
{
   
    public function index(){
        $reviews = Review::all();
        return view('project.home', ['reviews' => $reviews]);
        // return view('project.home');
    }

    // public function signup(Request $request)
    // {
    //     if($request->isMethod('post')){
    //         $data = $request->all();
    //         // dd($data);die;
    //         $validatedData = $request->validate([
    //         'first_name' => 'required|string|max:255',
    //         'last_name' => 'required|string|max:255',
    //         'email' => 'required|email|unique:customers|max:255',
    //         'password' => 'required|string|min:6',
    //         'phone' => 'nullable|numeric',
    //     ]);

    //         $RegisteredUser = new Customer;
    //         $RegisteredUser->first_name = $validatedData['first_name'];
    //         $RegisteredUser->last_name = $validatedData['last_name'];
    //         $RegisteredUser->email = $validatedData['email'];
    //         $RegisteredUser->password = bcrypt($validatedData['password']);
    //         $RegisteredUser->phone = $validatedData['phone'];
    //         $RegisteredUser->status = 1;
    //         $RegisteredUser->save();

    //         return redirect('signin')->with('success','Congratulation! You are registered successfully. You can login now.');
    //     }
    // }

     public function signup(Request $request)
{
    if ($request->isMethod('post')) {
        $data = $request->all();

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers|max:255',
            'password' => 'required|string|min:6',
            'phone' => 'nullable|numeric',
        ]);

        $registeredUser = new Customer;
        $registeredUser->first_name = $validatedData['first_name'];
        $registeredUser->last_name = $validatedData['last_name'];
        $registeredUser->email = $validatedData['email'];
        $registeredUser->password = bcrypt($validatedData['password']);
        $registeredUser->phone = $validatedData['phone'];
        $registeredUser->status = 1;
        $registeredUser->remember_token = Str::random(40);
        $registeredUser->save();

        // Pass the user's email to the RegisterMail constructor
        Mail::to($registeredUser->email)->send(new RegisterMail($registeredUser));

        return redirect('signin')->with('success', 'Congratulation! You are registered successfully. Verify your email address to continue.');
    }
}


    public function verify($token){
        $user = Customer::where('remember_token','=',$token)->first();
        if(!empty($user)){
            $user->email_verified_at = date('Y-m-d H:i:s');
            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('signin')->with('success','Congratulation! Your account is verified successfully.');
        }
        else{
            abort(404);
        }
    }


     public function signin(Request $req){

        if($req->isMethod('post')){
            $data = $req->all();
            // dd($data);die;
            // print_r($data);die;

                $validated = $req->validate([
                'email' => 'required|email|max:255',
                'password' => 'required',
            ]);
            
           if(Auth::guard('customer')->attempt(['email'=>$data['email'],'password'=>$data['password']])){
                if(!empty(Auth::guard('customer')->user()->email_verified_at)){
                    return redirect('/');
                    // echo "all ok";
                }
                else{

                    $RegisteredUser = Customer::getSingle(Auth::guard('customer')->user()->id);
                    $RegisteredUser->remember_token = Str::random(40);
                    $RegisteredUser->save();
                    Auth::logout();
                    // again send email
                    Mail::to($RegisteredUser->email)->send(new RegisterMail($RegisteredUser));
                    return redirect('signin')->with('success','Please first verify your email address.!');
                }
                
           }
            else{
                return redirect()->back()->with('error','Incorrect Email or Password!');
            }
        }
       
    }

    public function logout(){
        Auth::guard('customer')->logout();
        return redirect('signin');
    }

    public function review(){
        return view('project.review');
    }

    public function editUserProfile(Request $request){ 
    if($request->isMethod('post')){
        $data = $request->all();
        
        $updateData = [
            'first_name' => $data['first_name'],
            'last_name'  => $data['last_name'],
            'phone'     => $data['phone'],
        ];

        Customer::where('id', Auth::guard('customer')->user()->id)->update($updateData);

        return redirect('review')->with('success', 'Profile has been updated successfully!');
    }

    return view('project.editUserProfile');
    }

    public function review2(){
        return view('project.review2');
    }

    public function add_review(Request $req){

    if($req->isMethod('post')){
        $data = $req->all();

        $validatedData = $req->validate([
            'subject' => 'required',
            'review_message' => 'required',
            'image' => 'image',
            'date' => 'required',
        ]);

        $customer_id = Auth::guard('customer')->user()->id;

        $review = new Review;
        $review->subject = $data['subject'];
        $review->review_message = $data['review_message'];
        $review->date = $data['date'];
        $review->customer_id = $customer_id;
        $review->review_points = $data['review_points'];
        $review->latitude = $data['latitude'];
        $review->longitude = $data['longitude'];
        // $review->image = $data['image'];

        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $review->image = 'images/'.$imageName; // Store the path in the database
        }

        $review->save();
        // return redirect('add_review')->with('success', 'Congratulations! Your review has been submitted successfully.');
        return redirect('api')->with('success', 'Congratulations! Your review has been submitted successfully.');
    }

    $reviews = Review::all();
    return view('project.add_review', ['reviews' => $reviews]);
    }


    public function singleCard($id)
    {
        $review = Review::find($id);

        if (!$review) {
            abort(404);
        }

        return view('project.single-card', ['review' => $review]);
    }


    // public function api_data()
    // {
    //     $apiKey = 'AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I';
    //     $baseUrl = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';

    //     $client = new Client();

    //     $latitude = 37.7749; // Latitude for San Francisco, USA
    //     $longitude = -122.4194; // Longitude for San Francisco, USA

    //     $response = $client->get($baseUrl, [
    //         'query' => [
    //             'location' => $latitude . ',' . $longitude,
    //             'radius' => '5000', 
    //             'type' => 'restaurant',
    //             'key' => $apiKey,
    //         ],
    //     ]);

    //     $data = json_decode($response->getBody(), true);

    //     // Paginate the data with 10 items per page
    //     $perPage = 10;
    //     $currentPage = Paginator::resolveCurrentPage('page');
    //     $currentItems = array_slice($data['results'], ($currentPage - 1) * $perPage, $perPage);

    //     $paginatedData = new LengthAwarePaginator(
    //         $currentItems,
    //         count($data['results']),
    //         $perPage,
    //         $currentPage,
    //         ['path' => Paginator::resolveCurrentPath()]
    //     );

    //     return view('project.api_data', ['places' => $paginatedData]);
    // }
    public function api_data()
{
    $apiKey = 'AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I';
    $baseUrl = 'https://maps.googleapis.com/maps/api/place/nearbysearch/json';

    $client = new Client();

    $latitude = 37.7749; // Latitude for San Francisco, USA
    $longitude = -122.4194; // Longitude for San Francisco, USA

    $response = $client->get($baseUrl, [
        'query' => [
            'location' => $latitude . ',' . $longitude,
            'radius' => '5000', // in meters
            'type' => 'restaurant',
            'key' => $apiKey,
        ],
    ]);

    $googlePlacesData = json_decode($response->getBody(), true);

    // Fetch your reviews data
    $reviews = Review::all();

    // Paginate the Google Places API data with 10 items per page
    $perPage = 10;
    $currentPage = Paginator::resolveCurrentPage('page');
    $currentItems = array_slice($googlePlacesData['results'], ($currentPage - 1) * $perPage, $perPage);

    $paginatedData = new LengthAwarePaginator(
        $currentItems,
        count($googlePlacesData['results']),
        $perPage,
        $currentPage,
        ['path' => Paginator::resolveCurrentPath()]
    );

    return view('project.api_data', ['places' => $paginatedData, 'reviews' => $reviews]);
}

   public function singleApi($place_id)
    {
        // Replace 'YOUR_API_KEY' with your actual Google API key
        $apiKey = 'AIzaSyAeIaTdMSWLzpCC5LaB_A4T503Aa7lM67I';

        // Make a request to the Places API to get details for the specified place_id
        $response = Http::get("https://maps.googleapis.com/maps/api/place/details/json", [
            'place_id' => $place_id,
            'key' => $apiKey,
        ]);

        $data = $response->json();

        // Check if the request was successful and data is available
        if ($response->successful() && isset($data['result'])) {
            $restaurant = $data['result'];

            // Fetch reviews from your database or API
            $reviews = Review::all();

            // Pass the data to the view
            return view('project.single_api', compact('restaurant', 'reviews'));
        } else {
            // Handle the case where the API request fails or data is not available
            return view('project.single_api', ['error' => 'Failed to fetch restaurant details']);
        }
    }

}

