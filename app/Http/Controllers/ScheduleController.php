<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ScheduleCalendar;

class ScheduleController extends Controller
{
    //
    public function get_schedule_calendar_of(Request $request)
    {
        $magiaovien = $request->owner_schedule_calendar;
        $schedule = ScheduleCalendar::where('magiaovien', $magiaovien)->first();
        return response([
            'schedule_list' => $schedule->schedule_list,
        ]);
    }

    public function add_appointment(Request $request){
        $data = [
            'id' => $request->id,
            'title' => $request->title,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ];
        $magiaovien = $request->magiaovien;
        $schedule = ScheduleCalendar::where('magiaovien', $magiaovien);
        $schedule->push('schedule_list', $data);
        return response([
            'message' => "success",
        ]);
    }

    public function edit_appointment(Request $request)
    {
        $data = [
            'id' => $request->id,
            'title' => $request->title,
            'startDate' => $request->startDate,
            'endDate' => $request->endDate,
        ];
        $magiaovien = $request->magiaovien;
        $schedule = ScheduleCalendar::where('magiaovien', $magiaovien);
        $schedule->pull('schedule_list', ['id' => $request->id]);
        $schedule->push('schedule_list', $data);
        return response([
            'message' => "success",
        ]);
    }

    public function delete_appointment(Request $request)
    {
        $magiaovien = $request->magiaovien;
        $schedule = ScheduleCalendar::where('magiaovien', $magiaovien);
        $schedule->pull('schedule_list', ['id' => $request->id]);
        return response([
            'message' => "success",
        ]);
    }
}
