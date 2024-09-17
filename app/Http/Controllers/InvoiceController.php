<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\InvoiceProduct;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    function InvoicePage():View{
        return view('pages.dashboard.invoice-page');
    }

    function SalePage():View{
        return view('pages.dashboard.sale-page');
    }

    function InvoiceCreate(Request $request){
        DB::beginTransaction();

        try{
            $user_id=$request->header('id');
            $total=$request->input('total');
            $discount=$request->input('discount');
            $vat=$request->input('vat');
            $payable=$request->input('payable');
            $customer_id=$request->input('customer_id');

            $invoice= Invoice::create([
                'total'=>$total,
                'discount'=>$discount,
                'vat'=>$vat,
                'payable'=>$payable,
                'customer_id'=>$customer_id,
                'user_id'=>$user_id
            ]);

            $invoiceID=$invoice->id;
            $products=$request->input('products');

            foreach($products as $EachProduct){
                InvoiceProduct::create([
                    'invoice_id'=>$invoiceID,
                    'user_id'=>$user_id,
                    'product_id'=>$EachProduct['product_id'],
                    'qty'=>$EachProduct['qty'],
                    'sale_price'=>$EachProduct['sale_price']
                ]);
            }

            DB::commit();
            return 1;
        }
        catch (Exception $e) {
            DB::rollBack();
            return 0;
        }
    }

    function InvoiceSelect(Request $request){
        $user_id=$request->header('id');
        return Invoice::where('user_id',$user_id)->with('customer')->get();
    }
}
