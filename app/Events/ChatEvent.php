<?php
namespace App\Events;
//use Illuminate\Queue\SerializesModels;
//use Illuminate\Foundation\Events\Dispatchable;
//use Illuminate\Broadcasting\InteractsWithSockets;
//use Illuminate\Contracts\Broadcasting\ShouldBroadcast;



//use App\Models\ChatMessage;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ChatEvent implements ShouldBroadcast
{
  use Dispatchable, InteractsWithSockets, SerializesModels;

  public $message;

  public function __construct($message)
  {
      $this->message = $message;
  }

  public function broadcastOn()
  {
     return new Channel('chart-channel.'.$this->message['user_id']);
  }

//   public function broadcastAs()
//   {
//       return 'chart-event.'.$message->user_id;
//   }
  
  public function broadcastAs()
  {
      return 'chart-event';
  }
}
