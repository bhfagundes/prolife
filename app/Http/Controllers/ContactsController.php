<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateContactsRequest;
use App\Http\Requests\UpdateContactsRequest;
use App\Repositories\ContactsRepository;
use App\Http\Controllers\AppBaseController;
use App\Mail\SendMailContact;
use Illuminate\Http\Request;
use Flash;
use Carbon\Carbon;
use Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ContactsController extends AppBaseController
{
    /** @var  ContactsRepository */
    private $contactsRepository;

    public function __construct(ContactsRepository $contactsRepo)
    {
        $this->contactsRepository = $contactsRepo;
    }

    /**
     * Display a listing of the Contacts.
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $contacts = $this->contactsRepository->all();

        return view('contacts.index')
            ->with('contacts', $contacts);
    }

    /**
     * Show the form for creating a new Contacts.
     *
     * @return Response
     */
    public function create()
    {
        return view('contacts.create');
    }

    /**
     * Store a newly created Contacts in storage.
     *
     * @param CreateContactsRequest $request
     *
     * @return Response
     */
    public function store(CreateContactsRequest $request)
    {
        $input = $request->all();
        $path = 'contact/'.Carbon::now().'.'. $input['file']->getClientOriginalExtension();
        Storage::disk('local')->put($path, file_get_contents($input['file']->getRealPath()));
        $input['file'] = $path;
        $contacts = $this->contactsRepository->create($input);
        Mail::to(env('DESTINATION_MAIL'))->send(new SendMailContact($contacts));
        Flash::success('Contacts saved successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Display the specified Contacts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error('Contacts not found');

            return redirect(route('contacts.index'));
        }
        return Storage::disk('local')->download($contacts->file);

    }

    /**
     * Show the form for editing the specified Contacts.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error('Contacts not found');

            return redirect(route('contacts.index'));
        }

        return view('contacts.edit')->with('contacts', $contacts);
    }

    /**
     * Update the specified Contacts in storage.
     *
     * @param int $id
     * @param UpdateContactsRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateContactsRequest $request)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error('Contacts not found');

            return redirect(route('contacts.index'));
        }
        Storage::disk('local')->delete($contacts->file);
        $path = 'contact/'.Carbon::now().'.'. $request->file->getClientOriginalExtension();
        Storage::disk('local')->put($path, file_get_contents($request->file->getRealPath()));
        $input = $request->all();
        $input['file']= $path;
        $contacts = $this->contactsRepository->update($input, $id);
        Mail::to(env('DESTINATION_MAIL'))->send(new SendMailContact($contacts));
        Flash::success('Contacts updated successfully.');

        return redirect(route('contacts.index'));
    }

    /**
     * Remove the specified Contacts from storage.
     *
     * @param int $id
     *
     * @throws \Exception
     *
     * @return Response
     */
    public function destroy($id)
    {
        $contacts = $this->contactsRepository->find($id);

        if (empty($contacts)) {
            Flash::error('Contacts not found');

            return redirect(route('contacts.index'));
        }
        Storage::delete($contacts->file);
        $this->contactsRepository->delete($id);

        Flash::success('Contacts deleted successfully.');

        return redirect(route('contacts.index'));
    }
}
