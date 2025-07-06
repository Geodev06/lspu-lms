<?php

namespace App\Livewire\Forms;

use App\Models\ParamOrganization;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;

class OrganizationForm extends Component
{
    public $id;
    public $action;

    public $record;

    public $org_code;
    public $name;
    public $department;


    public function mount($id = null, $action = null)
    {
        if ($id) {
            $this->id = decrypt($id);
            $this->action = decrypt($action);


            $this->record = ParamOrganization::find($this->id);

            $this->org_code = $this->record->org_code;
            $this->name = $this->record->name;
            $this->department = $this->record->department;

        }


    }


    public function process()
    {
        $this->check_action();
        $validated_data = $this->validate([
            'org_code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('param_organizations')->ignore($this->id),
            ],
            'name' => [
                'required',
                'string',
                'max:245',
                Rule::unique('param_organizations')->ignore($this->id),
            ],

            'department' => 'required|string|max:245',
        ]);

        try {
            DB::beginTransaction();

          

            $data = [
                
                'org_code'        => $this->org_code,
                'name'         => $this->name,
                'department'    => $this->department
            ];

            if ($this->id) {
               

                ParamOrganization::find($this->id)->update($data);

                session()->flash('success', $this->org_code . ' has been successfully updated.');

                $this->redirect(route('organizations'));
            } else {
               
                ParamOrganization::create($data);

                session()->flash('success', $this->org_code . ' has been created successfully.');

                $this->redirect(route('organizations'));
            }

            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();
        }
    }

    #[Title('Org Form')]
    public function render()
    {
        return view('livewire.forms.organization-form');
    }
}
