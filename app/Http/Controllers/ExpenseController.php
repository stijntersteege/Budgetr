<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreOrUpdateExpenseRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request): Response
    {
        return Inertia::render('Expenses', [
            'expenses' => $request->user()->expenses,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreOrUpdateExpenseRequest $request
     * @return RedirectResponse
     */
    public function store(StoreOrUpdateExpenseRequest $request): RedirectResponse
    {
        Auth::user()->expenses()->create($request->validated());

        return redirect('expenses');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(Request $request, int $id): Response
    {
        if (!Auth::user()->expenses()->find($id)) {
            abort(404);
        }
        return Inertia::render('Expenses', [
            'expenses' => $request->user()->expenses,
            'expenseDetail' => Auth::user()->expenses()->find($id),
            'showExpenseModal' => true
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreOrUpdateExpenseRequest $request
     * @return RedirectResponse
     */
    public function update(StoreOrUpdateExpenseRequest $request, int $id): RedirectResponse
    {
        if (!Auth::user()->expenses()->find($id)) {
            abort(404);
        }

        Auth::user()->expenses()->find($id)->update($request->validated());

        return redirect('expenses');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        if (!Auth::user()->expenses()->find($id)) {
            abort(404);
        }

        Auth::user()->expenses()->find($id)->delete();

        return redirect('expenses');
    }
}
