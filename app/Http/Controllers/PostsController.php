<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Intervention\Image\Facades\Image;
use FFMpeg;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\App;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->profile) : false;

        // Array of users that the auth user follows
        $users_id = auth()->user()->following()->pluck('profiles.user_id');

        // Get Users Id form $following array
        $sugg_users = User::all()->reject(function ($user) {
            $users_id = auth()->user()->following()->pluck('profiles.user_id')->toArray();
            return $user->id == Auth::id() || in_array($user->id, $users_id);
        });

        // Add Auth user id to users id array
        $users_id = $users_id->push(auth()->user()->id);

        // $posts = Post::whereIn('user_id', $users)->with('user')->latest()->paginate(5);
        $posts = Post::whereIn('user_id', $users_id)->with('user')->latest()->paginate(10)->getCollection();

        // dd($posts);

        return view('posts.index', compact('posts', 'sugg_users', 'follows'));
    }

    public function explore()
    {
        $posts = Post::all()->except(Auth::id())->shuffle();

        return view('posts.explore', compact('posts'));
    }

    public function create()
    {
        return view('posts.create');
    }

    public function store(Request $request)
    {
        // dd(request('video'));

        $data = request()->validate([
            'caption' => ['required', 'string'],
            'video' => ['file', 'max:100000000', 'mimes:avi,mpeg,quicktime,mp4,mov,3gp,3gpp,3gpp2,3g2,wmv,flv,webm,ogg,jpeg,png,jpg,gif,svg,svg+xml,webp,bmp,vnd.microsoft.icon,tiff,vnd.adobe.photoshop,heic,heif']
        ]);

        $imagePath = '';
        $videoPath = '';

        if (request('video')->getMimeType() == 'image/jpeg' | request('video')->getMimeType() == 'image/png' | request('video')->getMimeType() == 'image/jpg' | request('video')->getMimeType() == 'image/gif' | request('video')->getMimeType() == 'image/svg' | request('video')->getMimeType() == 'image/svg+xml' | request('video')->getMimeType() == 'image/webp' | request('video')->getMimeType() == 'image/bmp' | request('video')->getMimeType() == 'image/vnd.microsoft.icon' | request('video')->getMimeType() == 'image/tiff' | request('video')->getMimeType() == 'image/vnd.adobe.photoshop' | request('video')->getMimeType() == 'image/heic' | request('video')->getMimeType() == 'image/heif') {

            $imagePath = request('video')->store('/uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->widen(600, function ($constraint) {
                $constraint->upsize();
            });
            $image->save();
        }
        else if (request('video')->getMimeType() == 'video/avi' | request('video')->getMimeType() == 'video/mpeg' | request('video')->getMimeType() == 'video/quicktime' | request('video')->getMimeType() == 'video/mp4' | request('video')->getMimeType() == 'video/mov' | request('video')->getMimeType() == 'video/3gp' | request('video')->getMimeType() == 'video/3gpp' | request('video')->getMimeType() == 'video/3gpp2' | request('video')->getMimeType() == 'video/3g2' | request('video')->getMimeType() == 'video/wmv' | request('video')->getMimeType() == 'video/flv' | request('video')->getMimeType() == 'video/webm' | request('video')->getMimeType() == 'video/ogg') {

            $videoPath = request('video')->store('/uploads', 'public');
            $image_name = time() . '.jpg';
            FFMpeg::fromDisk('public')
                ->open($videoPath)
                ->getFrameFromSeconds(2)
                ->export()
                ->toDisk('public')
                ->save("uploads/thumbnails/{$image_name}");

            $video_thumbnail = "uploads/thumbnails/{$image_name}";
        }
        else{
            return Redirect::back()->withErrors(['video' => 'Invalid File Type']);
        }
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath ? $imagePath : $video_thumbnail,
            'video' => $videoPath
        ]);

        return redirect('/profile/' . auth()->user()->username);
        // return redirect()->route('profile.index', ['user' => auth()->user()]);
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete', $post);

        $post->delete();

        return Redirect::back();
    }

    public function show(Post $post)
    {
        $posts = $post->user->posts->except($post->id);
        return view('posts.show', compact('post', 'posts'));
    }

    public function updatelikes(Request $request, $post)
    {
        // TODO Later
        $post = Post::where('id', $post)->first();
        if (!$post) {
            App::abort(404);
        }

        if ($request->update == "1") {
            // add 1 like
            $post->likes = $post->likes + 1;
            $post->save();
        } else if ($request->update == "0" && $post->likes != 0) {
            // take 1 like
            $post->likes = $post->likes - 1;
            $post->save();
        }


        return Redirect::to('/');
    }

    // methods for vue api requests
    public function vue_index()
    {
        $data = Post::orderBy('id')->with('user')->latest()->paginate(5);
        return response()->json($data);
    }
}
