<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreatePostDataAPIRequest;
use App\Http\Requests\API\UpdatePostDataAPIRequest;
use App\Models\PostData;
use App\Repositories\PostDataRepository;
use App\Repositories\FilesPathRepository;
use Illuminate\Http\Request;
use App\Http\Resources\PostResource;
use App\Http\Resources\SingelPostResource;
use App\Http\Controllers\AppBaseController;
use Response;
use App\Events\BlogEvent;
use Storage;
use Str;
use Auth ;
use Image;
use FFMpeg;

/**
 * Class PostDataController
 * @package App\Http\Controllers\API
 */

class PostDataAPIController extends AppBaseController
{
    /** @var  PostDataRepository */
    private $postDataRepository;
    private $filesPathRepository;

    public function __construct(PostDataRepository $postDataRepo, FilesPathRepository $filesPathRepo)
    {
        $this->postDataRepository = $postDataRepo;
        $this->filesPathRepository = $filesPathRepo;
    }
       public function testPusher(){
           $data =  broadcast(new BlogEvent('hello world')); 
           return $this->sendResponse($data , 'Post Data saved successfully');
       }
     
    /**
     * Display a listing of the PostData.
     * GET|HEAD /postDatas
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $user_data = Auth::user();
        // $postDatas = $this->postDataRepository->all(
        //     $request->except(['skip', 'limit']),
        //     $request->get('skip'),
        //     $request->get('limit')
        // );
        $query = PostData::orderBy('id','DESC');
        if($request->cat_id){
           $query->where('cat_id', $request->cat_id ); 
        }
        $data_return = $query->paginate(10); 
        $data_return  = PostResource::collection($data_return);
        return $this->sendResponse(  $data_return  , 'Post retrieved successfully');

        //return $this->sendResponse($postDatas->toArray(), 'Post Datas retrieved successfully');
    }

    /**
     * Store a newly created PostData in storage.
     * POST /postDatas
     *
     * @param CreatePostDataAPIRequest $request
     *
     * @return Response
     */
    public function store(CreatePostDataAPIRequest $request)
    { 
        $user_data = Auth::user();
        $request['user_id'] =$user_data->id ; 
        $input = $request->all(); 
        //return response()->json($input);
        // do work in laravel from image and video in api
        $upload_path = base_path('storage/app/public/posts'); 
          
        $postData = $this->postDataRepository->create($input); 
  
        if($request['files_base']) { 
            $file = $request['files_base']; //$request['files_base']; 
            $extension = $file->getClientOriginalExtension();
            $path = $upload_path; //public_path().'/uploads/videos/';
            $fileNameToStore = time().'.'.$extension; 
            $img = Image::make($file->getRealPath());
            $height = Image::make($file)->height(); 
            $width = Image::make($file)->width(); 
         
            //small thumbnail name
            $smallthumbnail = 'small_'.time().'.'.$extension;
            //medium thumbnail name
            $mediumthumbnail = 'medium_'.time().'.'.$extension;
            //large thumbnail name
            $largethumbnail = 'large_'.time().'.'.$extension;
            
            $img->resize(150, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(base_path('storage/app/public/thumbnail').'/'.$smallthumbnail); 
            
            $img->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(base_path('storage/app/public/thumbnail').'/'.$mediumthumbnail); 
            
            $img->resize(550, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(base_path('storage/app/public/thumbnail').'/'.$largethumbnail); 
                
            $file->move($path, $fileNameToStore);   
            $fileInput['post_id'] = $postData->id;
            $fileInput['user_id'] = $user_data->id;
            $fileInput['path'] = $fileNameToStore; 
            $filesController = $this->filesPathRepository->create($fileInput); 
        }
        return $this->sendResponse($postData->toArray(), 'Post Data saved successfully');
    }
    
     // image upload worked 04/08/2022 
    public function store_backup(CreatePostDataAPIRequest $request)
    { 
        $user_data = Auth::user();
        $request['user_id'] = $user_data->id ; 
        $input = $request->all(); 
        // do work in laravel from image and video in api
        $upload_path = base_path('storage/app/public/posts'); 
        $postData = $this->postDataRepository->create($input); 
        if($request['files_base']) { 
            $file = $request['files_base']; //$request['files_base'];
            $filename = $file->getClientOriginalName(); 
            $extension = $file->getClientOriginalExtension();
            $path = $upload_path; //public_path().'/uploads/videos/';
            $fileNameToStore = time().'.'.$extension;
            $file->move($path, $fileNameToStore);   
            $fileInput['post_id'] = $postData->id;
            $fileInput['user_id'] = $user_data->id;
            $fileInput['path'] = $fileNameToStore; 
            $filesController = $this->filesPathRepository->create($fileInput); 
        }
        if($request['files_base']) {    
            $fileInput['post_id'] = $postData->id;
            $fileInput['user_id'] = $user_data->id;
            $fileInput['path'] = $fileNameToStore; 
            $filesController = $this->filesPathRepository->create($fileInput); 
        }
        return $this->sendResponse($postData->toArray(), 'Post Data saved successfully');
    }
    
    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);
    }
 
    
    public function videoStore(CreatePostDataAPIRequest $request)
    { 
        $user_data = Auth::user();
        $request['user_id'] =  $user_data->id ;
        $input = $request->all();
        // do work in laravel from image and video 
        
        
        $postData = $this->postDataRepository->create($input);
        
        if($request::hasFile('files_base')){
            $file = $request::file('files_base');
            $filename = $file->getClientOriginalName(); 
            $extension = $file->getClientOriginalExtension();
            $path = public_path().'/uploads/videos/';
            $fileNameToStore = time().'.'.$extension;
            $file->move($path, $fileNameToStore);  
            $fileInput['post_id'] = $postData->id;
            $fileInput['user_id'] = $user_data->id;
            $fileInput['path'] = $fileNameToStore; 
            $filesController = $this->filesPathRepository->create($fileInput);
        } 
        
        
        // if($request['files_base']){ 
        //     foreach ($request->files_base as $key => $value) { 
        //         $image_64 = $value; 
        //         $extension = explode('/', explode(':', substr($image_64, 0, strpos($image_64, ';')))[1])[1];   // .jpg .png .pdf
        //         $replace = substr($image_64, 0, strpos($image_64, ',') + 1);
        //         $image = str_replace($replace, '', $image_64);
        //         $image = str_replace(' ', '+', $image);
        //         $imageName = Str::random(20) . '.' . $extension;
        //         Storage::disk('posts')->put($imageName, base64_decode($image)); 
        //         $fileInput['post_id'] = $postData->id;
        //         $fileInput['user_id'] = $user_data->id;
        //         $fileInput['path'] = $imageName; 
        //         $filesController = $this->filesPathRepository->create($fileInput); 
        //     }  
        // }

        return $this->sendResponse($postData->toArray(), 'Post Data saved successfully');
    }

