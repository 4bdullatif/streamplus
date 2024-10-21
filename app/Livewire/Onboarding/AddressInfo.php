<?php

namespace App\Livewire\Onboarding;

use App\Dto\Onboarding\Address;
use Livewire\Attributes\On;
use Livewire\Component;

class AddressInfo extends Component
{
    public array $address = [];
    protected $listeners = ['validateAddress'];
    public int $stateIdRequired = 0;

    public $country = [];
    public $state = [];

    protected $rules = [
        'address.addressLine1' => 'required',
        'address.addressLine2' => 'nullable',
        'address.city' => 'required',
        'address.postcode' => 'required',
        'address.state' => 'required_if:stateIdRequired,0',
        'address.stateId' => 'required_if:stateIdRequired,1',
        'address.countryId' => 'required|exists:countries,id',
    ];

    public function validateAddress() {
        $this->validate();

        $this->dispatch('addressUpdated', $this->address + ['country' => $this->country['name']]);
        $this->dispatch('stepValidated');
    }

    public function mount(Address $address)
    {
        $this->address = $address->toArray();
    }

    public function render()
    {
        return view('livewire.onboarding.address-info');
    }

    #[On('dropDownValueUpdated')]
    public function onSelectValueUpdated($key, $value) {
        if ($key === 'countryId') {
            $country = $value;
            $this->country = $country;
            $this->address['countryId'] = $country['id'];
            $this->stateIdRequired = $country['has_states'] ? 1 : 0;
            // Re-init state
            $this->address['stateId'] = null;
            $this->address['state'] = '';

        } else if ($key === 'stateId') {
            $this->state = $value;
            $this->address['stateId'] = $value['id'];
            $this->address['state'] = $value['name'];
        }
    }
}
