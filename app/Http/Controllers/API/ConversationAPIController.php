<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConversationAPIRequest;
use App\Http\Requests\API\UpdateConversationAPIRequest;
use App\Models\Conversation;
use App\Repositories\ConversationRepository;
use Illuminate\Http\Request;
use App\Http\Resources\ConversationsResource;
use App\Http\Controllers\AppBaseController;
use Response;
use DB, Auth;
use App\Models\User;
use App\Models\ChatMessage;
use App\Events\ChatEvent;

/**
 * Class ConversationController
 * @package App\Http\Controllers\API
 */

class ConversationAPIController extends AppBaseController
{
    /** @var  ConversationRepository */
    private $conversationRepository;

    public function __construct(ConversationRepository $conversationRepo)
    {
        $this->conversationRepository = $conversationRepo;
    }

    /**
     * Display a listing of the Conversation.
     * GET|HEAD /conversations
     *
     * @param Request $request
     * @return Response
     */
     
    public function test_message()
    {

        $list= ChatMessage::create(['chat_id' => 1, 'user_id' => 1, 'text' => 'Hello World']);
        return $this->sendResponse($list, 'Conversations list retrieved successfully');
    }
    public function test_chart()
    {
        
         $data =  broadcast(new ChatEvent([ 'user_id' => 1, 'text' => 'Hello World']));  
 
        return $this->sendResponse($data, 'Conversations list retrieved successfully');
    }
    public function conversation_list(Request $request)
    {

        $list = DB::select("call conversation_list(" . Auth::user()->id . ")");
        //$list = User::all();
        return $this->sendResponse($list, 'Conversations list retrieved successfully');
    }

    public function index(Request $request)
    {
        if(!$request->receiver_id || $request->receiver_id==Auth::user()->id){
            return $this->sendError('Please select chat');
        }
        $conversations = $this->conversationRepository->chat_list($request->receiver_id);

        return $this->sendResponse($conversations->toArray(), 'Conversations retrieved successfully');
    }
    
    public function user_conversations(Request $request)
    {
        
         $myId =  Auth::user()->id; 
         $conversation_id  =  $request->receiver_id;
           
         $conversation = Conversation::where(function($query) use ($myId,$conversation_id){
                  return  $query->where('sender_id','=',$conversation_id)
                  ->where('receiver_id','=',$myId);
              })
              ->orWhere(function($query2) use ($myId,$conversation_id){
                    return $query2->where('sender_id','=',$myId)
                  ->where('receiver_id','=',$conversation_id);
              })->limit(1000) 
              ->get();
              $conversation = ConversationsResource::collection($conversation);
              
        //   $conversation = $this->conversationRepository->all(
        //     $request->except(['skip', 'limit']),
        //     $request->get('skip'),
        //     $request->get('limit')
        //);

        return $this->sendResponse($conversation, 'conversation retrieved successfully');
        
        // if(!$request->receiver_id || $request->receiver_id==Auth::user()->id){
        //     return $this->sendError('Please select chat');
        // }
        // $conversations = $this->conversationRepository->chat_list($request->receiver_id);

        // return $this->sendResponse($conversations->toArray(), 'Conversations retrieved successfully');
    }

    /**
     * Store a newly created Conversation in storage.
     * POST /conversations
     *
     * @param CreateConversationAPIRequest $request
     *
     * @return Response
     */
    public function store(CreateConversationAPIRequest $request)
    {
        //$input = $request->all();
        //$input['sender_id'] = Auth::user()->id;

        //$conversation = $this->conversationRepository->create($input);

       // return $this->sendResponse($conversation->toArray(), 'Conversation saved successfully');
    }
    public function newConversation(Request $request)
    {
        $input = $request->all();
        $input['sender_id'] = Auth::user()->id;
        $conversation = $this->conversationRepository->create($input);
        //broadcast(new ChatEvent([ 'user_id' => $input['receiver_id'] , 'text' => 'Hello World']));   
         $data =  broadcast(new ChatEvent([ 'user_id' => $request->receiver_id , 'message' => $request->message]));  
        return $this->sendResponse($conversation->toArray(), 'Conversation saved successfully');
    }

    /**
     * Display the specified Conversation.
     * GET|HEAD /conversations/{id}
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        /** @var Conversation $conversation */
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            return $this->sendError('Conversation not found');
        }

        return $this->sendResponse($conversation->toArray(), 'Conversation retrieved successfully');
    }

    /**
     * Update the specified Conversation in storage.
     * PUT/PATCH /conversations/{id}
     *
     * @param int $id
     * @param UpdateConversationAPIRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConversationAPIRequest $request)
    {
        $input = $request->all();
        $input['sender_id'] = Auth::user()->id;

        /** @var Conversation $conversation */
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            return $this->sendError('Conversation not found');
        }

        $conversation = $this->conversationRepository->update($input, $id);

        return $this->sendResponse($conversation->toArray(), 'Conversation updated successfully');
    }

    /**
     * Remove the specified Conversation from storage.
     * DELETE /conversations/{id}
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        /** @var Conversation $conversation */
        $conversation = $this->conversationRepository->find($id);

        if (empty($conversation)) {
            return $this->sendError('Conversation not found');
        }

        $conversation->delete();

        return $this->sendSuccess('Conversation deleted successfully');
    }
}
