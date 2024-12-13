<?php

namespace App\Http\Controllers;

use App\Models\Education\Speciality;
use App\Models\Education\Student;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StudentController extends AccountController
{
    public function __construct()
    {
        parent::__construct();
    }
    public function saveEducation(Request $request):RedirectResponse|string
    {

        if($request->get('id')){

            $student = Student::where([
                'id'            => $request->get('id'),
                'uid'           => auth()->id()
            ])->first();

            if(is_null($student))
                return redirect()->route('show:education');
        }

        if($this->detail->snils === null){
            $rules      = [
                'snils'             => "required|regex:'^[0-9]{3}\-[0-9]{3}\-[0-9]{3} [0-9]{2}'",
            ];

            $messages   = [
                'snils.required'    => 'Поле СНИЛС обязательно к заполнению',
                'snils.regex'       => 'Поле СНИЛС должно быть заполнено в формате: <b>000-000-000 00</b>',
            ];

            $form = $request->validate($rules,$messages);

            $this->detail->update($form);
        }

        $rules          = [
            'faculty'               => 'required',
            'department'            => 'required',
            'level'                 => 'required',
            'form'                  => 'required',
            'speciality'            => 'required',
            'course'                => 'required',
            'group_number'          => 'required',
            'contract_number'       => '',
            'year_from'             => 'nullable|numeric',
            'year_to'               => "nullable|numeric|min:{$request->year_from}",
        ];

        $messages       = [
            'faculty'               => 'Укажите факультет',
            'department'            => 'Укажите кафедру',
            'level'                 => 'Укажите уровень',
            'form'                  => 'Укажите форму обучения',
            'speciality'            => 'Укажите специальность',
            'course'                => 'Укажите курс',
            'group_number'          => 'Укажите номер группы',
            'year_to.min'           => "Год окончания не может быть меньше года начала обучения",
        ];

        $form = $request->validate($rules,$messages);

        if(!isset($student))
            $student = Student::create([
                'uid'       => $this->user->id,
            ]);

        $student->update($form);

        Notification::updateOrCreate(
            [
                'code'      => 'save:education',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => 'Учебные данные сохранены',
            ]
        );

        Student::updatingRole($this->user->id);

        return redirect()->route('show:education');
    }
    public function deleteEducation(int $id):RedirectResponse
    {

        $student = Student::where([
            'id'            => $id,
            'uid'           => auth()->id()
        ])->first();

        if(is_null($student))
            return redirect()->route('show:education');

        $speciality         = Speciality::find($student->speciality);

        Notification::updateOrCreate(
            [
                'code'      => 'delete:education:',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => "Учебные данные удалены: {$speciality->code} {$speciality->name}",
            ]
        );

        $student->delete();

        Student::updatingRole($this->user->id);

        return redirect()->route('show:education');
    }

}
