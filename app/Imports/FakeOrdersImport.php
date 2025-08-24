<?php

namespace App\Imports;

use App\Models\Customer;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Hotel;
use App\Models\Package;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class FakeOrdersImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            // Validate row data
            $validator = Validator::make($row->toArray(), [
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'mobile' => 'required|numeric|digits_between:10,15',
                'package_id' => 'required',
                'hotel_id' => 'required'
            ]);

            if ($validator->fails()) {
                throw new \Exception('Validation failed for row: ' . json_encode($validator->errors()->all()));
            }

            DB::beginTransaction();
            try {
                // Create user
                $user = Customer::create([
                    'name' => $row['name'],
                    'email' => $row['email'],
                    'password' => Hash::make('1234567890'),
                    'mobile' => $row['mobile']
                ]);

                // Create order
                $order = Order::create([
                    'order_id' => 'TORD-' . rand(1000, 9999),
                    'user_id' => $user->id,
                    'amount' => rand(100, 1000),
                    'trans_id' => 'TXN-' . rand(10000, 99999),
                    'type' => 'package',
                    'user_name' => $row['name'],
                    'user_email' => $row['email'],
                    'user_phone' => $row['mobile'],
                    'created_at' => now()
                ]);

                // Fetch hotel and package data with fallback
                $hotelData = Hotel::where('id', $row['hotel_id'])->select('id', 'name')->first() ?: 
                             (object)['id' => 0, 'name' => 'Hotel'];
                $packageData = Package::where('id', $row['package_id'])->select('id', 'title')->first() ?: 
                               (object)['id' => 0, 'title' => ' Package'];

                // Create order details
                $orderDetails = OrderDetails::insert([
                    'order_id' => $order->id,
                    'hotel_id' => $row['hotel_id'],
                    'coupon' => 'L' . $order->id,
                    'hotel_data' => json_encode($hotelData),
                    'valid_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'status' => ['Pending', 'Redeem'][rand(0, 1)],
                    'type' => 'Package',
                    'package_id' => $row['package_id'],
                    'coupon_data' => json_encode(['title' => $packageData->title]),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

                if (!$orderDetails) {
                    throw new \Exception('Failed to create order details for row: ' . json_encode($row->toArray()));
                }

                // Update package limits

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw new \Exception('Failed to import row: ' . $e->getMessage());
            }
        }
    }
}