<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Invoice;
use App\Models\InvoiceProduct;
use App\Models\InvoicePayment;

class InvoiceController extends Controller
{
 public function storeInvoice(Request $request)
 {
    $response = $this->store($request);
    return response()->json($response);

}

public function store(Request $request)
{
    $data =json_decode($request->data) ;
    $invoice = Invoice::where('invoice_id',$data->invoice_id)->first();
    if($invoice){
        return [
            'message'=>'Invoice id already exist'    
        ];
    }
    try{
        $this->saveInvoiceData($data);
        $this->saveInvoiceProduct($data->product_array,$data->invoice_id);
        $this->saveInvoicePayment($data->payment_array,$data->invoice_id);
        return [
            "message"=>"Successfully saved"
        ];
    }catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json([
            'message'=>$ex->getMessage()
        ]);
    }
}

public function saveInvoiceData($data)
{
    $invoice = new Invoice();
    $invoice->invoice_id = $data->invoice_id;
    $invoice->user_number = $data->user_number;
    $invoice->contact_id = $data->contact_id;
    $invoice->contact_name = $data->contact_name;
    $invoice->contact_address = $data->contact_address;
    $invoice->contact_number = $data->contact_number;
    $invoice->invoice_date = $data->invoice_date;
    $invoice->invoice_desc = $data->invoice_desc;
    $invoice->delivery_status = $data->delivery_status;
    $invoice->delivery_partner_name = $data->delivery_partner_name;
    $invoice->delivery_partner_code = $data->delivery_partner_code;
    $invoice->service_charge = $data->service_charge;
    $invoice->delivery_charge = $data->delivery_charge;
    $invoice->vat = $data->vat;
    $invoice->total_payable = $data->total_payable;
    $invoice->save();
}

public function saveInvoiceProduct($data,$invoiceId)
{
    foreach($data as $item)
    {
        $product = new InvoiceProduct();
        $product->invoice_id = $invoiceId;
        $product->productCode = $item->productCode;
        $product->productName = $item->productName;
        $product->productQuantity = $item->productQuantity;
        $product->sellPrice = $item->sellPrice;
        $product->discount = $item->discount;
        $product->description = $item->description;
        $product->totalSellprice = $item->totalSellprice;
        $product->buyPrice = $item->buyPrice;
        $product->discountType = $item->discountType;
        $product->discountPercent = $item->discountPercent;
        $product->discountFlat = $item->discountFlat;
        $product->save();

    }
}

public function saveInvoicePayment($data,$invoiceId)
{
    foreach($data as $item)
    {
        $payment = new InvoicePayment();
        $payment->invoice_id = $invoiceId;
        $payment->paymentDate = $item->paymentDate;
        $payment->paymentAmount = $item->paymentAmount;
        $payment->paymentDesc = $item->paymentDesc;
        $payment->save();
    }
}

public function getInvoice(Request $request)
{
    $invoice_id =$request->invoice_id ;
    $invoice = Invoice::where('invoice_id',$invoice_id)->first();
    return response()->json($invoice);

}

public function updateInvoice(Request $request)
{
    $invoice_id =$request->invoice_id ;
    try{
        $invoice = Invoice::where('invoice_id',$invoice_id)->first();
        InvoiceProduct::where('invoice_id',$invoice_id)->delete();
        InvoicePayment::where('invoice_id',$invoice_id)->delete();
        isset($invoice) ? $invoice->delete(): "";
        $response = $this->store($request);
        return response()->json($response);
    }catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json([
            'message'=>$ex->getMessage()
        ]);
    }
    
    

}

public function delete(Request $request)
{
    $invoice_id =$request->invoice_id ;
    try{
        $invoice = Invoice::where('invoice_id',$invoice_id)->first();
        InvoiceProduct::where('invoice_id',$invoice_id)->delete();
        InvoicePayment::where('invoice_id',$invoice_id)->delete();
        return response()->json([
            'message'=>'Deleted Successfully'
        ]);
    } catch(\Illuminate\Database\QueryException $ex){ 
        return response()->json([
            'message'=>$ex->getMessage()
        ]);
    }

}

public function getInvoiceList(Request $request)
{
    $contactNumber = $request->contact_number;
    $invoiceList = Invoice::where('contact_number',$contactNumber)->get();
    return response()->json($invoiceList);
}
}
