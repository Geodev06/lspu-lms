<?php

namespace App\Livewire\Forms;

use App\Models\ParamLearningCourse;
use App\Models\ParamModuleAttachment;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\WithFileUploads;
use Illuminate\Support\Str;


class ModuleAttachmentForm extends Component
{

    use WithFileUploads;


    public $attachment_id;
    public $module_id;
    public $course_id;


    public $action;

    public $record;

    public $course_code;
    public $course_title;
    public $course_org_code;


    public $kinesthetic;


    public $file;
    public $category;



    public function delete()
    {
        session()->flash('success', 'Record has been deleted successfully.');


        ParamModuleAttachment::find(decrypt($this->attachment_id))->delete();

        $this->redirect(route('learning_module_form', [
            'course_id' => encrypt($this->course_id),
            'module_id' => encrypt($this->module_id),
            'action' => encrypt(ACTION_MANAGE),

        ]));
    }


    public function mount($course_id = null, $module_id = null, $attachment_id = null, $action = null)
    {


        $this->course_id = decrypt($course_id);
        $this->module_id =  decrypt($module_id);

        $course = ParamLearningCourse::find($this->course_id);

        $this->course_title = $course->title;
        $this->course_code = $course->course_code;
        $this->course_org_code = $course->org_code;



        if ($attachment_id) {

            $this->action = decrypt($action);

            $this->record = ParamModuleAttachment::find(decrypt($attachment_id));

            $this->file = $this->record->file;
            $this->category = $this->record->category;
            $this->kinesthetic = $this->record->k_flag;
        } else {

            $this->category = F_PDF;
        }
    }

    

    public function process()
    {

        $this->check_action();

        $rules = [];
        $messages = [
            'file.required' => 'The file field is required.',
            'file.file' => 'The file must be a valid file.',
            'file.mimes' => 'The file must be a file of type: :values.',
            'file.url' => 'The file must be a valid URL.',
            'file.max' => 'The file must not be greater than :max kilobytes.',
        ];

        switch ($this->category) {
            case F_PDF:
                $rules['file'] = 'required|file|mimes:pdf|max:10120';
                break;

            case F_AUDIO:
                $rules['file'] = 'required|file|mimes:mp3,wav,ogg,m4a|max:51200';
                break;

            case F_VIDEO:
                $rules['file'] = 'required|file|mimes:mp4,mov,avi,wmv,flv,mkv|max:51200';
                break;

            case F_IMAGE:
                $rules['file'] = 'required|file|mimes:jpeg,jpg,png,gif,webp|max:5120';
                break;

            case F_LINK:
                $rules['file'] = 'required|string|url|max:2000';
                $messages['file.url'] = 'The file must be a valid URL.';
                break;

            default:
                throw new Exception('Invalid File Type');
        }

        $this->validate($rules, $messages);

        try {

            DB::beginTransaction();

            $data = [
                'module_id' => $this->module_id,
                'category'  => $this->category,
                'a_flag' => 0,
                'v_flag' => 0,
                'k_flag' => $this->kinesthetic ?? 0,
                'r_flag' => 0,

            ];

            // For link-type attachments, store the URL/string directly
            if ($this->category === F_LINK) {

                $data['file_name']     = $this->file;
                $data['sys_file_name'] = $this->file;
            } elseif ($this->file instanceof \Illuminate\Http\UploadedFile) {

                $extension = $this->file->getClientOriginalExtension();
                $filename  = Str::random(20) . '.' . $extension;

                // Store the uploaded file
                $this->file->storeAs('attachments', $filename, 'public_path');

                // Set file info in $data
                $data['file_name']     = $this->file->getClientOriginalName(); // original name
                $data['sys_file_name'] = $filename; // unique stored name
            }

            if ($this->category === F_LINK) {
                $data['a_flag'] = 1;
                $data['v_flag'] = 1;
                $data['r_flag'] = 1;
            } elseif ($this->category === F_AUDIO) {
                $data['a_flag'] = 1;
            } elseif ($this->category === F_VIDEO) {
                $data['a_flag'] = 1;
                $data['v_flag'] = 1;
            } elseif ($this->category === F_PDF) {
                $data['r_flag'] = 1;
                $data['v_flag'] = 1;
            } elseif ($this->category === F_IMAGE) {
                $data['v_flag'] = 1;
            }


            if ($this->attachment_id) {

                ParamModuleAttachment::find(decrypt($this->attachment_id))->update($data);

                session()->flash('success', 'Record has been successfully updated.');
            } else {

                ParamModuleAttachment::create($data);

                session()->flash('success', 'Record has been created successfully.');
            }

            $this->redirect(route('learning_module_form', [
                'course_id' => encrypt($this->course_id),
                'module_id' => encrypt($this->module_id),
                'action' => encrypt(ACTION_MANAGE),
            ]));


            DB::commit();
        } catch (\Throwable $th) {

            Log::error($th->getMessage());

            DB::rollBack();
        }
    }

    #[Title('Upload Learning Material')]

    public function render()
    {
        return view('livewire.forms.module-attachment-form');
    }
}
