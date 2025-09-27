<?php

namespace App\Livewire\Pages;

use Livewire\Attributes\Title;
use Livewire\Component;

class ChatPage extends Component
{
    #[Title('Chats')]
    public function render()
    {
        return view('livewire.pages.chat-page');
    }
}
