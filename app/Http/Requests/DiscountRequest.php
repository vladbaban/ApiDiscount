<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DiscountRequest extends FormRequest {
	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize() {
		return true;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules() {
		return [
			'customer-id' => 'required|exists:users,id',
			'items' => 'required|array',
			'items.*.product-id' => 'required|exists:products,productId',
			'items.*.quantity' => 'required|numeric',
			'items.*.unit-price' => 'required',
			'total' => 'required',
		];
	}
	/**
	 * Get the respons messages if the order does not pass one of the validation rules
	 *
	 * @return array
	 */
	public function messages() {
		return [
			'customer-id.exists' => 'The given customer (id :input) does not exist in our records',
			'items.required' => 'The items field is required',
			'items.array' => 'The items field must be an array',
			'items.*.product-id.exists' => 'The given product (id :input) does not exist in our records',
			'total.required' => 'The total price of the order is required',
		];
	}
}
