<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use function PHPUnit\Framework\result;

class BlogController extends Controller
{
    public function AllBlogCategory()
    {

        $category = BlogCategory::latest()->get();
        return view('manager.blogcategory.blog_category', compact('category'));

    }// End Method

    public function StoreBlogCategory(Request $request)
    {

        BlogCategory::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' => 'BlogCategory Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method


    public function EditBlogCategory($id)
    {

        $categories = BlogCategory::find($id);
        return response()->json($categories);

    }// End Method


    public function UpdateBlogCategory(Request $request)
    {
        $cat_id = $request->cat_id;

        BlogCategory::find($cat_id)->update([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ', '-', $request->category_name)),
        ]);

        $notification = array(
            'message' => 'BlogCategory Updated Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method

    public function DeleteBlogCategory($id)
    {

        BlogCategory::find($id)->delete();

        $notification = array(
            'message' => 'BlogCategory Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);


    }// End Method

    //////////// All Blog Post Method .//

    public function BlogPost()
    {
        $post = BlogPost::latest()->get();
        return view('manager.post.all_post', compact('post'));
    }// End Method


    public function AddBlogPost()
    {

        $blogcat = BlogCategory::latest()->get();
        return view('manager.post.add_post', compact('blogcat'));

    }// End Method

    public function StoreBlogPost(Request $request)
    {
        $validated = $request->validate([
            'blogcat_id' => 'required',
            'post_title' => 'required',
            'post_tags' => 'required',
//            'post_image' => 'required',
        ]);
        if ($request->file('post_image')) {
            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'upload/post/' . $name_gen;
            BlogPost::insert([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),

            ]);
        } else {
            BlogPost::insert([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => null,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),
            ]);
        }



        $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('blog.post')->with($notification);

    }// End Method

    public function EditBlogPost($id)
    {

        $blogcat = BlogCategory::latest()->get();
        $post = BlogPost::find($id);
        return view('manager.post.edit_post', compact('post', 'blogcat'));

    }// End Method


    public function UpdateBlogPost(Request $request)
    {

        $post_id = $request->id;
        $validated = $request->validate([
            'blogcat_id' => 'required',
            'post_title' => 'required',
            'post_tags' => 'required',
        ]);
        if ($request->file('post_image')) {

            $image = $request->file('post_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            $save_url = 'upload/post/' . $name_gen;

            BlogPost::find($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'post_image' => $save_url,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),

            ]);

            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.post')->with($notification);

        } else {

            BlogPost::find($post_id)->update([
                'blogcat_id' => $request->blogcat_id,
                'post_title' => $request->post_title,
                'post_slug' => strtolower(str_replace(' ', '-', $request->post_title)),
                'long_descp' => $request->long_descp,
                'post_tags' => $request->post_tags,
                'created_at' => Carbon::now('Asia/Ho_Chi_Minh'),

            ]);

            $notification = array(
                'message' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('blog.post')->with($notification);

        } // end else

    }// End Method


    public function DeleteBlogPost($id)
    {

        $item = BlogPost::find($id);
        if ($item->post_image) {
            $img = $item->post_image;
            unlink($img);
        }



        BlogPost::find($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);

    }// End Method

    public function BlogDetails($id)
    {
        $blog = BlogPost::where('id', $id)->first();
//        dd($blog);
        $tags = $blog->post_tags;
        $tags_all = explode(',', $tags);
        $bcategory = BlogCategory::latest()->get();
        $post = BlogPost::latest()->limit(3)->get();
        return view('manager.post.blog_details', compact('blog', 'tags_all', 'bcategory', 'post'));

    }// End Method
}
