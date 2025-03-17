<?php 

namespace App\Cards\Message;

use Symfony\Component\Messenger\Attribute\AsMessage;

#[AsMessage('async')]
class SyncMessage
{

    public function __construct()
    {
    }
    
}