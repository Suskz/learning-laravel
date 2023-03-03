<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        //return home and events from DB
        $events = Event::all();

        return view('welcome', ['events' => $events]);
    }

    public function create()
    {
        //return the view create in events folder
        return view('events.create');
    }

    public function store(Request $request)
    {
        //create a new event in DB
        $event = new Event();

        $event -> title = $request -> title;
        $event -> city = $request -> city;
        $event -> private = $request -> private;
        $event -> description = $request -> description;

        //image upload
        if($request -> hasFile('image') && $request->file('image') -> isValid())
        {
            $requestImage = $request -> image;

            $extension = $requestImage -> extension();

            $imageName = md5($requestImage -> getClientOriginalName() . strtotime("now")) . "." . $extension;

            $requestImage -> move(public_path('img/events'), $imageName);

            $event -> image = $imageName;
        }

        $event -> save();

        // -> with(); for send message in section
        return redirect('/') -> with('msg', 'Evento criado com sucesso!');
    }

    public function show($id)
    {
        $event = Event::findOrFail($id);
        return view('events.show', ['event' => $event]);

    }
}