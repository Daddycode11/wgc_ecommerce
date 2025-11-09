<?php

namespace Botble\Raffle\Http\Controllers;

use Botble\Base\Http\Controllers\BaseController;
use Botble\Base\Facades\PageTitle;
use Botble\Raffle\Forms\RaffleForm;
use Botble\Raffle\Models\Raffle;
use Botble\Raffle\Http\Requests\RaffleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class RaffleController extends BaseController
{
    /**
     * Display a list of active raffles.
     */
    public function index(Request $request)
    {
        PageTitle::setTitle('All Raffles');

        // Fetch raffles that are currently active or upcoming
        $raffles = Raffle::orderBy('end_date', 'asc')->get();

        return view('plugins/raffle::index', compact('raffles'));
    }

    /**
     * Show the form to create a new raffle.
     */
    public function create()
    {
        PageTitle::setTitle('Create Raffle');
        return RaffleForm::create()->renderForm();
    }

    /**
     * Store a new raffle in the database.
     */

    public function store(RaffleRequest $request)
    {


        $data = $this->formatDateTimeFields($request->validated());
        if($request->has('prize_image')){
            $data['prize_image'] = $request->prize_image;
        }

        $raffle = Raffle::create($data);

        return $this
            ->httpResponse()
            ->setNextUrl(route('raffle.edit', $raffle->id))
            ->setMessage('Raffle created successfully!');
    }


    /**
     * Show the form to edit a raffle.
     */
    public function edit(Raffle $raffle)
    {
        PageTitle::setTitle('Edit Raffle: ' . $raffle->event_name);
        return RaffleForm::createFromModel($raffle)->renderForm();
    }

    /**
     * Update an existing raffle.
     */
    public function update(Raffle $raffle, RaffleRequest $request)
    {
        $data = $this->formatDateTimeFields($request->validated());
        if($request->has('prize_image')){
            $data['prize_image'] = $request->fprize_image;
        }

        $raffle->update($data);

        return $this
            ->httpResponse()
            ->setNextUrl(route('raffle.index'))
            ->setMessage('Raffle updated successfully!');
    }

    /**
     * Delete a raffle and its associated image.
     */
    public function destroy(Raffle $raffle)
    {
        $this->deleteImage($raffle->prize_image);

        $raffle->delete();

        return $this
            ->httpResponse()
            ->setNextUrl(route('raffle.index'))
            ->setMessage('Raffle deleted successfully!');
    }

    /**
     * Format datetime fields consistently.
     */
    protected function formatDateTimeFields(array $data): array
    {
        $fields = ['entry_date', 'end_date', 'draw_date'];

        foreach ($fields as $field) {
            $data[$field] = !empty($data[$field])
                ? Carbon::parse($data[$field])->format('Y-m-d H:i:s')
                : null;
        }

        return $data;
    }

    /**
     * Handle image upload with optional replacement of old image.
     */
    protected function handleImageUpload(Request $request, string $field, string $directory, ?string $oldImage = null): ?string
    {
        if ($request->hasFile($field)) {
            // Delete old image if exists
            if ($oldImage) {
                $this->deleteImage($oldImage);
            }

            $filename = time() . '_' . $request->file($field)->getClientOriginalName();
            return $request->file($field)->storeAs($directory, $filename, 'public');
        }

        return $oldImage ?? null;
    }



    /**
     * Delete an image from storage if it exists.
     */
    protected function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
