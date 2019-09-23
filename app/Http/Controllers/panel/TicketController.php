<?php

namespace App\Http\Controllers\panel;

use App\Models\Ticket;
use App\Http\Requests\TicketRequest;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    /**
     * Display a listing of the Tickets.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('panel.ticket', [
            'tickets' => Ticket::with('user')->latest()->get(),
            'page_name' => 'ticket',
            'page_title' => 'تیکت ها',
            'options' => $this->options(['site_name', 'site_logo'])
        ]);
    }

    /**
     * Show the form for creating a new Ticket.
     *
     * @return \Illuminate\Http\Response
     *
     * public function create()
     * {
     *   
     * }
     */ 

    /**
     * Store a newly created ticket in storage.
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     * @return \Illuminate\Http\Response
     * 
     * public function store(TicketRequest $request)
     * {
        
     * }
     */

    /**
     * Display the specified ticket.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     * 
     * public function show(Ticket $ticket)
     * {
     *   //
     * }
     */

    /**
     * Show the form for editing the specified ticket.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     * 
     * public function edit(Ticket $ticket)
     * {
     *  
     * }
     */

    /**
     * Update the specified ticket in storage.
     *
     * @param  \App\Http\Requests\TicketRequest  $request
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     * 
     * public function update(TicketRequest $request, Ticket $ticket)
     * {
     *   
     * }
     */

    /**
     * Remove the specified ticket from storage.
     *
     * @param  \App\Ticket  $ticket
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        $ticket->delete();
        return redirect( route('ticket.index') )->with('message', "تیکت با موفقیت حذف شد");
    }
}
