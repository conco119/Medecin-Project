<?php

namespace App\Http\Controllers\Site;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contracts\Repositories\CategoryRepository;
use App\Contracts\Repositories\PostRepository;
use App\Contracts\Repositories\MediaRepository;

class IndexController extends Controller
{
    protected $category;
    protected $post;
    protected $media;

    /**
     * Pham Viet Toan
     * 09/27/2017
     *
     * Construct function
     * @param App\Contracts\Repositories\PostRepository $post
     * @param App\Contracts\Repositories\CategoryRepository $category
     */
    public function __construct(
        PostRepository $post,
        CategoryRepository $category,
        MediaRepository $media
    )
    {
        $this->category = $category;
        $this->post = $post;
        $this->media = $media;
    }

    /**
     * Pham Viet Toan
     * 09/27/2017
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $posts = $this->post->getAllPostNew(['categories']);
       $i = 0;
       $postNewest = [];
        foreach ($posts as $post) {
            if ($post->categories->status == config('custom.category.show')) {
                     $postNewest[] = $post;
            }
        }
        $postNewest = array_slice($postNewest, 0, 3);
        
        $sliders = $this->media->getSLidersIndex([]);
        foreach ($sliders as $value) {
            $value->path = asset(config('custom.media.sliders.defaultPath') . $value->path);
        }
        $videoIntro = asset(config('custom.media.video_intro.defaultPath') . $this->media->getVideoIntro([])->path);

        return view('index', compact('postNewest', 'sliders', 'videoIntro'));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
