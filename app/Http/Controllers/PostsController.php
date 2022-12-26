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

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

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

        return view('posts.index', compact('posts', 'sugg_users'));
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
            'image' => ['image'],
            'video' => ['file']
        ]);
        // $request->validate([
        //     'video', // Confirm the upload is a file before checking its type.
        //     function ($attribute, $value, $fail) {
        //         $is_image = Validator::make(
        //             ['upload' => $value],
        //             ['upload' => 'image']
        //         )->passes();

        //         $is_video = Validator::make(
        //             ['upload' => $value],
        //             ['upload' => 'mimetypes:video/avi,video/mpeg,video/quicktime']
        //         )->passes();

        //         if (!$is_video && !$is_image) {
        //             $fail(':attribute must be image or video.');
        //         }

        //         if ($is_video) {
        //             $validator = Validator::make(
        //                 ['video' => $value],
        //                 ['video' => "max:102400"]
        //             );
        //             if ($validator->fails()) {
        //                 $fail(":attribute must be 10 megabytes or less.");
        //             }
        //         }

        //         if ($is_image) {
        //             $validator = Validator::make(
        //                 ['image' => $value],
        //                 ['image' => "max:1024"]
        //             );
        //             if ($validator->fails()) {
        //                 $fail(":attribute must be one megabyte or less.");
        //             }
        //         }
        //     }
        // ]);

        $imagePath = '';
        $videoPath = '';

        if (request('image')) {

            $imagePath = request('image')->store('/uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->widen(600, function ($constraint) {
                $constraint->upsize();
            });
            $image->save();
        }
        if (request('video')) {

            $videoPath = request('video')->store('/uploads', 'public');
            // $video = Image::make(public_path("storage/{$videoPath}"))->widen(600, function ($constraint) {
            //     $constraint->upsize();
            // });
            // $video = request('video');
            // $video->move(public_path("storage/{$videoPath}"), $video->getClientOriginalName());
        }



        // $video = VideoThumbnail::createThumbnail(
        //     public_path("storage/{$videoPath}"),
        //     public_path("storage/uploads/thumbnails"),
        //     'movie.jpg',
        //     2,
        //     1920,
        //     1080
        // );


        // dd($video,public_path("storage/{$videoPath}"));
        // generate random name for image file
        if(request('video')){

            $image_name = time() . '.jpg';
            FFMpeg::fromDisk('public')
            ->open($videoPath)
            ->getFrameFromSeconds(2)
            ->export()
            ->toDisk('public')
            ->save("uploads/thumbnails/{$image_name}");

            $video_thumbnail = "uploads/thumbnails/{$image_name}";
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
