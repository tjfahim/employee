<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index()
    {
        $employee= User::where('status','active')->where('role','employee')->get();
        $posts = Post::where('status','0')->latest()->paginate(5);
        return view('backend.posts', compact('posts','employee'));
    }


    public function store(Request $request)
    {
        // Manual validation of form data
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|numeric', 
            'company_name' => 'required|string|max:255', 
            'description' => 'nullable|string',
            'image' => 'nullable|string',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }
    
        // Handle the file upload if image is present
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        } else {
            $imagePath = null;
        }
    
        // Create a new post instance and fill with form data
        $post = new Post();
        $post->employee_id = $request->employee_id;
        $post->company_name = $request->company_name;
        $post->description = $request->description;
        $post->image = $imagePath;
        $post->latitude = $request->latitude;
        $post->longitude = $request->longitude;
    
        // Save the post data to the database
        $post->save();
        return response()->json(['status' => 'success']);
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'u_company_name' =>  'required|string|max:255', 
            'u_description' => 'nullable|string',
            'u_latitude' => 'nullable|string',
            'u_longitude' => 'required|numeric',
            'u_image' => 'nullable',
        ]);
  
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422); // 422 Unprocessable Entity
        }


        
      Post::where('id', $request->u_id)->update([
        'company_name' => $request->u_company_name,
        'description' => $request->u_description,
        'latitude' => $request->u_latitude,
        'longitude' => $request->u_longitude,
        'image' => $request->u_image,
        ]);
        
        return response()->json(['status' => 'update']);

    }
    public function destroy(Request $request)
    {

      Post::where('id', $request->id)->update([
      'status' => '1',
      ]);
      
        return response()->json(['status' => 'deleted']);

    }

    
}