    /**
     * Display the specified PostData.
     * GET|HEAD /postDatas/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var PostData $postData */
        $postData = $this->postDataRepository->find($id);

        if (empty($postData)) {
            return $this->sendError('Post Data not found');
        }
        // $data_return = new PostResource($postData);

        // return $this->sendResponse($data_return, 'Post Data retrieved successfully');
        
         
        $task = PostData::find($id); 
        $data_return  = new  PostResource($task);
        return $this->sendResponse(  $data_return  , 'Post retrieved successfully');
    }
    public function singelpost($id){
          /** @var PostData $postData */
        // $postData = $this->postDataRepository->find($id);

        // if (empty($postData)) {
        //     return $this->sendError('Post Data not found');
        // }
        // $data_return = new PostResource($postData);

        // return $this->sendResponse($data_return, 'Post Data retrieved successfully');
        
         
        $task = PostData::find($id); 
        $data_return  = new  SingelPostResource($task);
        return $this->sendResponse(  $data_return  , 'Post retrieved successfully');
        
    }

    /**
     * Update the specified PostData in storage.
     * PUT/PATCH /postDatas/{id}
     *
     * @param int $id
     * @param UpdatePostDataAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdatePostDataAPIRequest $request)
    {
        $input = $request->all();

        /** @var PostData $postData */
        $postData = $this->postDataRepository->find($id);

        if (empty($postData)) {
            return $this->sendError('Post Data not found');
        }

        $postData = $this->postDataRepository->update($input, $id);

        return $this->sendResponse($postData->toArray(), 'PostData updated successfully');
    }

    /**
     * Remove the specified PostData from storage.
     * DELETE /postDatas/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var PostData $postData */
        $postData = $this->postDataRepository->find($id);

        if (empty($postData)) {
            return $this->sendError('Post Data not found');
        }

        $postData->delete();

        return $this->sendSuccess('Post Data deleted successfully');
    }
    
    public function videoUpload(Request $request){
        $validator = Validator::make($request->all(), 
              [ 
              'user_id' => 'required',
              'file' => 'required|mimes:doc,docx,pdf,txt|max:2048',
             ]);   
 
        if ($validator->fails()) {          
            return response()->json(['error'=>$validator->errors()], 401);                        
        }  
 
  
        if ($files = $request->file('file')) {
             
            //store file into document folder
            $file = $request->file->store('public/documents');
 
            //store your file into database
            $document = new Document();
            $document->title = $file;
            $document->user_id = $request->user_id;
            $document->save();
              
            return response()->json([
                "success" => true,
                "message" => "File successfully uploaded",
                "file" => $file
            ]);
  
        }
    }
}
