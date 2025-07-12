<?php

namespace App\Imports;

use App\Models\Customer;
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
                'email' => 'required|email|max:255|unique:users,email',
                'mobile' => 'required|numeric|digits_between:10,15',
                'package' => 'required|string|exists:packages,title',
                'hotel' => 'required|string|exists:hotels,name'
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
                    'password' => Hash::make('password123'),
                    'mobile' => $row['mobile']
                ]);

                // Fetch package and hotel IDs
                $package = DB::table('packages')->where('title', $row['package'])->select('id', 'title')->first();
                $hotel = DB::table('hotels')->where('name', $row['hotel'])->select('id', 'name')->first();

                if (!$package || !$hotel) {
                    throw new \Exception('Package or hotel not found for row: ' . json_encode($row->toArray()));
                }

                // Create order
                $orderId = DB::table('tbl_orders')->insertGetId([
                    'order_code' => 'ORD-' . rand(1000, 9999),
                    'user_id' => $user->id,
                    'amount' => rand(100, 1000),
                    'trans_id' => 'TXN-' . rand(10000, 99999),
                    'type' => 'package',
                    'user_name' => $row['name'],
                    'user_email' => $row['email'],
                    'user_phone' => $row['mobile'],
                    'created_at' => now()
                ]);

                // Create order details
                DB::table('order_details')->insert([
                    'order_id' => $orderId,
                    'hotel_id' => $hotel->id,
                    'coupon' => 'FAKE-' . $orderId,
                    'hotel_data' => json_encode(['id' => $hotel->id, 'name' => $hotel->name]),
                    'valid_date' => now()->addDays(rand(1, 30))->format('Y-m-d'),
                    'status' => ['Pending', 'Redeem'][rand(0, 1)],
                    'type' => 'Package',
                    'package_id' => $package->id,
                    'coupon_data' => json_encode(['title' => $package->title])
                ]);

                // Update package limits
                DB::table('packages')->where('id', $package->id)->decrement('limit')->increment('sold_count');

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                throw new \Exception('Failed to import row: ' . $e->getMessage());
            }
        }
    }
}