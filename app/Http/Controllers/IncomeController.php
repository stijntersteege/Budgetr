<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateIncomeRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Income', [
            'income' => $request->user()->income,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrUpdateIncomeRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrUpdateIncomeRequest $request): RedirectResponse
    {
        Auth::user()->income()->create($request->validated());

        return redirect('income');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Request $request, int $id): Response
    {
        if (!Auth::user()->income()->find($id)) {
            abort(404);
        }
        return Inertia::render('Income', [
            'income' => $request->user()->income,
            'incomeDetail' => Auth::user()->income()->find($id),
            'showIncomeModal' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrUpdateIncomeRequest $request
     * @return RedirectResponse
     */
    public function update(StoreOrUpdateIncomeRequest $request, int $id): RedirectResponse
    {
        if (!Auth::user()->income()->find($id)) {
            abort(404);
        }

        Auth::user()->income()->find($id)->update($request->validated());

        return redirect('income');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        if (!Auth::user()->income()->find($id)) {
            abort(404);
        }

        Auth::user()->income()->find($id)->delete();

        return redirect('income');
    }
}
