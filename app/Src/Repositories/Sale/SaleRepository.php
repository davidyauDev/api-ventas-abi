<?php

namespace App\Src\Repositories\Sale;

use App\Http\Requests\SaleRequestForm;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleDetail;
use App\Src\Interfaces\Sale\ISaleRepository;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;

class SaleRepository implements ISaleRepository
{

    public function all(array $request) {}

    public function register(SaleRequestForm $data)
    {
        return DB::transaction(function () use ($data) {
            $sale = Sale::create([
                'customer_name' => $data->customer_name,
                'code' => $data->code,
                'customer_identification' => $data->customer_identification,
                'customer_email' => $data->customer_email,
                'seller' => $data->seller,
                'total_amount' => 0,
                'sale_date' => now(),
            ]);

            $totalAmount = 0;
            $saleDetails = [];

            foreach ($data->products as $productData) {
                $product = Product::findOrFail($productData['product_id']);

                $subtotal = $product->unit_price * $productData['quantity'];
                $totalAmount += $subtotal;

                $saleDetails[] = [
                    'sale_id' => $sale->id,
                    'product_id' => $product->id,
                    'quantity' => $productData['quantity'],
                    'unit_price' => $product->price,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $product->decrement('stock', $productData['quantity']);
            }

            SaleDetail::insert($saleDetails);

            $sale->update(['total_amount' => $totalAmount]);

            return $sale;
        });
    }

    public function generateReport(array $filters, string $format)
    {
        $startDate = Carbon::parse($filters['start_date']);
        $endDate = Carbon::parse($filters['end_date']);

        $sales = Sale::whereBetween('sale_date', [$startDate, $endDate])
            ->with('details.product')
            ->get()
            ->map(function ($sale) {
                return [
                    'code' => $sale->code,
                    'customer_name' => $sale->customer_name,
                    'customer_identification' => $sale->customer_identification,
                    'customer_email' => $sale->customer_email,
                    'product_count' => $sale->details->sum('quantity'),
                    'total_amount' => $sale->total_amount,
                    'sale_date' => $sale->sale_date->format('Y-m-d h:ia'),
                ];
            });

        if ($format === 'json') {
            return $sales;
        }

        throw new \InvalidArgumentException('Invalid format specified.');
    }
}
