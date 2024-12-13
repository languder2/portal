<?php

namespace App\Http\Controllers;

use App\Models\Education\Staff;
use App\Models\Notification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class StaffController extends AccountController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function saveStaff(Request $request):RedirectResponse
    {
        if($request->get('id')){

            $staff = Staff::where([
                'id'            => $request->get('id'),
                'uid'           => auth()->id()
            ])->first();

            if(is_null($staff))
                return redirect()->route('show:education');
        }

        $rules          = [
            'ed_faculty'            => '',
            'ed_department'         => '',
            'department'            => '',
            'post'                  => 'required',
            'employment'            => 'nullable|date_format:Y-m-d',
            'dismissal'             => "nullable|date_format:Y-m-d",
        ];

        $messages       = [
            'post'                  => 'Укажите должность',
            'dismissal.min'         => "Дата увольнение не может быть позже даты трудоустройства",
        ];

        $form = $request->validate($rules,$messages);

        if(!isset($staff))
            $staff = Staff::create([
                'uid'       => $this->user->id,
            ]);

        $staff->update($form);

        Staff::setRole();

        Notification::updateOrCreate(
            [
                'code'      => 'save:staff',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => 'Данные о трудоустройстве сохранены'
            ]
        );

        return redirect()->route('show:staff');
    }
    public function deleteStaff(int $id):RedirectResponse
    {

        $staff = Staff::where([
            'id'            => $id,
            'uid'           => auth()->id()
        ])->first();

        if(is_null($staff))
            return redirect()->route('show:staff');



        $message = '';

        if(!is_null($staff->post))
            $message.= $staff->post;

        if(!is_null($staff->employment))
            $message.= " с ".Carbon::createFromFormat('Y-m-d',  $staff->employment)->format('d.m.Y');

        if(!is_null($staff->dismissal))
            $message.= " по ".Carbon::createFromFormat('Y-m-d',  $staff->dismissal)->format('d.m.Y');

        Notification::updateOrCreate(
            [
                'code'      => 'delete:education:',
                'uid'       => $this->user->id,
            ],
            [
                'type'      => 'success',
                'message'   => "Данные о трудоустройстве удалены: $message",
            ]
        );

        $staff->delete();

        Staff::updatingRole($this->user->id);

        return redirect()->route('show:staff');
    }

}
