<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CheckoutRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Shipping Address
            'shipping_name' => ['required', 'string', 'max:255'],
            'shipping_email' => ['required', 'email', 'max:255'],
            'shipping_phone' => ['required', 'string', 'max:20'],
            'shipping_address_line_1' => ['required', 'string', 'max:255'],
            'shipping_address_line_2' => ['nullable', 'string', 'max:255'],
            'shipping_city' => ['required', 'string', 'max:100'],
            'shipping_state' => ['required', 'string', 'max:100'],
            'shipping_postal_code' => ['required', 'string', 'max:20'],
            'shipping_country' => ['required', 'string', 'max:100'],

            // Billing Address
            'same_as_shipping' => ['boolean'],
            'billing_name' => ['required_if:same_as_shipping,false', 'nullable', 'string', 'max:255'],
            'billing_email' => ['required_if:same_as_shipping,false', 'nullable', 'email', 'max:255'],
            'billing_phone' => ['required_if:same_as_shipping,false', 'nullable', 'string', 'max:20'],
            'billing_address_line_1' => ['required_if:same_as_shipping,false', 'nullable', 'string', 'max:255'],
            'billing_address_line_2' => ['nullable', 'string', 'max:255'],
            'billing_city' => ['required_if:same_as_shipping,false', 'nullable', 'string', 'max:100'],
            'billing_state' => ['required_if:same_as_shipping,false', 'nullable', 'string', 'max:100'],
            'billing_postal_code' => ['required_if:same_as_shipping,false', 'nullable', 'string', 'max:20'],
            'billing_country' => ['required_if:same_as_shipping,false', 'nullable', 'string', 'max:100'],

            // Order Notes
            'notes' => ['nullable', 'string', 'max:1000'],

            // Payment Method
            'payment_method' => ['required', 'in:credit_card,paypal,cash_on_delivery'],
        ];
    }

    public function messages(): array
    {
        return [
            'shipping_name.required' => 'Please enter your full name.',
            'shipping_email.required' => 'Please enter your email address.',
            'shipping_email.email' => 'Please enter a valid email address.',
            'shipping_phone.required' => 'Please enter your phone number.',
            'shipping_address_line_1.required' => 'Please enter your street address.',
            'shipping_city.required' => 'Please enter your city.',
            'shipping_state.required' => 'Please enter your state/province.',
            'shipping_postal_code.required' => 'Please enter your postal code.',
            'shipping_country.required' => 'Please enter your country.',
        ];
    }

    public function prepareForValidation(): void
    {
        // If same_as_shipping is checked, copy shipping to billing
        if ($this->boolean('same_as_shipping')) {
            $this->merge([
                'billing_name' => $this->input('shipping_name'),
                'billing_email' => $this->input('shipping_email'),
                'billing_phone' => $this->input('shipping_phone'),
                'billing_address_line_1' => $this->input('shipping_address_line_1'),
                'billing_address_line_2' => $this->input('shipping_address_line_2'),
                'billing_city' => $this->input('shipping_city'),
                'billing_state' => $this->input('shipping_state'),
                'billing_postal_code' => $this->input('shipping_postal_code'),
                'billing_country' => $this->input('shipping_country'),
            ]);
        }
    }
}
