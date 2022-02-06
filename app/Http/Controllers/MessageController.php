<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MessageController extends Controller
{
    //
    public function index()
    {
        //
        return view('admin.message.index');
    }

    public function table()
    {
        return datatables()
            ->eloquent(Message::query()->where("type","message"))
            // ->addColumn('actions', 'panel.messages._actions')
            // ->rawColumns(['actions'])
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s'); return $formatedDate; })
            ->toJson();
    }

    public function appointmentsIndex()
    {
        //
        return view('admin.message.appointments-index');
    }

    public function appointmentsTable()
    {
        return datatables()
            ->eloquent(Message::query()->where("type","appointment"))
            // ->addColumn('actions', 'panel.messages._actions')
            // ->rawColumns(['actions'])
            ->editColumn('created_at', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d H:i:s', $data->created_at)->format('d-m-Y H:i:s'); return $formatedDate; })
            ->editColumn('appointment_date', function($data){ $formatedDate = Carbon::createFromFormat('Y-m-d', $data->appointment_date)->format('d-m-Y'); return $formatedDate; })
            ->toJson();
    }

    // public function show(Message $message)
    // {
    //     //
    //     return view('admin.message.show');
    // }

    public function destroy(Message $message)
    {
        //
        $message->delete();
    }
}
