<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Str;
class BlogController extends Controller
{
    public function categoryPost(Request $request, $slug)
    {
        if (!$slug) {
            return abort(404);
        } else {
            $subcategory = SubCategory::where('slug', $slug)->first();
            if (!$subcategory) {
                return abort(404);
            } else {
                $posts = Post::where('category_id', $subcategory->id)
                    ->orderBy('created_at', 'desc')
                    ->paginate(2);
                $data = [
                    'pageTitle' => 'Subcategory - ' . $subcategory->subcategory_name,
                    'category' => $subcategory,
                    'posts' => $posts
                ];

                return view('front.pages.category_posts', $data);
            }
        }
    }

    public function searchBlog(Request $request)
    {
        $query = request()->query('query');
        if ($query && strlen($query) >= 2) {
            $searchValue = preg_split('/\s+/', $query, -1, PREG_SPLIT_NO_EMPTY);
            $posts = Post::query();
            $posts->where(function ($q) use ($searchValue) {
                foreach ($searchValue as $value) {
                    $q->orWhere('post_title', 'LIKE', "%{$value}%");
                    $q->orWhere('post_tags', 'LIKE', "%{$value}%");
                }
            });

            $posts = Post::with('subcategory')
                ->with('author')
                ->orderBy('created_at', 'desc')
                ->paginate(6);

            $data = [
                'pageTitle' => 'Search for :: ' . request()->query('query'),
                'posts' => $posts
            ];

            return view('front.pages.search_posts', $data);
        } else {
            return abort(404);
        }
    }

    public function readPost($slug)
    {
        if (!$slug) {
            abort(404);
        } else {
            $posts = Post::where('slug', $slug)
                ->with('subcategory')
                ->with('author')
                ->first();

            $posts_tags = explode(',', $posts->post_tags);
            $related_post = Post::where('id', '!=', $posts->id)
                ->where(function ($query) use ($posts_tags, $posts) {
                    foreach ($posts_tags as $item) {
                        $query->orWhere('post_tags', 'LIKE', "%$item%")
                            ->orWhere('post_title', 'LIKE', $posts->post_title);
                    }
                })
                ->inRandomOrder()
                ->take(3)
                ->get();
            $data = [
                'pageTitle' => Str::ucfirst($posts->post_title),
                'posts' => $posts,
                'related_post' => $related_post
            ];
            return view('front.pages.single_post', $data);
        }
    }

    public function tagPost(Request $request, $tag)
    {
        $posts = Post::where('post_tags', 'LIKE', '%' . $tag . '%')
            ->with('subcategory')
            ->with('author')
            ->orderBy('created_at', 'desc')
            ->paginate(4);

        if (!$posts) {
            return abort(404);
        }

        $data = [
            'pageTitle' => '#' . $tag,
            'posts' => $posts
        ];
        return view('front.pages.tags_post', $data);
    }
}
