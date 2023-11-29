<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use App\Models\Discount;
use Illuminate\Contracts\View\View;

class DiscountController extends Controller
{
    public function allDiscounts(): View
    {
        $discounts = Discount::All();

        return view('admin.all_discounts')
            ->with('allDiscounts', $discounts);
    }


    public function addDiscount()
    {
        return view('admin.add_discount');
    }


    public function saveAddedDiscount(Request $request)
    {
        $this->validate(
            $request,
        [
            'discount_name' => 'required',
            'discount_percentage' => 'required|numeric|min:0.1|max:99',
        ]);

        $newDiscount = new Discount();

        $newDiscount->discount_name = $request->input('discount_name');
        $newDiscount->discount_percentage = $request->input('discount_percentage');
        $newDiscount->save();

        return back()
            ->with('status', 'The Discount "' . $request->input('discount_name') . '" Added Successfully');
    }


    public function editDiscount(int $id)
    {
        $discountById = Discount::find($id);

        return view('admin.edit_discount')
            ->with('discountByUrlId', $discountById);
    }


    public function updateEditedDiscount(Request $request): RedirectResponse
    {
        $this->validate(
            $request,
        [
            'discount_name' => 'required',
            'discount_percentage' => 'required|numeric|min:0.1|max:99',
        ]);

        $updateDiscountByHiddenId = Discount::find($request->input('id'));    // finds hidden "id" in the "edit_discount.blade.php"

        $updateDiscountByHiddenId->discount_name = $request->input('discount_name');
        $updateDiscountByHiddenId->discount_percentage = $request->input('discount_percentage');

        $updateDiscountByHiddenId->update();

        return redirect('/all-discounts')->with('status', 'The Discount "' . $request->input('discount_name') . '" Updated Successfully');
    }


    
    public function deleteDiscount($id)
    {
        $deleteDiscountByUrlId = Discount::find($id);

        $deleteDiscountByUrlId->delete();

        return back()->with('status', 'The Discount "' . $deleteDiscountByUrlId->discount_name . '" Deleted Successfully');
    }
}
