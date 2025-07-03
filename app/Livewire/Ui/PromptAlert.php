<?php

namespace App\Livewire\Ui;

use Livewire\Component;

class PromptAlert extends Component
{

    public string $message = 'Are you sure?';
    public string $confirmEvent = '';

    public function confirm()
    {
        $this->dispatch($this->confirmEvent); // Send event to parent
        $this->dispatch('closePrompt');
    }

    public function cancel()
    {
        $this->dispatch('closePrompt');
    }

    public function render()
    {
        return view('livewire.ui.prompt-alert');
    }
}
