<?php

namespace App\Http\Controllers;

use App\DataTables\CountryDataTable;
use App\Http\Requests;
use App\Http\Requests\CreateCountryRequest;
use App\Http\Requests\UpdateCountryRequest;
use App\Repositories\CountryRepository;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;


class CountryController extends AppBaseController
{
    /** @var CountryRepository $countryRepository*/
    private $countryRepository;

    public function __construct(CountryRepository $countryRepo)
    {
        $this->countryRepository = $countryRepo;
    }

    /**
     * Display a listing of the Country.
     *
     * @param CountryDataTable $countryDataTable
     *
     * @return Response
     */
    public function index(CountryDataTable $countryDataTable)
    {
        return $countryDataTable->render('countries.index');
    }

    /**
     * Show the form for creating a new Country.
     *
     * @return Response
     */
    public function create()
    {
        return view('countries.create');
    }

    /**
     * Store a newly created Country in storage.
     *
     * @param CreateCountryRequest $request
     *
     * @return Response
     */
    public function store(CreateCountryRequest $request)
    {

        $input=[
            'en' => [
                'name' => $request['name:en'],
                'description' => $request['description:en']
            ],
            'ar' => [
                'name' => $request['name:ar'],
                'description'=>$request['description:ar']
            ],
        ];

        $country = $this->countryRepository->create($input);

        Flash::success('Country saved successfully.');

        return redirect(route('countries.index'));
    }



    /**
     * Show the form for editing the specified Country.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        return view('countries.edit')->with('country', $country);
    }

    /**
     * Update the specified Country in storage.
     *
     * @param int $id
     * @param UpdateCountryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCountryRequest $request)
    {
        $country = $this->countryRepository->find($id);
        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $input=[
            'en' => [
                'name' => $request['name:en'],
                'description' => $request['description:en']
            ],
            'ar' => [
                'name' => $request['name:ar'],
                'description'=>$request['description:ar']
            ],
        ];

        $country = $this->countryRepository->update($input, $id);

        Flash::success('Country updated successfully.');

        return redirect(route('countries.index'));
    }

    /**
     * Remove the specified Country from storage.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $country = $this->countryRepository->find($id);

        if (empty($country)) {
            Flash::error('Country not found');

            return redirect(route('countries.index'));
        }

        $this->countryRepository->delete($id);
        $country->deleteTranslations();


        Flash::success('Country deleted successfully.');

        return redirect(route('countries.index'));
    }
}
