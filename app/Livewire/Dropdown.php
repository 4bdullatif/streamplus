<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Attributes\Reactive;
use Livewire\Component;

class Dropdown extends Component
{
    public $ajaxUrl;
    public $placeholder = '';
    public $minimumInputLength = 1;
    public $modelValue = '';

    public $modelValueKey = '';

    public $params = [];

    public $wireIgnore = true;

    #[Reactive]
    public $elementId;

    public $class = '';


    public function mount($ajaxUrl, $placeholder = 'Select an option', $minimumInputLength = 1, $modelValueKey = '', $params = [], $wireIgnore = true, $elementId = '', $class = '')
    {
        $this->ajaxUrl = $ajaxUrl;
        $this->placeholder = $placeholder;
        $this->minimumInputLength = $minimumInputLength;
        $this->modelValueKey = $modelValueKey;
        $this->params = $params;
        $this->wireIgnore = $wireIgnore;
        $this->elementId = $elementId;
        $this->class = $class;
    }

    public function render()
    {
        return view('livewire.dropdown');
    }

    #[On('valueUpdated')]
    public function updatedModelValue($key, $value)
    {
        $this->dispatch('dropDownValueUpdated', $key, $value);
    }
}
