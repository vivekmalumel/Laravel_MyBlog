<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Post;
use App\Tag;
use App\User;
Use Auth;
use Session;
use File;
use Storage;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts',Post::all());
    }

    public function myPosts(){
        return view('admin.posts.myposts')->with('posts',Auth::user()->posts);
    }

    public function userPosts($id){
        $user=User::find($id);
        return view('admin.posts.userposts')->with('posts',$user->posts)->with('user',$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::all();
        $tags=Tag::all();
        if($categories->count()==0 || $tags->count()==0)
            {
                Session::flash('info','You must have some categories before attempting to create a Post');
                return redirect()->back();
            }
        return view('admin.posts.create')->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->tags);

        $this->validate($request,[
            'title' => 'required|max:255',
            'featured'=> 'required|image',
            'content'   => 'required',
            'category_id' => 'required'

        ]);
       // dd($request->all());
       $featured=$request->featured;
       $featured_new_name=time().$featured->getClientOriginalName();
       $featured->move('uploads/posts',$featured_new_name);
       $user=Auth::user();
       /*$post=Post::create([
           'title'  => $request->title,
           'content'    => $request->content,
           'featured'   => 'uploads/posts/'.$featured_new_name,
           'category_id'=> $request->category_id,
           'slug'  =>  str_slug($request->title),
           'user_id' =>Auth::id()
       ]);*/





        $post=new Post;
        $post->title=$request->title;
        $post->featured='uploads/posts/'.$featured_new_name;
        $post->category_id=$request->category_id;
        $post->slug=str_slug($request->title);
        $post=$user->posts()->save($post);

        File::makeDirectory("uploads/temp/$post->id");

               /*Summer Note*/
       $detail=$request->content;

       $dom = new \domdocument();
       $dom->loadHtml($detail,LIBXML_HTML_NODEFDTD);
       $body = $dom->getElementsByTagName('body')->item(0);
       $dom = new \domdocument();
        foreach ($body->childNodes as $child){
            $dom->appendChild($dom->importNode($child, true));
        }
       $images = $dom->getelementsbytagname('img');

       foreach($images as $k => $img){
           $data = $img->getattribute('src');

           list($type, $data) = explode(';', $data);
           list(, $data)      = explode(',', $data);

           $data = base64_decode($data);
           $image_name= time().$k.'.png';
           $path = public_path()."/uploads/temp/$post->id/". $image_name;

           file_put_contents($path, $data);

           $img->removeattribute('src');
           $img->setattribute('src',"/uploads/temp/$post->id/". $image_name);
       }

       $detail = $dom->savehtml();

        /*End SummerNote*/


        $post->content=$detail;
        $post->save();
        $post->tags()->attach($request->tags);





       Session::flash('success','Post Created Sucessfully');
        return redirect()->back();
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
        $post=Post::find($id);
        return view('admin.posts.edit')->with('post',$post)->with('categories',Category::all())
                                        ->with('tags',Tag::all());

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
        $post=Post::find($id);
        $this->validate($request,[
            'title' => 'required|max:255',
            'content'   => 'required',
            'category_id' => 'required'

        ]);

        //check new image file
        if($request->hasFile('featured'))
        {
            $featured=$request->featured;
            $featured_new_name=time().$featured->getClientOriginalName();
            $featured->move('uploads/posts',$featured_new_name);
            $post->featured='uploads/posts/'.$featured_new_name;

        }

        File::makeDirectory("uploads/temp/$post->id-up");
                 /*Summer Note*/
       $detail=$request->content;

       $dom = new \domdocument();
       $dom->loadHtml($detail,LIBXML_HTML_NODEFDTD);
       $body = $dom->getElementsByTagName('body')->item(0);
       $dom = new \domdocument();
        foreach ($body->childNodes as $child){
            $dom->appendChild($dom->importNode($child, true));
        }
       $images = $dom->getelementsbytagname('img');

       foreach($images as $k => $img){
           $data = $img->getattribute('src');
           if (strpos($data, ';') !== false) {
            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);

            $data = base64_decode($data);

            $image_name= time().$k.'.png';
            $path = public_path()."/uploads/temp/$post->id-up/". $image_name;

            file_put_contents($path, $data);

            $img->removeattribute('src');
            $img->setattribute('src',"/uploads/temp/$post->id/". $image_name);
           }
           else{
               $image_name=basename($data);
               //dd($image_name);
               //Storage::disk('public')->copy($data,"/uploads/temp/$post->id-up/$image_name");
               rename(public_path().$data,public_path()."/uploads/temp/$post->id-up/$image_name");
           }
       }
       File::deleteDirectory("uploads/temp/$post->id");
        rename(public_path()."/uploads/temp/$post->id-up",public_path()."/uploads/temp/$post->id");

       $detail = $dom->savehtml();

        /*End SummerNote*/

        $post->title=$request->title;
        $post->category_id=$request->category_id;
        $post->content=$detail;
        $post->save();
        $post->tags()->sync($request->tags);
        Session::flash('success','Post Updated Successfully');
        return redirect()->route('posts');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->middleware('admin');
        $post=Post::find($id);
        $post->delete();
        Session::flash('success',"The Post was just trashed");
        return redirect()->back();
    }

    public function trashed(){
        $posts=Post::onlyTrashed()->get();
        return view('admin.posts.trashed')->with('posts',$posts);
    }

    public function kill($id){

        $post=Post::withTrashed()->where('id',$id)->first();
        $post->forceDelete();
        Session::flash('success','Post Deleted Permanently');
        return redirect()->back();
    }

    public function restore($id){
        $post=Post::withTrashed()->where('id',$id)->first();
        $post->restore();
        Session::flash('success','Post Restored Successfully');
        return redirect()->back();
    }
}
